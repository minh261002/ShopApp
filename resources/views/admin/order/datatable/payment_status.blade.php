<span @class([
    'badge',
    App\Enums\Order\PaymentStatus::from($payment_status)->badge(),
])>{{ \App\Enums\Order\PaymentStatus::getDescription($payment_status) }}</span>
