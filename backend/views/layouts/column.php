<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$controller = Yii::$app->controller->id;
?>

<?php $this->beginContent('@backend/views/layouts/main-new.php'); ?>
    <div class="row-offcanvas row-offcanvas-left">
        <div class="col-sm-3 col-md-2 sidebar row-offcanvas sidebar-offcanvas">
            <ul class="nav nav-sidebar">
                <li class="<?= $controller === 'site'  ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Dashboard';
                    echo Html::a($label, ['site/index'], [
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'page' || (($controller === 'assign' || $controller === 'script-assign') && $this->params['breadcrumbs'][0]['label'] == 'Pages') ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Pages';
                    echo Html::a($label, ['page/index'], [
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'content' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Contents';
                    echo Html::a($label, ['content/index'], [
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'script' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Scripts';
                    echo Html::a($label, ['script/index'], [
                    ]);/**/
                    ?>
                </li>
                <li class="<?= in_array($controller, ['template', 'template-sector']) || (($controller === 'assign' || $controller === 'script-assign') && $this->params['breadcrumbs'][0]['label'] == 'Templates') ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Templates';
                    echo Html::a($label, ['template/index'], [
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'user' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Users';
                    echo Html::a($label, ['user/index'], [
                    ]);/**/
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <p class="pull-left visible-xs toggle-nav">
                <button class="btn btn-primary btn-xs" data-toggle="offcanvas" type="button">Toggle nav</button>
            </p>
            <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) /**/?>
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>