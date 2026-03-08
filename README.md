# Personal Portfolio API

A REST API that powers my personal portfolio site. Exposes profile info, projects, and technologies.

[![Tests](https://github.com/sethingham/api/actions/workflows/tests.yml/badge.svg)](https://github.com/sethingham/api/actions/workflows/tests.yml) ![Deploy to Cloud Run](https://github.com/sethingham/api/actions/workflows/deploy.yml/badge.svg) 

## Endpoints

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/api/v1/profile` | Profile / about info |
| GET | `/api/v1/projects` | List all projects |
| GET | `/api/v1/projects/{project}` | Single project |
| GET | `/api/v1/technologies` | List all technologies |

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
