<?php

use App\Models\User;
use App\Services\GoogleIdTokenVerifier;

test('google login asks Google to show the account chooser', function () {
    $response = $this->get(route('google.redirect'));

    $response->assertRedirect();

    parse_str(parse_url($response->headers->get('Location'), PHP_URL_QUERY) ?? '', $query);

    expect($query['prompt'] ?? null)->toBe('select_account');
});

test('mobile api login rejects requests without a Google ID token', function () {
    $this->postJson('/api/auth/google')
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['id_token', 'idToken']);
});

test('mobile api login reports missing Google client configuration', function () {
    config(['services.google.client_id' => null]);

    $this->postJson('/api/auth/google', [
        'id_token' => 'google-id-token',
    ])->assertServiceUnavailable()
        ->assertJsonPath('success', false);
});

test('mobile api login creates a student and returns a Sanctum token for a verified Google identity', function () {
    config(['services.google.client_id' => 'mobile-google-client-id']);

    $verifier = Mockery::mock(GoogleIdTokenVerifier::class);
    $verifier->shouldReceive('verify')
        ->once()
        ->with('google-id-token', 'mobile-google-client-id')
        ->andReturn([
            'sub' => 'google-user-123',
            'email' => 'mobile.student@example.com',
            'email_verified' => true,
            'name' => 'Mobile Student',
        ]);
    $this->app->instance(GoogleIdTokenVerifier::class, $verifier);

    $response = $this->postJson('/api/auth/google', [
        'id_token' => 'google-id-token',
    ]);

    $response->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.user.email', 'mobile.student@example.com')
        ->assertJsonPath('data.user.role', 'siswa')
        ->assertJsonStructure(['data' => ['token']]);

    $this->assertDatabaseHas('users', [
        'email' => 'mobile.student@example.com',
        'google_id' => 'google-user-123',
        'role' => 'siswa',
    ]);

    $user = User::where('email', 'mobile.student@example.com')->firstOrFail();

    expect($user->email_verified_at)->not->toBeNull()
        ->and($user->tokens)->toHaveCount(1);
});

test('mobile api login rejects an unverified Google identity', function () {
    config(['services.google.client_id' => 'mobile-google-client-id']);

    $verifier = Mockery::mock(GoogleIdTokenVerifier::class);
    $verifier->shouldReceive('verify')
        ->once()
        ->andReturn([
            'sub' => 'google-user-123',
            'email' => 'mobile.student@example.com',
            'email_verified' => false,
        ]);
    $this->app->instance(GoogleIdTokenVerifier::class, $verifier);

    $this->postJson('/api/auth/google', [
        'idToken' => 'google-id-token',
    ])->assertUnauthorized()
        ->assertJsonPath('success', false);

    $this->assertDatabaseMissing('users', [
        'email' => 'mobile.student@example.com',
    ]);
});
