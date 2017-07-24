<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Release */
$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => 'App Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-release-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
