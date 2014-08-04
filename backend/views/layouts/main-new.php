<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'Miller CMS',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $rightMenuItems = [
            //['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $rightMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $rightMenuItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->name . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        // Nav::widget([
            //'options' => ['class' => 'navbar-nav navbar-left'],
            //'items' => $leftMenuItems,
        //]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $rightMenuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container-fluid">
            <?= $content ?>
        </div>
        <!--<footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?php //echo date('Y')?></p>
                <p class="pull-right"><?php //echo Yii::powered() ?></p>
            </div>
        </footer>-->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>