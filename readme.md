# Fanampy DEV

Plateform partage

![FanampyDev](https://raw.githubusercontent.com/herival/FanampyDev/master/public/assets/img/illustration.png)

- Specs :
```
 - symfony => 5.1
 - Webpack for assets management
```

## Requirements:

```
- php v^7.4
- Docker
- Little symfony skills.
- Motivation and feeling
```

## Installation :

```
- git clone your_fork.git
- cd FanampyDev
- composer install
- docker-compose up -d
```

- Update the database configuration in `.env` to follow your own environment.

## Database:

```
- bin/console doctrine:database:create
- bin/console doctrine:migration:migrate
```

# TODO :

```
- Manage security.
- Manage adminstration back office.
- Your ideas ...
```

