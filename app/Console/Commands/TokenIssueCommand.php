<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokenIssueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:issue {name : The name for this token (e.g. "Acme Corp")}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Issue an API token for a named recipient';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $slug = Str::slug($name);
        $email = "{$slug}@token.local";

        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make(Str::random(32))],
        );

        $token = $user->createToken($name)->plainTextToken;

        $this->info("Token issued for: {$name}");
        $this->line($token);

        return self::SUCCESS;
    }
}
