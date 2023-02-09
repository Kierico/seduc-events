# Seduc Events

## #02 Install

[XAMPP](https://www.apachefriends.org/pt_br/index.html)

[COMPOSER](https://getcomposer.org/)

## Criar Projeto

`composer create-project --prefer-dist laravel/laravel seducevents`

## Rodar o server

`php artisan serve`

>Se der erro ao rodar o server, execute 'composer update' ou 'composer install'.

<hr><br>

## #07 Criando Layout, add Google Fontes e Bootstrap

[Google Fontes](https://fonts.google.com/)

[Bootstrap](https://getbootstrap.com/)

<hr><br>

## #09 Criando Controllers

`php artisan make:controller EventController`

### install Ionicons

[Ionicons](https://ionic.io/ionicons/)

<hr><br>

## #10 Conexão ao banco de dados

No arquivo '.env' na raiz, atualizar o 'DB_DATABASE' com o nome do banco 'seducevents'.

`php artisan migrate`

<hr><br>

## #11 Introdução a Migrations do Laravel

Criar:

`php artisan make:migration create_events_table`

Status:

`php artisan migrate:status`

* :fresh = "CUIDADO!" Apaga toda a tabela e cria novamente (apaga os dados existentes);
* :refresh = volta todas e roda o Migrate novamente;
* :rollback = utilizado para voltar uma migration;
* :reset = voltar todas.

Rodar:

`php artisan migrate`

<hr><br>

## #12 Avançando em Migrations do Laravel

Add:

`php artisan make:migration add_name_to_events_table`

<hr><br>

## #13 Utilizando o Eloquent do Laravel (Model)

`php artisan make:model Event`

> aqui eu criei na mão mesmo dados no banco de dados (XAMPP).

<hr><br>

## #17 Upload de imagens com Laravel

Add:

`php artisan make:migration add_image_to_events_table`

Rodar:

`php artisan migrate`

<hr><br>

## #19 Salvando JSON no banco de dados

`php artisan make:migration add_items_to_events_table`

<hr><br>

## #20 Salvando datas no banco de dados

`php artisan make:migration add_date_to_events_table`

<hr><br>

## #22 Autenticação no Laravel (login/registro)

`composer require laravel/jetstream`

`php artisan jetstream:install livewire`

`npm install`

`npm run dev`

<hr><br>

## #23 Relação One to Many

`php artisan make:migration add_user_id_to_events_table`

`php artisan migrate`

>Se não rodar exculte no terminal `php artisan migrate:fresh`, e depois rode novamente `php artisan migrate`

### Middleware('auth'), é uma forma de só quem esta logado poder acessar uma página.

<hr><br>

## #25 Criando uma Dashboard

> Copiar o arquivo 'dashboard.blade.php' de 'profile' para 'events'.

<hr><br>

## #28 Relação Many to Many

`php artisan make:migration create_event_user_table`

`php artisan migrate`

