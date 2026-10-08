<?php

test('google login asks Google to show the account chooser', function () {
    $response = $this->get(route('google.redirect'));

    $response->assertRedirect();

    parse_str(parse_url($response->headers->get('Location'), PHP_URL_QUERY) ?? '', $query);

    expect($query['prompt'] ?? null)->toBe('select_account');
});
