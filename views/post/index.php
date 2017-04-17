<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//if (Yii::$apps->user->isGuest) //пользователь не авторизован
$this->title = 'Автор: '.Html::encode($author->username);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        if(!(Yii::$app->user->isGuest) && !($author->id == Yii::$app->user->id)){
            $id_sub = app\models\Subscribe::getOpportunity(Yii::$app->user->id, $author->id);

            if($id_sub == 0){
                echo Html::a('Подписаться', ['//subscribe/create', 'sub' => $author->id], [
                    'class' => 'btn btn-success',
                    'data'  => ['method' => 'post'],
                ]);

            } else {
                echo Html::a('Отписаться', ['//subscribe/delete', 'id' => $id_sub], [
                    'class' => 'btn btn-danger',
                    'data'  => ['method' => 'post'],
                ]);
            };
            //echo '<p>!'.Html::encode(app\models\Subscribe::getOpportunity(Yii::$app->user->id, $author->id)).'</p>';
            //echo '<p>'.$author->id.' '.'</p>';
            //echo '<p>'.isset(app\models\Subscribe::find()->where(['user_id'=>Yii::$app->user->id, 'sub_id'=>2])->one())?'1':'2'.'</p>';
        }
    ?>

    <p>
        <?php
         if($addPost){
         echo Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']);
         }
         ?>
    </p>

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
