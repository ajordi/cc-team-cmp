Test assignment
===============

Requirements
-------------

- Docker https://docs.docker.com/engine/installation

Spin up containers:
-------------------

```bash
$ docker-compose up -d --build
```

Assignment
----------

[Link to assignment](https://github.com/CMProductions/backend-test)

Run Import command
------------------

```sh
# Glorf file
$ docker-compose exec php bin/console video:import glorf
# Flub file
$ docker-compose exec php bin/console video:import flub
```
Run Unit tests
--------------

```sh
$ docker-compose exec -T php /usr/local/bin/php -d xdebug.remote_enable=0 -d xdebug.profiler_enable=0 -d xdebug.default_enable=0 ./vendor/bin/simple-phpunit --testsuite=unit-tests
```

Check code style
----------------

```sh
$ docker-compose exec -T php /usr/local/bin/php -d xdebug.remote_enable=0 -d xdebug.profiler_enable=0 -d xdebug.default_enable=0 ./vendor/bin/phpcs --standard=PSR2,PSR1 src
```

Todo
----

- [ ] Complete code coverage
- [ ] Add functional tests 
