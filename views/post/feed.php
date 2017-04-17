<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//if (Yii::$apps->user->isGuest) //пользователь не авторизован
$this->title = 'Лента';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_list',
        //'itemView' => function ($model, $key, $index, $widget) {
        //    return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        //},
    ]) ?>
    <?php Pjax::end(); ?>
</div>
