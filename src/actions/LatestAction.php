<?php

namespace zacksleo\yii2\romrelease\actions;

use yii\base\Action;
use zacksleo\yii2\romrelease\models\RomRelease;
use yii\web\NotFoundHttpException;

class LatestAction extends Action
{
    public function run()
    {
        $model = RomRelease::find()->where(['status' => RomRelease::STATUS_PUBLISHED])->orderBy('updated_at DESC')->one();
        if (empty($model)) {
            throw new NotFoundHttpException('暂无新的更新');
        }
        return $model;
    }
}
