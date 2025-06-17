@extends('layouts.blueprint')
@section('fastfood')
    <div class="ffh1">Быстрые блюда<br>Приготовьте себе сытную еду за короткий срок</div>
    <div class='recipecount'>
        Всего рецептов: {{ $recipes->count() }}
    </div>

    @auth
        @if(Auth::user()->is_admin)
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div style='text-align:center;'>
                <form action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Изображение:</label><br>
                    <input type="file" name="imgpath" accept="image/*" required><br>
                    @error('imgpath') <div>{{ $message }}</div> @enderror

                    <label>Название рецепта:</label><br>
                    <input type="text" name="name" value="{{ old('name') }}" required><br>
                    @error('name') <div>{{ $message }}</div> @enderror

                    <label>Описание:</label><br>
                    <textarea name="description" required>{{ old('description') }}</textarea><br>
                    @error('description') <div>{{ $message }}</div> @enderror

                    <label>Время приготовления:</label><br>
                    <input type="text" name="timeforcooking" value="{{ old('timeforcooking') }}" required><br>
                    @error('timeforcooking') <div>{{ $message }}</div> @enderror

                    <label>Калории:</label><br>
                    <input type="text" name="amountofcalories" value="{{ old('amountofcalories') }}" required><br>
                    @error('amountofcalories') <div>{{ $message }}</div> @enderror

                    <label>Порции:</label><br>
                    <input type="number" name="servings" value="{{ old('servings') }}" required><br>
                    @error('servings') <div>{{ $message }}</div> @enderror

                    <label>Инструкция по приготовлению:</label><br>
                    <textarea name="instruction" required>{{ old('instruction') }}</textarea><br>
                    @error('instruction') <div>{{ $message }}</div> @enderror

                    <label>Ингредиенты:</label><br>
                    <div id="ingredients-container">
                        <div>
                            <input type="text" name="ingredients[0][name]" placeholder="Название" required>
                            <input type="text" name="ingredients[0][amount]" placeholder="Количество" required>
                        </div>
                    </div>
                    <button type="button" onclick="addIngredient()">Добавить ингредиент</button><br><br>

                    <button type="submit">Добавить рецепт</button>
                </form>
            </div>
        @endif
    @endauth

    <div class="ffrs">
        @foreach ($recipes as $recipe)
            <div class="recipe1" id="recipe-{{ $recipe->id }}">
                <img class="recipeimg" src="{{ asset(str_replace('public/', '', $recipe->imgpath)) }}"
                    alt="{{ $recipe->name }}">
                <div class="recipe1txt">{{ $recipe->name }}</div>
                <div class="recipe1txt2">{{ $recipe->description }}</div>
                <div class="clock-warp">
                    <img class="clockrecipe1" src="/Image/clock.jpg" alt="">
                    <div class="clockrecipe1txt">{{ $recipe->timeforcooking }} Минут</div>
                </div>
                <div class="calories-warp">
                    <img class="caloriesrecipe1" src="/Image/calories.jpg" alt="">
                    <div class="caloriesrecipe1txt">{{ $recipe->amountofcalories }} Калорий</div>
                </div>
                <button class="recipe1btn" type="button" onclick="openModal({{ $recipe->id }})">Читать подробнее</button>

                @auth
                    @if (auth()->user()->is_admin)
                        <button class="recipe1btn delete-btn" onclick="deleteRecipe({{ $recipe->id }})">Удалить</button>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>


    <div class="overlay" id="recipeOverlay">
        <div class="modal">
            <div class="close-button" onclick="closeModal()">X</div>
            <div class="modalname" id="modalName"></div>
            <div class="modalcookandtime">
                <div class="modalcook"><img src="/Image/icon-park-outline_pot.svg"><span id="modalServings"></span> порции
                </div>
                <div class="modaltime"><img src="/Image/mdi_clock-outline.svg"><span id="modalTime"></span>минут</div>
            </div>
            <div class="modalimg">
                <img id="modalImg" src="" alt="Фото рецепта">
            </div>
            <div class="ingr">Ингредиенты</div>
            <ul class="ingredients" id="modalIngredients"></ul>
            <h3 class="inst">Инструкция приготовления</h3>
            <ol class="instructions" id="modalInstructions"></ol>
        </div>
    </div>

@endsection