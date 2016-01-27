<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function ($data) {
                    return $data->status === 1 ?
                        '<span class="label label-success">Открыто</span>' :
                        '<span class="label label-danger">Закрыто</span>';},
                'label' => 'Статус'
            ],
            [
                'attribute' => 'priority',
                'format'=>'raw',
                'value' => function ($data) {
                    return \app\models\Priority::getPriorityLabel($data->priority);},
                'label' => 'Приоритет'
            ],
            'client.username',
            'title',
            'created:datetime',
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($data) {
                    /* @var $data \app\models\Task */
                    return $data->getThemedDate();
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
