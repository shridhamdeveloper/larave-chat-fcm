<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'BDgYewWdsGICqMGBsC_HpJkqRw1yVD7w8rVw2BV4gOhYElJLBQ5pj0aEclrd1DpcV0JcksboSGuYmM6Oza8czFE'),
        'sender_id' => env('FCM_SENDER_ID', '755761302018'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
