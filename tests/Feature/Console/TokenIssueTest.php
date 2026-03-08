<?php

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

describe('token:issue command', function () {
    it('creates a user and outputs a token', function () {
        $this->artisan('token:issue', ['name' => 'Acme Corp'])
            ->assertSuccessful()
            ->expectsOutputToContain('Acme Corp')
            ->expectsOutputToContain('|');

        expect(User::where('email', 'acme-corp@token.local')->exists())->toBeTrue();
        expect(PersonalAccessToken::where('name', 'Acme Corp')->exists())->toBeTrue();
    });

    it('reuses an existing user when issued again', function () {
        $this->artisan('token:issue', ['name' => 'Acme Corp'])->assertSuccessful();
        $this->artisan('token:issue', ['name' => 'Acme Corp'])->assertSuccessful();

        expect(User::where('email', 'acme-corp@token.local')->count())->toBe(1);
        expect(PersonalAccessToken::where('name', 'Acme Corp')->count())->toBe(2);
    });
});
