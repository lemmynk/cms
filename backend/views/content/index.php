<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Contents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Content',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
            'name',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusText($data->status);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions'
            ],
        ],
    ]); ?>

</div>
<?php /*
$js = <<<JS
var links = $(".content-index").find("a");
//console.log($(tabLis));
$.each(links, function(i, v){
    var link = $(v);
    link.on("click", function(e){
        var tabLis = $("ul.nav-tabs").find("li"),
            tabDivs = $(".tab-content").find("div.tab-pane");
        e.preventDefault();
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
                $("<a>",{href:"#"+i, role: "tab", "data-toggle": "tab", html: link.html()}).appendTo(list);
                $("<div>", {"class":"tab-pane active", id:i, html: data}).appendTo("div.tab-content");
            }
        });
    });
});
JS;

$this->registerJs($js);
/**/ ?>