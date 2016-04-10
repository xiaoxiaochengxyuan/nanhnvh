<?php
require_once __DIR__.'/defines.php';
$params = require(__DIR__ . '/params.php');
$config = [
    'id' => 'nanhnvh',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',
    'modules' => [
        'webman' => [
            'class' => 'app\modules\webman\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '50f6f6020b830e0533dd2a337ef5359f',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'urlManager' => array(
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array('<controller:\w+>/<action:\w+>'=>'<controller>/<action>',)
        ),
        'db' => require(__DIR__ . '/db.php'),
        'mailer' => array(
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => array(
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                'username' => 'mail.xiawei@163.com',
                'password' => '398062080',
                'port' => '25',
                'encryption' => 'tls',
            ),
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['mail.xiawei@163.com'=>'admin']
            ],
        ),
    ],
    'params' => $params,
];

$request_uri = $_SERVER['REQUEST_URI'];
if (strpos($request_uri, '/webman') === 0) {
    $config['components']['errorHandler']['errorAction'] = 'webman/common/error';
}

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => array('192.168.232.1')
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => array('192.168.232.1'),
    ];
}

return $config;
