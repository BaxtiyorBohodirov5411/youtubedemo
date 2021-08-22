<?php

use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */

$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create d-flex flex-column justify-content-center align-items-center">

    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <div class="upload-icon">
            <i class="fas fa-upload"></i>    
        </div>
        <br>
        <p class="text-center">
            Drag and drop files you wont to upload
        </p>
        <p class="text-muted">    
            Until you publish the videos, access to them will be limited.
        </p>
       
    </div> 
    <?php  $form= yii\bootstrap4\ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data','class'=>'text-center']
    ]);
    ?>
        <?php
            echo $form->errorSummary($model);
        ?>

    <button class="btn btn-primary btn-file">
            Select File
            <input type="file" name="video" id="videoFile">
    </button>
    <?php yii\bootstrap4\ActiveForm::end()?>
</div>
