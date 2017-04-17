<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Добавить категорию', ['//category/create'], ['class' => 'btn btn-success']); ?>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category
    ]) ?>

</div>
