<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<h1>Image Upload</h1>
 
<div class="form">
<?php echo $form; ?>
</div>

</div><!-- form -->