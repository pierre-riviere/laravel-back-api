# INSTALL (tested with php 7.4.3 / mysql 8.0.22)

sudo apt install composer

composer global require laravel/installer

composer install

# SERVE

php artisan serve

example to get Marvel characters by start name : http://localhost:8000/api/marvel/characters?limit=10&offset=0&nameStartsWith=spider
