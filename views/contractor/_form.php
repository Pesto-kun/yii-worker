<?php
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contractor */
/* @var $form kartik\widgets\ActiveForm */

$clients = \yii\helpers\ArrayHelper::map(\app\models\Client::find()
    ->where(['status' => 1, 'type' => \app\models\Client::TYPE_CONTRACTOR])->asArray()->all(), 'id', 'username');
?>

<div class="contractor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'client_id')->widget(\kartik\widgets\Select2::className(), [
            'language' => 'ru',
            'data' => $clients,
            'options' => ['placeholder' => 'Выбрать подрядчика'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => Html::icon('user'),
                ],
            ]
        ]); ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'price', ['addon' => ['append' => ['content'=>'рублей']]])->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
