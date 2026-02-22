<div class="announcement-photos">
    @forelse($announcement->images as $image)
        <div class="photo-item" style="margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $image->path) }}" 
                 alt="Фото к объявлению {{ $announcement->title }}"
                 style="max-width: 100%; height: auto; border-radius: 8px; display: block;">
        </div>
    @empty
        <p>Фотографии отсутствуют</p>
    @endforelse
</div>

<div class="announcement-content">
    <h1>{{ $announcement->title }}</h1>
    <p>{{ $announcement->text }}</p>
    <p>Автор: {{ $announcement->user->name }}</p>
</div>
