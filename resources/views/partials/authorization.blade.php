<form id="loginForm" class="authorizationForm" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="authclosebtn">X</div>
    <div class="authorizationFormat">Авторизация</div>
    <div class="authorizationInput">
        <input name="email" type="email" placeholder="email..." value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif

        <input name="password" type="password" placeholder="pass..." required>
        @if ($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="authbtn">
        <button class="authorizationBtn" type="submit">Войти</button>
        <a class="authorizationchoice" id="registerChoice" href="#">Ещё нет аккаунта?</a>
    </div>
</form>
<form id="registerForm" class="authorizationForm" action="{{ route('register') }}" method="POST">
    @csrf
    <div class="authclosebtn">X</div>
    <div class="authorizationFormat">Регистрация</div>
    <div class="authorizationInput">
        <input name="name" type="text" placeholder="Имя..." value="{{ old('name') }}" required>
        @if ($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif

        <input name="email" type="email" placeholder="email..." value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif

        <input name="password" type="password" placeholder="Пароль..." required>
        @if ($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif

        <input name="password_confirmation" type="password" placeholder="Повторите пароль..." required>
    </div>
    <div class="authbtn">
        <button class="authorizationBtn" type="submit">Регистрация</button>
        <a class="authorizationchoice" id="loginChoice" href="#">Уже есть аккаунт?</a>
    </div>
</form>
