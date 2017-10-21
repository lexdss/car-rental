<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QLdqUklR2bo0ryR_sUq7sGsZJj_fw_Mv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/index']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '' => 'site/index',
                'admin' => 'admin/admin/index',
                'register' => 'user/register',
                'login' => 'user/login',
                'logout' => 'user/logout',
                'recovery-password' => 'user/recovery-password',
                'set-new-password' => 'user/set-new-password',
                'admin/<_c:[\w\-]+>' => 'admin/<_c>/index',
                'admin/<_c:[\w\-]+>/<_a:[\w\-]+>' => 'admin/<_c>/<_a>',
                'order/<id:\d+>' => 'site/order',
                'news' => 'site/news',
                '<type:news|page>/<value:[\w\-]+>' => 'site/page',
                '<value:[\w\-]+>' => 'site/category',
                'site/images-get' => 'site/images-get',
                'site/image-upload' => 'site/image-upload',
                '<_a:[\w\-]+>/<value:[\w\-]+>' => 'site/<_a>',
            ],
        ],
        'formatter' => [
            'dateFormat' => 'php:d.m.Y'
        ]
    ],
    'params' => $params,
];

$config['aliases'] = [
    '@uploadroot' => $config['basePath'] . '/web/upload',
    '@uploadweb' => '/upload',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
