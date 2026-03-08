<?php

use Illuminate\Http\Middleware\TrustHosts;

describe('TrustHosts middleware', function () {
    it('trusts the application URL host', function () {
        config(['app.url' => 'https://api.iamseth.com']);

        expect((new TrustHosts(app()))->hosts())
            ->toContain('^(.+\.)?api\.iamseth\.com$');
    });

    it('trusts localhost in local development', function () {
        config(['app.url' => 'http://localhost']);

        expect((new TrustHosts(app()))->hosts())
            ->toContain('^(.+\.)?localhost$');
    });
});
