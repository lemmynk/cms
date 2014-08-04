<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$controller = Yii::$app->controller->id;
?>

<?php $this->beginContent('@backend/views/file-browser/file-main.php'); ?>
    <div class="row-offcanvas row-offcanvas-left">
        <!--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
            <?= $content ?>
        </div>
    <!--</div>-->
<?php $this->endContent(); ?>