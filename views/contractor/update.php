<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contractor */
/* @var $task app\models\Task */

$this->title = 'Редактирование подрядчика: ' . $model->client->username;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['task/index']];
$this->params['breadcrumbs'][] = ['label' => $task->title, 'url' => ['task/view', 'id' => $task->id]];
$this->params['breadcrumbs'][] = $model->client->username;
?>
<div class="contractor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'task' => $task,
    ]) ?>

</div>
