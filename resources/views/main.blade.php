@extends('layouts.blueprint');
@section('index')
    <div class="main_block">
        <div class="mh">Готовим вкусно и просто!</div>
        <div class="mh2">Найди свой идеальный рецепт</div>
        <div class="mbt"><button class="button1">Посмотреть рецепты</button></div>
    </div>
    <div class="favor">Популярные рецепты</div>
    <div class="tire"></div>
    <div class="favortxt">Здесь размещаются карточки с рецептами, актуальными и интересными для наших посетителей.
    </div>
    <div class="favor">Комментарии</div>
    <div class="tire"></div>
    <div class="favortxt">Здесь вы можете оставить свое мнение о сайте</div>
    <form id="commentForm" class='commentForm'>
        <input type="text" id="username" class="username" placeholder="Ваше имя">
        <textarea type="text" id="commentText" class="commentText" placeholder="Ваш комментарий"></textarea>
        <button type="submit" class="commentbtn">Оставить комментарий</button>
    </form>
    <div id="commentsContainer"></div>
    </main>
@endsection