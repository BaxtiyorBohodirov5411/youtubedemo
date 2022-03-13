<?php

/* @var $this \yii\web\View */
/* @var $content string */


use common\widgets\Alert;

$this->beginContent('@frontend/views/layouts/base.php');
?>
    <main class="d-flex w-100">
        <div class="content-wrapper">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
<?php $this-> endContent()?>