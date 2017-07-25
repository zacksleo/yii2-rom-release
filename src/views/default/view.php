<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\romrelease\models\RomRelease;
use zacksleo\yii2\romrelease\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\romrelease\models\RomRelease */
$this->title = $model->version;
$this->params['breadcrumbs'][] = ['label' => 'App发布', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-release-view">
    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'version',
            'version_code',
            [
                'attribute' => 'is_forced',
                'value' => $model->is_forced == 1 ? '是' : '否',
            ],
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => function ($model) {
                    return $model->getUploadUrl('url');
                },
            ],
            'md5',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return RomRelease::getStatusList()[$model->status];
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status = RomRelease::STATUS_PUBLISHED ? Module::t('romrelease', 'published') : Module::t('romrelease', 'unpublished');
                }
            ],
            'description',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>
