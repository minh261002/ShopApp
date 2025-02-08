<?php

return [
    [
        'active' => ['admin.notification.*'],
        'show' => ['admin.notification.*'],
        'title' => 'Thông báo',
        'icon' => 'ti ti-bell fs-2',
        'permission' => ['viewCategory', 'createCategory', 'editCategory', 'deleteCategory'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.category.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createCategory'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.category.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewCategory'
            ]
        ]
    ],
    [
        'active' => ['admin.media.*'],
        'show' => ['admin.media.*'],
        'title' => 'Tệp tin',
        'icon' => 'ti ti-files fs-2',
        'permission' => ['viewMedia', 'createMedia', 'editMedia', 'deleteMedia'],
        'children' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.media.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewMedia'
            ]
        ]
    ],
    [
        'active' => ['admin.category.*'],
        'show' => ['admin.category.*'],
        'title' => 'Danh mục',
        'icon' => 'ti ti-category-2 fs-2',
        'permission' => ['viewCategory', 'createCategory', 'editCategory', 'deleteCategory'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.category.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createCategory'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.category.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewCategory'
            ]
        ]
    ],
    [
        'active' => ['admin.product.*'],
        'show' => ['admin.product.*'],
        'title' => 'Sản phẩm',
        'icon' => 'ti ti-package fs-2',
        'permission' => ['viewProduct', 'createProduct', 'editProduct', 'deleteProduct'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.product.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createProduct'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.product.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewProduct'
            ]
        ]
    ],
    [
        'active' => ['admin.order.*'],
        'show' => ['admin.order.*', 'admin.transaction.*', 'admin.shipping.*'],
        'title' => 'Đơn hàng',
        'icon' => 'ti ti-shopping-cart fs-2',
        'permission' => ['viewOrder', 'editOrder'],
        'children' => [
            [
                'title' => 'Danh sách đơn hàng',
                'route' => 'admin.order.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewOrder'
            ],
            [
                'title' => 'Danh sách giao dịch',
                'route' => 'admin.transaction.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewOrder'
            ]
        ]
    ],
    [
        'active' => ['admin.discount.*'],
        'show' => ['admin.discount.*'],
        'title' => 'Mã giảm giá',
        'icon' => 'ti ti-ticket fs-2',
        'permission' => ['viewDiscount', 'createDiscount', 'editDiscount', 'deleteDiscount'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.discount.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createDiscount'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.discount.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewDiscount'
            ]
        ]
    ],
    [
        'active' => ['admin.post_catalogue.*'],
        'show' => ['admin.post_catalogue.*'],
        'title' => 'Chuyên mục',
        'icon' => 'ti ti-list-letters fs-2',
        'permission' => ['viewCatalogue', 'createCatalogue', 'editCatalogue', 'deleteCatalogue'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.post_catalogue.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createCatalogue'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.post_catalogue.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewCatalogue'
            ]
        ]
    ],
    [
        'active' => ['admin.post.*'],
        'show' => ['admin.post.*'],
        'title' => 'Bài viết',
        'icon' => 'ti ti-inbox fs-2',
        'permission' => ['viewPost', 'createPost', 'editPost', 'deletePost'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.post.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createPost'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.post.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewPost'
            ]
        ]
    ],
    [
        'active' => ['admin.review.*'],
        'show' => ['admin.review.*'],
        'title' => 'Đánh giá',
        'icon' => 'ti ti-star fs-2',
        'permission' => ['viewPost', 'createPost', 'editPost', 'deletePost'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.post.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createPost'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.post.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewPost'
            ]
        ]
    ],
    [
        'active' => ['admin.slider.*'],
        'show' => ['admin.slider.*'],
        'title' => 'Slider',
        'icon' => 'ti ti-library-photo fs-2',
        'permission' => ['viewSlider', 'createSlider', 'editSlider', 'deleteSlider'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.slider.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createSlider'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.slider.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewSlider'
            ]
        ]
    ],
    [
        'active' => ['admin.user.*'],
        'show' => ['admin.user.*'],
        'title' => 'Khách hàng',
        'icon' => 'ti ti-user fs-2',
        'permission' => ['viewCustomer', 'createCustomer', 'editCustomer', 'deleteCustomer'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.user.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createCustomer'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.user.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewCustomer'
            ]
        ]
    ],
    [
        'active' => ['admin.admin.*'],
        'show' => ['admin.admin.*'],
        'title' => 'Quản trị viên',
        'icon' => 'ti ti-user-shield fs-2',
        'permission' => ['viewAdmin', 'createAdmin', 'editAdmin', 'deleteAdmin'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.admin.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createAdmin'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.admin.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewAdmin'
            ]
        ]
    ],
    [
        'active' => ['admin.setting.*'],
        'show' => ['admin.setting.*'],
        'title' => 'Cài đặt',
        'icon' => 'ti ti-settings fs-2',
        'permission' => ['viewAdmin', 'createAdmin', 'editAdmin', 'deleteAdmin'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.admin.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createAdmin'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.admin.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewAdmin'
            ]
        ]
    ],
    [
        'active' => ['admin.role.*'],
        'show' => ['admin.role.*'],
        'title' => 'Vai trò',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewRole', 'createRole', 'editRole', 'deleteRole'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.role.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createRole'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.role.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewRole'
            ]
        ]
    ],
    [
        'active' => ['admin.permission.*'],
        'show' => ['admin.permission.*'],
        'title' => 'Quyền',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewPermission', 'createPermission', 'editPermission', 'deletePermission'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.permission.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createPermission'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.permission.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewPermission'
            ]
        ],
    ],
    [
        'active' => ['admin.module.*'],
        'show' => ['admin.module.*'],
        'title' => 'Module',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewModule', 'createModule', 'editModule', 'deleteModule'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'admin.module.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createModule'
            ],
            [
                'title' => 'Danh sách',
                'route' => 'admin.module.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewModule'
            ]
        ]
    ]
];