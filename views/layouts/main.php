<?php

/* @var $this \yii\web\View */
/* @var $content string xui*/

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Мой блог',
        'brandUrl' => ['/post'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    /*++*/
    $menuItems = [ // Те, которые будут отображаться всегда
        ['label' => 'Главная', 'url' => ['site/index']],//Yii::$app->homeUrl],
        //['label' => 'Напишите нам', 'url' => ['/site/contact']],
        //['label' => 'About', 'url' => ['/site/about']],
    ];

    if(Yii::$app->user->isGuest) // Если пользователь не авторизован
    {
        $menuItems[] = ['label' => 'Зарегистрироватся', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    }
    else
    {
        //$menuItems[] = ['label' => 'Мои записи', 'url' => ['/post/index']];
        $menuItems[] = ['label' => 'Лента', 'url' => ['post/feed']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post') // Форма логаута, смотрим виджет ActiveForm
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    /**/

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems
//        [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
//        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
