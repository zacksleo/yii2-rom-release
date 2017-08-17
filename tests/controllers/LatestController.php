<?php
namespace zacksleo\yii2\romrelease\tests\controllers;

use Yii;
use zacksleo\yii2\romrelease\models\RomRelease;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * RomReleaseController implements the CRUD actions for RomRelease model.
 */
class LatestController extends Controller
{
    public function actionIndex()
    {
        $model = RomRelease::find()->where(['status' => RomRelease::STATUS_PUBLISHED])->orderBy('updated_at DESC')->one();
        if (empty($model)) {
            throw new NotFoundHttpException('暂无新的更新');
        }
        return $model;
    }
}
