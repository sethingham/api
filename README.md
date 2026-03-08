# Personal Portfolio API

A REST API that powers my personal portfolio site. Exposes profile info, projects, and technologies.

[![Tests](https://github.com/sethingham/api/actions/workflows/tests.yml/badge.svg)](https://github.com/sethingham/api/actions/workflows/tests.yml) ![Deploy to Cloud Run](https://github.com/sethingham/api/actions/workflows/deploy.yml/badge.svg) 

## Give it a try

Not sure where to start? This will show you around...

```bash
curl https://api.iamseth.com/v1
```

Want to know a bit more about me?

```bash
curl https://api.iamseth.com/v1/profile
```

Curious what I've been building?

```bash
curl https://api.iamseth.com/v1/projects
```

Want to dig into a specific project?

```bash
curl https://api.iamseth.com/v1/projects/{id}
```

What's in my tech stack?

```bash
curl https://api.iamseth.com/v1/technologies
```

## Setup

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
```

Or use the setup script:

```bash
composer run setup
```

## Running Locally

```bash
composer run dev
```

## Testing

```bash
composer run test
```
