<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <h2>Последние записи</h2>
                <?= ListView::widget([
                    'dataProvider' => $dataProviderPost,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => '//post/_list_with_author',
                ])
                ?>


            </div>

            <div class="col-lg-4">
                <h2>Ваши подписки</h2>

                <p>
                <?= ListView::widget([
                    'dataProvider' => $dataProviderSub,
                    'itemOptions'  => ['class' => 'item_feed'],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model->sub->username), ['//user/view', 'id' => $model->sub_id]);
                        //return Html::encode($model->sub->username);
                    },
                ])
                ?>
                </p>

                <?//=//<p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>?>
                <p><?= Html::a('Читать ленту',['//post/feed'], ['class' => 'btn btn-default'])?></p>
            </div>
        </div>

    </div>
</div>
