<?php
use app\models\ContactType;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого клиента?',
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
                    '<span class="label label-success">Активен</span>' :
                    '<span class="label label-danger">Неактивен</span>',
            ],
            'username',
            'typeLabel',
            'description:ntext',
        ],
    ]) ?>

    <h2>Контакты</h2>
    <?= Html::a('Добавить контакт', ['contact/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $model->getContacts(),
        'pagination' => false,
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showHeader' => false,
        'columns' => [
            [
                'value' => function ($data) { return ContactType::getTypeName($data->type); }
            ],
            'value',
            'comment',
            [
                'format' => 'raw',
                'value' => function ($data) { return Html::a('Изменить', ['contact/update', 'id' => $data->id]); }
            ],
        ],
    ]); ?>
</div>
