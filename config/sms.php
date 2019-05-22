<?php

return [

    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'yuntongxun'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
//        'yunpian' => [
//            'api_key' => '726696f54c429b926ac8577e7fead738',
//        ],
//        'aliyun' => [
//            'access_key_id' => '',
//            'access_key_secret' => '',
//            'sign_name' => '',
//        ],
        'yuntongxun' => [
            'app_id' => '8a216da86ab0b4d2016abf52c6ec0c08',
            'account_sid' => '8a216da86ab0b4d2016abf52c69b0c02',
            'account_token' => '7b590c35f7b14b17b4cbaf4fa512d07f',
            'is_sub_account' => false,
        ]
    ]
];
