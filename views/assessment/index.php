<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;

$this->title = 'My Yii Application Test';
?>
<div class="test-index">
<h2>Report a bug</h2>
  <?php $form = ActiveForm::begin(['id' => 'assessment-form', 'action' => '/assessment/send']); ?>
    <label class="control-label" for="name">Name</label>
<input type="text"
       id="name"
       class="form-control"
       name="name">
                    <div class="form-group field-email required">
<label class="control-label" for="email">Email</label>
<input type="text" id="email" class="form-control" name="email">

</div>
                    <div class="form-group field-body required">
<label class="control-label" for="body">Issue description</label>
<textarea id="body"
          class="form-control"
          name="body"
          rows="6"
          aria-required="true"></textarea>

</div>
                    <div class="form-group field-email required">
<label class="control-label" for="screenshot">Screenshot</label>
<input type="file" id="screenshot" class="form-control" name="screenshot">

</div>

                    <div class="form-group">
                        <button type="submit"
                                class="btn btn-primary"
                                name="contact-button">Submit</button>                    </div>


<?php ActiveForm::end(); ?>
</div>
