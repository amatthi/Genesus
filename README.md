# Chisel

## install

- clone this repository

- set the web root at `/public`

- set virtual host and local url , like: http://chisel.local

- install comopser

- run `composer update`

- add .env file ( fill with .env.example)

- run `php artisan key:generate`

- run `php artisan migrate`

- install npm

- run `npm install`

- run `gulp`

## deploy

- run `php dep deploy production`

## pull
sometimes pull needs do something new in command line

- check `.env` file's field is like `.env.example` , if not , fill `.env` file with `.env.example`

- run `composer update`

- run `php artisan migrate`

- run `npm install`

- run `gulp`

## add a page

- create `example.html` at `/public/html`

- add $routeProvider at `/resources/js/main.js`

- (if need) add controller `example.js` at /resources/js/controllers

- code them
