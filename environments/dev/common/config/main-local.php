<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@common/data/db.sqlite',
            'enableSchemaCache' => true,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
    ],
];
