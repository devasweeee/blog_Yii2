<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

    <h2><?= HTML::a(Html::encode($model->username), ['view', 'id' => $model->id]) ?></h2>
    <p>Зарегистрирован: <?= Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyyy'); ?></p>
<?php
//    <p>Статус: <?= Html::encode($model->status)></p>
//    <?= HtmlPurifier::process($model->role) >
?>
