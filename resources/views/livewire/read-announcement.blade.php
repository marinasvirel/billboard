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
        <li class="announcement-subcategory {{ $activeSubcategoryId === $subcategory->id ? 'is-active' : '' }}" wire:key="sub-{{ $subcategory->id }}" wire:click="selectSubcategory({{ $subcategory->id }})" >
            <h3 class="announcement-subcategory-title">{{ $subcategory->name }}</h3>
        </li>
        @endforeach
    </ul>
    @endif
    @endforeach

    <div wire:key="announcements-area" class="announcements-area">
        @if($selectedSubcategory)
        @forelse($selectedSubcategory->announcements as $announcement)
        <a href="{{ route('announcements.show', $announcement) }}" target="_blank">
            <div wire:key="ann-{{ $announcement->id }}" class="announcement-item">
                <div class="announcement-img-box"></div>
                <div class="announcement-text-box">
                    <h4 class="announcement-title">{{ $announcement->title }}</h4>
                    <p class="announcement-text">{{ $announcement->text }}</p>
                </div>
            </div>
        </a>
        @empty
        <p class="announcement-null">Объявлений нет</p>
        @endforelse
        @endif
    </div>

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