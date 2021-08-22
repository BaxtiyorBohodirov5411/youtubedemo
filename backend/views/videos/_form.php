<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */
/* @var $form yii\bootstrap4\ActiveForm */
\backend\assets\TagsInputAsset::register($this);
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-sm-8">
            <?php echo $form->errorSummary($model)?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'describtion')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags',['inputOptions'=>['data-role'=>'tagsinput']])->textInput(['maxlength' => true]) ?>
          
            <?= $form->field($model, 'has_thumbnail')->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <label><?= $model->attributeLabels()['thumbnail'] ?></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                </div>
            </div>
            
       
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <div class="embed-responsive embed-responsive-16by9  shadow">
                    <video id="video1" poster=<?=Yii::$app->params['frontendUrl']."web/storage/images/".$model->video_id.".jpg"?> 
                    class="embed-responsive-item" src=<?php echo $model->getVideoLink()?> controls></video>
                </div>
                 <div class="text-muted">Video Link</div>     
                 <a href=<?php echo $model->getVideoLink()?>>Open video</a> 
        </div>    
        <div class="mb-3">
            <div class="text-muted">
                Video Name
            </div>
            <?php echo $model->video_name ?>
        </div>
             <?= $form->field($model, 'status')->dropdownList($model->getStatusLabels()) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
