# yii2-rom-release
yii2 rom release module


[![Latest Stable Version](https://poser.pugx.org/zacksleo/yii2-rom-release/version)](https://packagist.org/packages/zacksleo/yii2-rom-release)
[![Total Downloads](https://poser.pugx.org/zacksleo/yii2-rom-release/downloads)](https://packagist.org/packages/zacksleo/yii2-rom-release)
[![License](https://poser.pugx.org/zacksleo/yii2-rom-release/license)](https://packagist.org/packages/zacksleo/yii2-rom-release)
[![styleci](https://styleci.io/repos/98153638/shield)](https://styleci.io/repos/98153638)
[![Build Status](https://travis-ci.org/Graychen/yii2-rom-release.svg?branch=master)](https://travis-ci.org/Graychen/yii2-rom-release)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-rom-release/build-status/master)


# Usage

## Config Migration Path or Migration By migrationPath Parameter

### Config Migration Path  in Yii config file like this

```
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@console/migrations/',
                '@zacksleo/yii2/romrelease/migrations',
            ],
        ],
    ],

```

### Run migration by By migrationPath Parameter

```
  ./yii migrate --migrationPath=@zacksleo/yii2/romrelease/migrations

```

## Config Module in components part

```
    'rom-release' => [
        'class' => 'zacksleo\yii2\romrelease\Module',
    ]

```


