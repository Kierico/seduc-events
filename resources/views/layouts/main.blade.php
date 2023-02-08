<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Fonts Preconnect -->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kiérico Souza">

        <title>@yield('title')</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="http://www.educacao.am.gov.br/wp-content/themes/seduc/images/favicon.ico" type="image/x-icon"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Roboto:wght@400&display=swap" rel="stylesheet"/>

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        
        <!-- CSS da Aplicação -->
        <link rel="stylesheet" href="/css/styles.css"/>

        <!-- JavaScript -->
        <script src="/js/scripts.js"></script>
    </head>
    <body>
        @yield('content')
        <footer>
            <p>Seduc Events &copy; 2023</p>
        </footer>
    </body>
</html>
