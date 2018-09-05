<?php
use yii\helpers\Html;
/* @var $this \yii\web\View view component instance */
/* @var $bugReport app\models\BugReport */
?>
<h1>Dear admin, please check this bug report info</h1>
<table>
    <tr>
        <td style="width: 150px; text-align: left; background: graytext"><?php echo $bugReport->getAttributeLabel('name') ?></td>
        <td><?php echo Html::encode($bugReport->name) ?></td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: left; background: graytext"><?php echo $bugReport->getAttributeLabel('email') ?></td>
        <td><?php echo Html::encode($bugReport->email) ?></td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: left; background: graytext"><?php echo $bugReport->getAttributeLabel('issue_description') ?></td>
        <td><?php echo nl2br(Html::encode($bugReport->issue_description)) ?></td>
    </tr>
    <?php if ($bugReport->screenshot): ?>
    <tr>
        <td style="width: 150px; text-align: left; background: graytext"><?php echo $bugReport->getAttributeLabel('screenshot') ?></td>
        <td><?php echo Html::img($message->embed($bugReport->getScreenshotFilePath())) ?></td>
    </tr>
    <?php endif; ?>
</table>
