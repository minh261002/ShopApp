<div class="py-5">
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if ($slider)
                @forelse ($slider->items as $item)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ $item->image }}" class="d-block w-100" alt="{{ $item->title }}">
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/1920x1080" class="d-block w-100" alt="Placeholder">
                    </div>
                @endforelse
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
