<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use zacksleo\yii2\romrelease\Module;
use zacksleo\yii2\romrelease\models\RomRelease;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Module::t('romrelease', 'rom-release');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-release-index">
    <p>
        <?= Html::a(Module::t('romrelease', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'version',
            'version_code',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return RomRelease::getStatusList()[$model->status];
                }
            ],
            [
                'attribute' => 'is_forced',
                'value' => function ($model) {
                    return $model->is_forced == 1 ? '是' : '否';
                }
            ],
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => function ($model) {
                    return $model->getUploadUrl('url');
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
