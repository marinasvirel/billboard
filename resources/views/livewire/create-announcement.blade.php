<div>
    <form wire:submit.prevent="save">
        @if (session()->has('message'))
        <div class="alert-message">{{ session('message') }}</div>
        @endif
        <div class="form-item">
            <label for="title" class="create-label">Заголовок</label>
            <input type="text" wire:model="title" id="title" placeholder="Заголовок">
            @error('title') <span class="error-box">{{ $message }}</span> @enderror
        </div>
        <div class="form-item">
            <label for="text" class="create-label">Текст</label>
            <textarea wire:model="text" id="text" placeholder="Текст"></textarea>
            @error('text') <span class="error-box">{{ $message }}</span> @enderror
        </div>
        <div class="form-item">
            <label for="action" class="create-label">Действие</label>
            <select wire:model="action" id="action">
                <option value="">Выберите действие</option>
                <option value="Покупка">Покупка</option>
                <option value="Продажа">Продажа</option>
                <option value="Аренда">Аренда</option>
                <option value="Другое">Другое</option>
            </select>
            @error('action') <span class="error-box">{{ $message }}</span> @enderror
        </div>
        <div class="form-item">
            <label for="category" class="create-label">Категория</label>
            <select wire:model.live="category_id" id="category">
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="error-box">{{ $message }}</span> @enderror
        </div>
        @if(!empty($subcategories) && count($subcategories) > 0)
        <div class="form-item">
            <label for="subcategory" class="create-label">Подкатегория</label>
            <select wire:model="subcategory_id" id="subcategory">
                <option value="">Выберите подкатегорию</option>
                @foreach($subcategories as $sub)
                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
            @error('subcategory_id') <span class="error-box">{{ $message }}</span> @enderror
        </div>
        @endif
        <div class="form-item">
            <label for="images" class="create-label">Фотографии (не более шести)</label>
            <input type="file" wire:model="images" id="images" multiple accept="image/*">
            <!-- Индикатор загрузки -->
            <div wire:loading wire:target="images">Загрузка...</div>
            @if ($images)
            <div class="preview-container" style="display: flex; gap: 10px; margin-top: 10px;">
                @foreach ($images as $image)
                <img src="{{ $image->temporaryUrl() }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                @endforeach
            </div>
            @endif
            @error('images.*') <span class="error">{{ $message }}</span> @enderror
            @error('images') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Сохранить объявление</button>
    </form>
</div>