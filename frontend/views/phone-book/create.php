<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
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
        <?= $form->field($model, 'dateBirth')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose'=>true]
        ]);?>
        <?= $form->field($model, 'phones')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

</div>
