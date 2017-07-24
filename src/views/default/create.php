<?php
use yii\helpers\Html;
use zacksleo\yii2\romrelease\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\romrelease\models\RomRelease */
$this->title = Module::t('romrelease', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('romrelease', 'App Releases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->status = 1;
$model->is_forced = 1;
?>
<div class="app-release-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
