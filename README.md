# SPA WebSite using Laravel and Vue
Este projeto consiste na criação de uma aplicação web, com foco no SPA e em Engenharia de Requisitos, utilizando as framework Laravel e Vue. Para este projeto foi elaborado uma identificação do âmbito, visão, stakeholders e funcionalidades nucleares ao projeto. De seguida foi elicitado os requisitos de tecnologa, negocio, de utilizador, funcionais, não funcionais e de dados, em conjunto com ma tabela de rastreio com prioridades. Por fim, foi construido os diagramas: conxtetual, fluxo de dados, swimlane e use Case. 

diagramas use-case, uma tabela de
rastreio e uma tabela de priorização, tornando assim logisticamente possível desenvolver a
LetMeFix.

# Laravel-Vue-SPA

This repository is the result of creating a SPA (Single Page Application) with role-based authentication with Laravel and Vue.
## Prerequiries

- PHP 7
- Composer
- NodeJs
- MySQL

## Installation

- Clone the repository
- Installer back dependencies with `composer install`
- Install front dependencies with `npm i`
- Copy file `.env.example` in `.env` and add following informations:
    - Database credentials (`DB_HOST`, `DB_PORT`, ...)
    - Application url (`APP_URL`). Either virtual host address if you configure one, either address form the command `php artisan serve`
- Generate application key with `php artisan key:generate`
- Generate JWT key with `php artisan jwt:secret`
- Launch migrations with `php artisan migrate --seed`.
- Build front with `npm run dev`

If you did'nt set a virtual host, launch application with the `php artisan serve` command. By default, application will be served at `http://127.0.0.1:8000`

## Configuration

You can change the length of time (in minutes) that the token will be valid for by changin the `JWT_TTL` value in the `.env` file.

## Usage

Log as admin with `admin@test.com:admin` or as user with `user@test.com:secret`
