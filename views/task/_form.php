<?php
use kartik\date\DatePicker;
use yii\helpers\Html;
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
        <?php if($model->date) {$model->date = Yii::$app->formatter->asDate($model->date, 'php:d.m.Y');} ?>
        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pickerButton' =>false,
            'options' => [
                'placeholder' => 'Выбрать дату'
            ],
            'pluginOptions' => [
                'todayHighlight' => true,
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy',
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
