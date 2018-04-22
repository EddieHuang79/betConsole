<?php

return [
    'ServiceURL' => env('PAY_SERVICE_URL', 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V2'),
    'HashKey' => env('PAY_HASH_KEY', 'drgCXEmtj2SXXILB'),
    'HashIV' => env('PAY_HASH_IV', 'oapHsWWaUSOMRIZG'),
    'MerchantID' => env('PAY_MERCHANT_ID', '3034720'),
];
