<?php

return [
    'api_key' => env('FEDAPAY_API_KEY'),
    'public_key' => env('FEDAPAY_PUBLIC_KEY'),
    'environment' => env('FEDAPAY_ENVIRONMENT', 'live'),
];