<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;

$this->title = 'My Yii Application Test';
?>
<div class="test-index">
<?php if(!Yii::$app->session->getFlash('success', null, false)): ?>
<h2>Report a bug</h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?php endif; ?>
