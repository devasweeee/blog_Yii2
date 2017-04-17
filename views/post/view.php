<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if ($model->author_id==Yii::$app->user->id){
            echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить статью '.$model->title.'?',
                    'method' => 'post',
                ],
            ]);
            }
        ?>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tr>
            <th><?=HTML::encode($model->title)?></th>
            <td>Дата публикации:<?= Yii::$app->formatter->asDate($model->publish_date, 'dd.MM.yyyy'); ?></td>
        </tr>
        <tr>
        <td colspan = 2><?= HTML::encode($model->anons)?></td>
        </tr>
        <tr>
        <td colspan = 2><?= Yii::$app->formatter->asNtext($model->content)?></td>
        </tr>
    </table>

</div>
