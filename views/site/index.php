<?php
use kartik\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['task/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'priority',
                'format'=>'raw',
                'value' => function ($data) {
                    return \app\models\Priority::getPriorityLabel($data->priority);},
                'label' => 'Приоритет'
            ],
            'title',
            'client.username',
            'expected_profit',
            'date:datetime',
            [
                'format' => 'raw',
                'value' => function ($data) { return Html::a('Подробно', ['task/view', 'id' => $data->id]); }
            ],
        ],
    ]); ?>

</div>
