<!-- Sobre o Sistema -->

Um sistema simples para o cadastro de participantes e sorteio deles para o amigo secreto, com o nome sorteado sendo enviado para o email de cada participante!

O Sistema foi desenvolvido na versão 8.1 do PHP e 10.32.1 do framework Laravel,utilizando do adminlte na versão 3.9 e laravel UI na versão 4.2, além do bootstrap 4.

O banco de dados utilizado foi o MySQL Server 8.2.

<!-- Configurações do sistema -->

Após clonar o repositório, seguir os seguintes passos:

1- No terminal, navegue até a pasta do projeto e de os seguintes comandos?:

 # Configurações das dependências e do .env
    -cp .env.example .env
    -composer install
    -php artisan key:generate

2- Após isso, mude o nome do env para .env, e configure os campos abaixo:

# Crie o Banco de dados e o configure no .env:
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=secretsanta
        DB_USERNAME=root
        DB_PASSWORD=root

# Configurações de Email (SMTP)
        MAIL_MAILER=smtp
        MAIL_HOST=127.0.0.1
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS=naoresponda@unimontes.br
        MAIL_FROM_NAME="${APP_NAME}"



3- Rode as migrations e seeds: 

php artisan migrate:fresh --seed


<!-- Como usar o sistema -->


# No terminal, após as configurações, vá até a pasta do projeto e de o comando:

php artisan serve

observação: O link para acesso deverá ser configurado no .env, no campo APP_URL, por padrão será http://localhost

# Abra o link que aparecer, e em seguida registre-se e faça o login!

# No sistema, cada usuário poderá cadastrar os seus participantes, e coloca-los para o sorteio!

# Quando sorteados, o sistema irá embaralhar os nomes, e sortea-los de modo que a mesma pessoa não saia duas vezes nem tire a si mesma

# Cadastre o nome do participante e o seu email, pois o amigo secreto dos participantes será enviado por e-mail!














<!-- About Laravel -->
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p> -->

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
