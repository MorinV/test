<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\CustomerProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'status')->radioList(ArrayHelper::map($nameProfiles, 'id', 'name'))->label(false); ?>
	
	
	<?= $form->field($model, 'fullName') ?>

    <?php // echo $form->field($model, 'date_registred') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary hidden']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
