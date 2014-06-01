<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var <?= ltrim($generator->modelClass, '\\') ?> $model
 */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="col-md-9">
        <h2 class="page-header"><?= "<?= " ?>Html::encode($this->title) ?></h2>

        <p>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                    'method' => 'post',
                ],
            ]) ?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Back to list') ?>, ['index'], ['class' => 'btn btn-default']) ?>
        </p>

        <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            'attributes' => [
    <?php
    if (($tableSchema = $generator->getTableSchema()) === false) {
        foreach ($generator->getColumnNames() as $name) {

            if(!in_array($name, ['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted', 'status'])){
                echo "            '" . $name . "',\n";
            }
        }
    } else {
        foreach ($generator->getTableSchema()->columns as $column) {
            if(!in_array($column->name, ['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted'])){
                $format = $generator->generateColumnFormat($column);
                if($column->name === 'status')
                    echo
                    "               [
                    'attribute'=>'status',
                    'value'=>\$model->getStatusText(\$model->status)
                ],\n";
                else
                    echo "              '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
    ?>
            ],
        ]) ?>
    </div>
    <div class="col-md-3">
        <h2 class="page-header">System info</h2>
        <div style="margin: 63px 0"></div>
        <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                'attribute'=>'created_at',
                'value'=>!$model->isNewRecord ? date('d. m. Y', $model->created_at) : ''
                ],
                [
                'attribute'=>'created_by',
                'value'=>!$model->isNewRecord ? $model->getCreator()->one()->getUserName() : ''
                ],
                [
                'attribute'=>'updated_at',
                'value'=>!$model->isNewRecord ? date('d. m. Y', $model->updated_at) : ''
                ],
                [
                'attribute'=>'updated_by',
                'value'=>!$model->isNewRecord ? $model->getCreator()->one()->getUserName() : ''
                ]
            ],
        ]) ?>
    </div>
</div>
