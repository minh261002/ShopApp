<span @class([
    'badge',
    App\Enums\Order\ShippingMethod::from($shipping_method)->badge(),
])>{{ \App\Enums\Order\ShippingMethod::getDescription($shipping_method) }}</span>
