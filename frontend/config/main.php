<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    /*'catchAll'=>[
        'site/index',
        'debug'=>'debug'
    ],/**/
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
        ],/**/
        'log' => [
            'traceLevel' => YII_DEBUG ? 5 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                //'debug/<controller>/<action>' => 'debug/<controller>/<action>',
                '<url1>'=>'site/index',
                '<url1>/<url2>'=>'site/index',
                '<url1>/<url2>/<url3>'=>'site/index',
                '<url1>/<url2>/<url3>/<url4>'=>'site/index',
            ],/**/
        ],
    ],
    'params' => $params,
];
