# Ticket API

A basic Ticket API and Small Frontend

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell)
4. Run `npm install` in the container
5. Run the frontend dev server with `yarn encore dev-server`
6. Open `https://localhost/home` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334) to see the frontend
7. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Features

* List Events and Tickets
* Add Events and Tickets

## Endpoints

Path            | Method | Auth |Response               |Body
----------------|--------|------|-----------------|-----
/events	        |GET	 | no  | List of events
/events/{id}	|GET	 | no  | {message: 'I\'m fine'}
/events        	|POST	 | no  | Newly created event | Example: {"title": "Concert Shakira","date": "2023-01-21 10:01:19","city": "Frankfurt"}
/events/{id}/tickets |GET	 | no  | Tickets of the given event 

## Tests

This project use Codeception to test the API Endpoints. Run the tests locally with `php vendor/bin/codecept run --steps`
## Further Development

* Validate 404
* Improve Frontend
* Improve validation for single fields
* Create custom Response classes for common cases
* Create Test database to avoid DB pollution
* Unify name and firstname
* Prefix API ULRs

**Enjoy!**

## Credits

Symfony Docker template reated by [Kévin Dunglas](https://dunglas.fr), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
