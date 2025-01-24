@php
    $categories = \App\Models\Category::where('show_menu', true)
        ->whereNull('parent_id')
        ->defaultOrder()
        ->withDepth()
        ->get()
        ->toFlatTree();
@endphp



@push('styles')
    <style>
        @media all and (min-width: 992px) {
            .dropdown-menu li {
                position: relative;
            }

            .nav-item .submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
            }

            .nav-item .submenu-left {
                right: 100%;
                left: auto;
            }

            .dropdown-menu>li:hover {
                background-color: red;
            }

            .dropdown-menu>li:hover>.submenu {
                display: block;
            }
        }

        @media (max-width: 991px) {
            .dropdown-menu .dropdown-menu {
                margin-left: 0.7rem;
                margin-right: 0.7rem;
                margin-bottom: .5rem;
            }
        }
    </style>
@endpush

<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active"> <a class="nav-link" href="{{ route('home') }}">Trang chủ </a> </li>

                @foreach ($categories as $category)
                    @if ($category->children->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="{{ route('product.index', ['category' => $category->slug]) }} "
                                data-bs-toggle="dropdown">{{ $category->name }}</a>
                            <ul class="dropdown-menu">
                                @foreach ($category->children as $child)
                                    @if ($child->children->count() > 0)
                                        <li>
                                            <a class="dropdown-item dropdown-toggle"
                                                href="{{ route('product.index', ['category' => $child->slug]) }} ">{{ $child->name }}</a>
                                            <ul class="dropdown-menu">
                                                @foreach ($child->children as $subChild)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('product.index', ['category' => $subChild->slug]) }} ">{{ $subChild->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('product.index', ['category' => $child->slug]) }} ">{{ $child->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('product.index', ['category' => $category->slug]) }} ">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
@endpush
