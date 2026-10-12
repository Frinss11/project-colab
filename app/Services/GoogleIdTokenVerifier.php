<?php

namespace App\Services;

use Google\Client;
use UnexpectedValueException;

class GoogleIdTokenVerifier
{
    /**
     * Verify a Google ID token for the configured mobile client.
     */
    public function verify(string $idToken, string $clientId): ?array
    {
        try {
            $payload = (new Client(['client_id' => $clientId]))->verifyIdToken($idToken);
        } catch (UnexpectedValueException) {
            return null;
        }

        return is_array($payload) ? $payload : null;
    }
}
