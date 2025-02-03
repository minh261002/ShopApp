<span @class([
    'badge',
    App\Enums\Order\PaymentMethod::from($payment_method)->badge(),
])>{{ \App\Enums\Order\PaymentMethod::getDescription($payment_method) }}</span>
