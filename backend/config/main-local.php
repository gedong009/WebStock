<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '41SCN-vryMrrUOuOzXXcGo0GP4zBgMhr',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '180.170.74.23', '114.94.125.73'],   //可使用gii的IP
        'generators'=>[
            'lulumodule'=>'backend\gii\generators\lulumodule\Generator',
            'lulumodel'=>'backend\gii\generators\lulumodel\Generator',
            'lulucrud'=>'backend\gii\generators\lulucrud\Generator',
        ],
    ];
}

return $config;