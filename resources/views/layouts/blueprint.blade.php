<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="{{ asset('js/account.js') }}"></script>
    <script defer src="{{ asset('js/recipe.js') }}"></script>
    <script defer src="{{ asset('js/comment.js') }}"></script>
    <script defer src="{{ asset('js/category.js') }}"></script>
    <script defer src="{{ asset('js/dropdownlist.js') }}"></script>
    <script defer src="{{ asset('js/recipeadd.js') }}"></script>
    <script defer src="{{ asset('js/modal.js') }}"></script>
    <script defer src="{{ asset('js/recipedelete.js') }}"></script>
    <script defer src="{{ asset('js/search.js') }}"></script>

    <title>ВкусДома кулинарные рецепты</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap');
    </style>
</head>

<body>
    <div class="wrapper">
        @include('partials.header')
        <main>
            <div class="autoFormfon">
            </div>
            @yield(section: 'index')
            @yield('category')
            @yield('contact')
            @yield('fastfood')
            @include('partials.dropdownMenu')
        </main>
        @include('partials.footer')
        @include('partials.authorization')
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->has('email') || $errors->has('password'))
            document.querySelector(".autoFormfon").classList.add("open");
            document.getElementById("loginForm").classList.add("open");
        @elseif ($errors->has('name'))
            document.querySelector(".autoFormfon").classList.add("open");
            document.getElementById("registerForm").classList.add("open");
        @endif
    });
</script>

</html>