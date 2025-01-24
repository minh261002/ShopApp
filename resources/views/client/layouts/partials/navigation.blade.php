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
        <div class="collapse navbar-collapse text-center" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active"> <a class="nav-link" href="{{ route('home') }}">Trang chủ </a> </li>

                {{-- <li class="nav-item dropdown" id="myDropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Treeview menu </a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="#"> Dropdown item 1 </a></li>
                        <li> <a class="dropdown-item" href="#"> Dropdown item 2 &raquo; </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
                                <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
                                <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
                                    <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Multi level 1</a></li>
                                        <li><a class="dropdown-item" href="#">Multi level 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
                                <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 3 </a></li>
                        <li><a class="dropdown-item" href="#"> Dropdown item 4 </a></li>
                    </ul>
                </li> --}}

                @foreach ($categories as $category)
                    @if ($category->children->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href=""
                                data-bs-toggle="dropdown">{{ $category->name }}</a>
                            <ul class="dropdown-menu">
                                @foreach ($category->children as $child)
                                    @if ($child->children->count() > 0)
                                        <li>
                                            <a class="dropdown-item dropdown-toggle"
                                                href="">{{ $child->name }}</a>
                                            <ul class="dropdown-menu">
                                                @foreach ($child->children as $subChild)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('category.show', $subChild->slug) }}">{{ $subChild->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="">{{ $child->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.innerWidth < 992) {

                document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                    everydropdown.addEventListener('hidden.bs.dropdown', function() {
                        this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                            everysubmenu.style.display = 'none';
                        });
                    })
                });

                document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                    element.addEventListener('click', function(e) {
                        let nextEl = this.nextElementSibling;
                        if (nextEl && nextEl.classList.contains('submenu')) {
                            e.preventDefault();
                            if (nextEl.style.display == 'block') {
                                nextEl.style.display = 'none';
                            } else {
                                nextEl.style.display = 'block';
                            }

                        }
                    });
                })
            }
        });
    </script>
@endpush
