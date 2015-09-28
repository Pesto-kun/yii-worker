<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту задачу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'status',
                'label'=>'Статус',
                'format'=>'raw',
                'value'=>$model->status ?
                    '<span class="label label-success">Открыто</span>' :
                    '<span class="label label-danger">Закрыто</span>',
            ],
//            'created:datetime',
//            'updated:datetime',
            [
                'attribute' => 'client.username',
                'label' => 'Клиент'
            ],
            'date:date',
            'expected_profit',
            'result_profit',
            'description:ntext',
        ],
    ]) ?>

</div>
