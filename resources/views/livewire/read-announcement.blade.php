<div>
    <ul class="announcement-categories" id="categories-list">
        @foreach($categories as $category)
        <li wire:key="category-{{ $category->id }}"
            wire:click="selectCategory({{ $category->id }})"
            class="announcement-category {{ $activeCategoryId === $category->id ? 'is-active' : '' }}">
            {!! $category->svg !!}
            <h2 class="announcement-category-title">{{ $category->name }}</h2>
        </li>
        @endforeach
    </ul>

    @foreach($categories as $category)
    @if($activeCategoryId === $category->id)
    <ul class="announcement-subcategories" wire:key="content-{{ $category->id }}">
        @foreach($category->subcategories as $subcategory)
        <li class="announcement-subcategory">
            <h3 class="announcement-subcategory-title">{{ $subcategory->name }}</h3>
        </li>
        @endforeach
    </ul>
    @endif
    @endforeach
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categoriesList = document.getElementById('categories-list');

            // Подписываемся на клики по категориям
            categoriesList.addEventListener('click', function(event) {
                event.preventDefault(); // Предотвращаем стандартное поведение клика

                // Возвращаем прокрутку к началу
                categoriesList.scrollLeft = 0;
            });
        });
    </script>
</div>