<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\CkEditorAsset;
use dosamigos\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;

CkEditorAsset::register($this);

$url = Yii::$app->urlManager->createUrl(['file-browser/index']);
/**
 * @var yii\web\View $this
 * @var backend\models\Content $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'content')->textarea(['rows'=>6])?>
    <?php /*echo $form->field($model, 'content')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        //'language' => 'es',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code"
        ]
    ]); /**/ ?>

    <?= $form->field($model, 'status')->checkbox([], false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$links = array( array('Text of Link to Google','http://google.com') , array('Test of link to bing','http://www.bing.com') );
$json_links = json_encode($links);
$url = Yii::$app->urlManager->createUrl(['file-browser/index']);
$js = <<<DS
var links = $json_links;
CKEDITOR.replace('content-content', {
filebrowserBrowseUrl: '$url',
});
CKEDITOR.on( 'dialogDefinition', function( ev )
{
    // Take the dialog name and its definition from the event
    // data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;

    // Check if the definition is from the dialog we're
    // interested on (the "Link" dialog).
    if ( dialogName == 'link' )
    {
        // Get a reference to the "Link Info" tab.
        // CKEDITOR.dialog.definition.content
        var infoTab = dialogDefinition.getContents( 'info' );

        // Add a new UI element to the info box.
        // Use a JSON array named items to grab the list.
        // Modify the onChange event to update the real URL field.
        infoTab.add(
            {
                type : 'vbox',
                id : 'localPageOptions',
                children : [
                    {
                        type : 'select',
                        label : 'Select local page.',
                        id : 'localPage',
                        title : 'Select local page.',
                        items: links,
                        onChange : function(ev) {
                            var diag = CKEDITOR.dialog.getCurrent();
                            var url = diag.getContentElement('info','url');
                            url.setValue(ev.data.value);
                        }
                    }]
            }
        );
        // Rewrite the 'onFocus' handler to always focus 'url' field.
        dialogDefinition.onFocus = function()
        {
            var urlField = this.getContentElement( 'info', 'url' );
            urlField.select();
        };
    }
});
DS;

$this->registerJs($js); /**/ ?>
