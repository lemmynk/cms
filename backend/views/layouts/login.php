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
    <body class="signin">
    <?php $this->beginBody() ?>
    <div class="wrap">
        <div class="container-fluid">
            <?= $content ?>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?php echo date('Y')?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
    </div>



    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>