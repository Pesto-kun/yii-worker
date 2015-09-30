<?php

/* @var $this yii\web\View */
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

/* @var $model app\models\Client */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-12">
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onColor' => 'success',
                'offColor' => 'danger',
                'onText' => 'Да',
                'offText' => 'Нет',
            ]
        ]) ?>
    </div>

    <div class="col-sm-8">
        <?= $form->field($model, 'username', ['addon' => ['prepend' => ['content'=>Html::icon('pencil')]]])->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'type', ['addon' => ['prepend' => ['content'=>Html::icon('user')]]])->dropDownList(\app\models\Client::$_types, ['prompt' => '- Выбрать тип клиента -']) ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
