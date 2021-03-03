#!/bin/bash

php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=ConfigsSeeder