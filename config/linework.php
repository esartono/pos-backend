<?php

return [
    'api_url'       => [
        'live'    => 'https://apis.worksmobile.com',
        'sandbox' => 'https://sandbox-apis.worksmobile.com',
    ],
    'bot_photo_url' => env('LW_BOT_PHOTO_URL', '/logo.png'),
    'call_back_url' => env('LW_CALL_BACK_URL', '/api/v1/linework/callback')
];
