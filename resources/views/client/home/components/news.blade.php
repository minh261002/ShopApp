<div class="pb-5 w-100">
    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
        <h1 class="mb-0 text-danger fs-20px fw-semibold text-uppercase">Tin tức</h1>
        <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1737562155/Pengu/icon_yl8py7.svg" alt="">
    </div>
    <div class="wrap-content">
        <div class="list-news">
            @foreach ($posts as $post)
                @if ($loop->first)
                    <div class="news-left">
                        <a href="#">
                            <img src="{{ asset($post->image) }}" alt="">
                        </a>
                        <a href="#" class="news-title_left">
                            {{ $post->title }}
                        </a>
                        <p class="news-desc">
                            {{ $post->meta_description }}
                        </p>
                    </div>
                @endif

                <div class="news-right">
                    @if ($loop->first)
                        @continue
                    @endif
                    <div class="news-item">
                        <a href="#">
                            <img src="{{ asset($post->image) }}" alt="">
                        </a>
                        <div class="news-item_content">
                            <a href="#" class="news-title">
                                {{ $post->title }}
                            </a>
                            <p class="news-desc">
                                {{ $post->meta_description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
@endpush
