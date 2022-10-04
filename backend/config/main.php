<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'tag' => [
            'class' => 'backend\modules\tag\Tag',
        ],
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],
        'comment' => [
            'class' => 'backend\modules\comment\Comment',
        ],
        'news' => [
            'class' => 'backend\modules\news\News',
        ],
        'event_type' => [
            'class' => 'backend\modules\event_type\EventTypeModule',
        ],
        'battle_place' => [
            'class' => 'backend\modules\battle_place\BattlePlace',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '', //  /secure
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/xml' => 'yii/web/XmlParser',
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'andrewdanilov\adminpanel\models\User',
            'accessChecker' => 'andrewdanilov\adminpanel\AccessChecker',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['user/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'controllerMap' => [
        'user' => [
            'class' => 'andrewdanilov\adminpanel\controllers\UserController',
            'viewPath' => '@backend/someotherlocation/views/user', // optional, custom UserController views location
        ],
    ],
    'params' => $params,
];
