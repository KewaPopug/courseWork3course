<?php

return [
    'class' => 'yii\db\Connection',
    'driverName' => 'sqlsrv',
    'dsn' => 'sqlsrv:server=localhost;Database=agency_immovables;',
    'username' => 'user',
    'password' => 'user',
    'charset' => 'utf8',

//    'class' => 'yii\db\Connection',
//    'dsn' => 'pgsql:host=localhost;port=5432;dbname=agency_immovables',
//    'username' => 'postgres',
//    'password' => 'postgres',
//    'charset' => 'utf8',
//    'tablePrefix'=>'',


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
