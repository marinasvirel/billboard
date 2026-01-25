<form wire:submit.prevent="save">
    <!-- Категории -->
    <div class="form-item">
        <label for="category">Категория</label>
        <select wire:model.live="selectedCategory" id="category">
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Подкатегории (появляются только если выбрана категория и в ней есть данные) -->
    @if(!empty($subcategories))
    <div class="form-item">
        <label for="subcategory">Подкатегория</label>
        <select wire:model="selectedSubcategory" id="subcategory">
            <option value="">Выберите подкатегорию</option>
            @foreach($subcategories as $sub)
            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    <button type="submit">Отправить</button>
</form>