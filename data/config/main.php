<?php

date_default_timezone_set('PRC');

$db = require(__DIR__ . '/db.php');

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'runtimePath'  => dirname(dirname(__DIR__)) . '/data/runtime',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@data/cache',
        ],
        'schemaCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@data/cache',
            'keyPrefix'=>'scheme_'
        ],
        'security' => [
            'class' => 'source\core\base\Security',
        ],
	  	'assetManager' => [
			'basePath' => '@webroot/statics/assets',
			'baseUrl'=>'@web/statics/assets',
	      		'bundles' => [
	      		    'yii\web\JqueryAsset'=>[
	      		        'js'=>[]
	      		    ],
	          	// you can override AssetBundle configs here
	      	],
	      	//'linkAssets' => true,
	      	// ...
	   ],
        'urlManager' =>[
//            'class'=>'source\core\base\UrlManager',
            'class'=>'\yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // 用于表明urlManager是否启用URL美化功能，在Yii1.1中称为path格式URL，
            // Yii2.0中改称美化。
            // 默认不启用。但实际使用中，特别是产品环境，一般都会启用。
            'enablePrettyUrl' => true,

            // 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
            // 否则认为是无效路由。
            // 这个选项仅在 enablePrettyUrl 启用后才有效。
            'enableStrictParsing' => false,
            'rules' => [
                "<controller:\w+>/<action:\w+>/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sina.com',			//使用163邮箱
                'username' => 'xxx@sina.com',	//你的163的帐号
                'password' => "xxx",				//你的163的密码
                'port' => '25',
                //'port'=>'465',
                //'encryption' => 'ssl',
            ],
            	
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => ['xxx@sina.com' => 'Admin'],
                'charset' => 'UTF-8',
            ],
        ],
        'db' => $db,
        'log' => [
            'targets' => [
                'file' => [
                    'class' => 'source\modules\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    //'categories' => ['yii\'],
                  ],
               
              ],
          ],
        'modularityService' => [
            'class' => 'source\modules\modularity\ModularityService',
        ],
    ],
];
