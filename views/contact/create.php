<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $client app\models\Client */

$this->title = 'Добавить контакт';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['client/index']];
$this->params['breadcrumbs'][] = ['label' => $client->username, 'url' => ['client/view', 'id' => $client->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'client' => $client,
        'model' => $model,
    ]) ?>

</div>
