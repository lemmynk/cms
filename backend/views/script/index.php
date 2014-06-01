<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Scripts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="script-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Script',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'type',
                'value'=>function($data){
                    return $data->getTypeText();
                }
            ],
            'name',
            [
                'attribute'=>'script_type',
                'value'=>function($data){
                    return $data->getScriptTypeText();
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusText();
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
