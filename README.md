# Woot! Le site du WAQ 2012

> C'est comme du custom de A à Z (yé pour les geeks). L'objectif est d'offrir un admin rapidement au gens du WAQ afin qu'ils puissent travailler à mettre en ligne l'horaire, ainsi que de permettre la navigation du beau site de l'événement.

## Contributing to WAQ

### Quick start

    git submodule update --init
    touch app/settings.php
    cp app/shared/conf.example.php app/shared/conf.php
    php -S localhost:8000 -t app/frontend/http_serve/

### MySQL to Sqlite for archive deployment

    gem install mysql2 sqlite3 sequel
    sequel mysql2://root:@localhost/webaquebec2012 -C sqlite://db.sqlite

## Deployment

Setup :

    git remote add heroku git@heroku.com:webaquebec2012.git
    heroku config:push

Deployment :

    git push heroku master

1. http://webaquebec2012.herokuapp.com
2. http://d287qcq154aswz.cloudfront.net
3. http://2012.webaquebec.org

### Admin Users

To create a user in the admin panel:

* Enable the debug mode in config file
* Go to domain.com/hash/password-to-hash (replace password-to-hash with the password you whant to hash).
Example : domain.com/hash/my-secret-password
* Add the user to the users array in config.php


