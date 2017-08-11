<?php
// ensure we get report on all possible php errors
error_reporting(-1);
define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@zacksleo/yii2/romrelease/messages', dirname(__DIR__) . '/src/messages');
Yii::setAlias('@zacksleo/yii2/romrelease/migrations', dirname(__DIR__) . '/src/migrations');
Yii::setAlias('@frontend/web/uploads/galleries/romrelease/test.png', dirname(__DIR__) . '/tests/data/test.png');
