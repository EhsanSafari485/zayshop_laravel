<?php
return [
    'drivers' => [
        'zarinpal' => [
            'merchantId' => env('ZARINPAL_MERCHANT_ID'),
            'callbackUrl' => env('ZARINPAL_CALLBACK_URL', '/callback'),
            'description' => 'توضیح پرداخت در زرین‌پال',
            'mode' => env('ZARINPAL_SANDBOX', true) ? 'sandbox' : 'normal',
            'type' => 'gateway',
        ],
    'local' => [
        'callbackUrl' => '/callback', // آدرس بازگشتی برای دریافت نتیجه تراکنش
        'title' => 'Test gateway', // عنوان فرم پرداخت
        'description' => 'This gateway is for using in development environments only.', // توضیحات
        'orderLabel' => 'Order No.', // برچسب شماره سفارش
        'amountLabel' => 'Payable amount', // برچسب مبلغ قابل پرداخت
        'payButton' => 'Successful Payment', // دکمه پرداخت موفق
        'cancelButton' => 'Cancel Payment', // دکمه لغو پرداخت
    ],
]

];
