<?php

use App\Models\User;

describe('API rate limiting', function () {
    it('allows guests up to 20 requests per day', function () {
        for ($i = 0; $i < 20; $i++) {
            $this->getJson('/v1/profile')->assertStatus(404);
        }

        $this->getJson('/v1/profile')->assertTooManyRequests();
    });

    it('allows token holders more than 20 requests per day', function () {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        for ($i = 0; $i < 21; $i++) {
            $this->withToken($token)->getJson('/v1/profile')->assertStatus(404);
        }
    });
});
