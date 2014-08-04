<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\assets\TabsAsset;
use yii\helpers\Json;

//TabsAsset::register($this);
$controller = Yii::$app->controller->id;
?>

<?php $this->beginContent('@backend/views/layouts/main-new.php'); ?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="<?= $controller === 'site'  ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Dashboard';
                    echo Html::a($label, ['site/index'], ['data-tabname'=>'Dashboard'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'page' || (($controller === 'assign' || $controller === 'script-assign') && $this->params['breadcrumbs'][0]['label'] == 'Pages') ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Pages';
                    echo Html::a($label, ['page/index'], ['data-tabname'=>'Pages'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'content' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Contents';
                    echo Html::a($label, ['content/index'], ['data-tabname'=>'Contents'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'widget' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Widgets';
                    echo Html::a($label, ['widget/index'], ['data-tabname'=>'Widgets'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'script' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Scripts';
                    echo Html::a($label, ['script/index'], ['data-tabname'=>'Scripts'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= in_array($controller, ['file', 'file-category']) ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Files';
                    echo Html::a($label, ['file-category/index'], ['data-tabname'=>'Files'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= in_array($controller, ['template', 'template-sector']) || (($controller === 'assign' || $controller === 'script-assign') && $this->params['breadcrumbs'][0]['label'] == 'Templates') ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Templates';
                    echo Html::a($label, ['template/index'], ['data-tabname'=>'Templates'
                    ]);/**/
                    ?>
                </li>
                <li class="<?= $controller === 'user' ? 'active' : '' ?>">
                    <?php
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' .  'Users';
                    echo Html::a($label, ['user/index'], ['data-tabname'=>'Users'
                    ]);/**/
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) /**/?>
            <!--<ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#home" role="tab" data-toggle="tab">Dashboard</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <?php //$this->renderAjax('site/index') ?>
                </div>
            </div>-->
            <?php echo $content ?>
        </div>
    </div>

<?php
$js = <<<JS
var links = $("ul.nav-sidebar").find("a");
//console.log($(tabLis));
$.each(links, function(i, v){
    var link = $(v);
    link.on("click", function(e){
        var tabLis = $("ul.nav-tabs").find("li"),
            tabDivs = $(".tab-content").find("div.tab-pane");
        //e.preventDefault();
        $.each(tabLis, function(j,w){
            if($(w).hasClass("active")) $(w).removeClass("active");
        });
        $.each(tabDivs, function(k,u){
            if($(u).hasClass("active")) $(u).removeClass("active");
        });

        $.ajax({
            url: link.attr("href"),
            type: "POST",
            success: function(data){
                var list = $("<li>",{"class":"active"}).appendTo("ul.nav-tabs");
                $("<a>",{href:"#"+i, role: "tab", "data-toggle": "tab", html: link.attr("data-tabname")}).appendTo(list);
                $("<div>", {"class":"tab-pane active", id:i, html: data}).appendTo("div.tab-content");
            }
        });/**/
    });
});
JS;

$tbs = <<<JS
var tabLinks = $("ul.nav-tabs").find("a");
$.each(tabLinks, function(m,z){
    var tabLink = $(z);
    tabLink.on("click", function(e){
        e.preventDefault();
        this.tab('show');
    });
});
JS;

$this->registerJs($js);
$this->registerJs($tbs);
/**/?>
<?php $this->endContent(); ?>