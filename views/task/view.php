<?php
use kartik\tabs\TabsX;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $tab1 = '';
    $tab1 .= Html::tag('p', Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']));
    $tab1 .= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'status',
                'label'=>'Статус',
                'format'=>'raw',
                'value'=>$model->status ?
                    '<span class="label label-success btn-">Открыто</span>' :
                    '<span class="label label-danger">Закрыто</span>',
            ],
            [
                'attribute' => 'priority',
                'format'=>'raw',
                'value' => \app\models\Priority::getPriorityLabel($model->priority),
                'label' => 'Приоритет'
            ],
            [
                'attribute' => 'client.username',
                'label' => 'Клиент'
            ],
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => $model->getThemedDate()
            ],
            'expected_profit',
            'result_profit',
            'description:ntext',
        ],
    ]);
    $tab1 .= Html::tag('p', Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить эту задачу?',
            'method' => 'post',
        ],
    ]));

    $tab2 = '';
    $tab2 .= Html::tag('p', Html::a('Добавить подрядчика', ['contractor/create', 'id' => $model->id],
        ['class' => $model->contractors ? 'btn btn-primary' : 'btn btn-success']));
    if($model->contractors) {
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getContractors(),
            'pagination' => false,
        ]);
        $tab2 .= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'client.username',
                    'label' => 'Подрядчик',
                ],
                'price',
                'comment',
                [
                    'format' => 'raw',
                    'value' => function ($data) { return Html::a('Редактировать', ['contractor/update', 'id' => $data->id]); }
                ],
            ],
        ]);
    }

    $tab3 = '';
    $tab3 .= Html::tag('p', Html::a('Добавить комментарий', ['comment/create', 'id' => $model->id],
        ['class' => $model->comments ? 'btn btn-primary' : 'btn btn-success']));
    if($model->comments) {
        $li = '';
        foreach($model->comments as $_comment) {
            $li .= Html::tag('li', $_comment->text, ['class' => 'list-group-item']);
        }
        $tab3 .= Html::tag('ul', $li, ['class' => 'list-group']);
    }

    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Описание',
            'content'=> $tab1,
            'active'=>true
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> Подрядчики',
            'content'=> $tab2,
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-list"></i> Комментарии',
            'content'=> $tab3,
        ],
    ];

    echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'bordered'=>true,
        'encodeLabels'=>false
    ]);
    ?>

</div>
