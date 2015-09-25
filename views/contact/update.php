<?php
use app\models\ContactType;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $client app\models\Client */

$this->title = 'Редактирование ' . ContactType::getTypeName($model->type);
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['client/index']];
$this->params['breadcrumbs'][] = ['label' => $client->username, 'url' => ['client/view', 'id' => $client->id]];
$this->params['breadcrumbs'][] = ContactType::getTypeName($model->type);
?>
<div class="contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
