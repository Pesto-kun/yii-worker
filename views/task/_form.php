<?php
use app\models\User;
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form \kartik\widgets\ActiveForm */

$clients = \yii\helpers\ArrayHelper::map(\app\models\Client::find()
    ->where(['status' => 1, 'type' => \app\models\Client::TYPE_CLIENT])->asArray()->all(), 'id', 'username');
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'status')->radioButtonGroup([
            0 => 'Завершена',
            1 => 'Активна',
            2 => 'На паузе',
        ]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'user_id')->dropDownList(User::getUserOptions()) ?>
    </div>

    <div class="col-sm-8">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'priority')->dropDownList(\app\models\Priority::getItems()) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'client_id')->widget(\kartik\widgets\Select2::className(), [
            'language' => 'ru',
            'data' => $clients,
            'options' => ['placeholder' => 'Выбрать клиента'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => Html::icon('user'),
                ],
            ]
        ])->label('Клиент'); ?>
    </div>

    <div class="col-sm-6">
        <?php if($model->date) {$model->date = Yii::$app->formatter->asDate($model->date, 'php:d.m.Y H:i');} ?>
        <?= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy hh:ii'
            ]
        ]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'expected_profit', ['addon' => ['append' => ['content'=>'рублей']]])->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'result_profit', ['addon' => ['append' => ['content'=>'рублей']]])->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
