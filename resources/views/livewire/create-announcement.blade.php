<div>
    <form wire:submit.prevent="save">
        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="form-item">
            <label for="title">Заголовок</label>
            <input type="text" wire:model="title" id="title" placeholder="Заголовок">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-item">
            <label for="text">Текст</label>
            <textarea wire:model="text" id="text" placeholder="Текст"></textarea>
            @error('text') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-item">
            <label for="action">Действие</label>
            <select wire:model="action" id="action">
                <option value="">Выберите действие</option>
                <option value="Покупка">Покупка</option>
                <option value="Продажа">Продажа</option>
                <option value="Аренда">Аренда</option>
                <option value="Другое">Другое</option>
            </select>
        </div>
        <div class="form-item">
            <label for="category">Категория</label>
            <select wire:model.live="category_id" id="category">
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @if(!empty($subcategories) && count($subcategories) > 0)
        <div class="form-item">
            <label for="subcategory">Подкатегория</label>
            <select wire:model="subcategory_id" id="subcategory">
                <option value="">Выберите подкатегорию</option>
                @foreach($subcategories as $sub)
                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit">Сохранить объявление</button>
    </form>
</div>