<span @class([
    'badge',
    App\Enums\Order\ShippingStatus::from($shipping_status)->badge(),
])>{{ \App\Enums\Order\ShippingStatus::getDescription($shipping_status) }}</span>
