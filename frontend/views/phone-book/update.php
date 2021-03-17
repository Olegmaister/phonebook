<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \core\forms\PhoneBookForm */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model core\entities\PhoneBook */

$this->title = 'Create Phone Book';
$this->params['breadcrumbs'][] = ['label' => 'Phone Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="phone-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="phone-book-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dateBirth')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'phones')->textInput(['maxlength' => true]) ?>

<!--        --><?php //foreach ($model->phones as $i => $value): ?>
<!--                --><?//= $form->field($value, '[' . $i . ']number')->textInput() ?>
<!--        --><?php //endforeach; ?>

<!--        <input id="phoneform-2-number" class="form-control" name="PhoneForm[2][number]" value="888888888">-->
<!--        <div class="help-block"></div>-->



        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

</div>

