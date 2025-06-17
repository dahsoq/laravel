<nav id="dropdown-menu" class="dropdown-menu">
    <ul>
        <li><a href="/">Главная</a></li>
        <li><a href="/category">Рецепты</a></li>
        <li><a href="/blog">Блог</a></li>
        <li><a href="/contact">Контакты</a></li>

        @auth
            <li><a href="/profile">Личный кабинет</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class = 'quit'type="submit" >
                        Выйти
                    </button>
                </form>
            </li>
        @else
            <li><a class="accountcab" role="button">Личный кабинет</a></li>
        @endauth

        <li><a href="/favorit">Избранные рецепты</a></li>
    </ul>
</nav>
