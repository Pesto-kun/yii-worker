<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */

$clients = \yii\helpers\ArrayHelper::map(\app\models\Client::find()->where(['status' => 1])->asArray()->all(), 'id', 'username');
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'client_id')->dropDownList($clients, ['prompt' => '- Выбрать клиента -'])->label('Клиент') ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'class' => 'form-control',
            ]
        ]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'expected_profit')->textInput() ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'result_profit')->textInput() ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
