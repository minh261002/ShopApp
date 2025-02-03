<span @class(['badge', App\Enums\Order\OrderStatus::from($status)->badge()])>{{ \App\Enums\Order\OrderStatus::getDescription($status) }}</span>
