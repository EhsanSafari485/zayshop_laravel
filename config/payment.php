<?php

return [
    'default' => env('PAYMENT_DRIVER', 'local'),

    'drivers' => [
        'local' => [
            'callbackUrl' => env('PAYMENT_LOCAL_CALLBACK_URL', '/callback'),
            'title' => 'درگاه تستی',
            'description' => 'این درگاه صرفاً برای تست در محیط توسعه است.',
            'orderLabel' => 'شماره سفارش',
            'amountLabel' => 'مبلغ قابل پرداخت',
            'payButton' => 'پرداخت موفق',
            'cancelButton' => 'لغو پرداخت',
        ],

        'zarinpal' => [
            'merchantId' => env('ZARINPAL_MERCHANT_ID', ''),
            'callbackUrl' => env('ZARINPAL_CALLBACK_URL', '/callback'),
            'description' => 'توضیح تستی پرداخت',
            'mode' => 'sandbox', // یا normal
            'type' => 'gateway', // یا zaringate
        ],
    ],

    'currency' => 'IRT',
    'currencySeparator' => true,

    'settings' => [],
];

