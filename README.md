# yii2-rom-release
yii2 rom release module

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


