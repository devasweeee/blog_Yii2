    <?php
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;
    ?>

    <h2><?= HTML::a(Html::encode($model->title), ['post/view', 'id' => $model->id]) ?></h2>
    <p><?= Html::encode($model->category->title)?></p>
    <?//= HTML::encode($model->publish_date->format('Y-m-d H:i:s')) ?>
    <p>Дата публикации: <?= Yii::$app->formatter->asDate($model->publish_date, 'd.MM.yyyy'); ?></p>
    <p>Автор: <?= HTML::a(HTML::encode($model->author->username), ['user/view', 'id' => $model->author_id]) ?></p>
    <?= HtmlPurifier::process($model->anons) ?>
    <?//= Html::a('Подписаться', ['//subscribe/create', 'sub' => $model->author_id], ['class' => 'btn btn-success'])?>