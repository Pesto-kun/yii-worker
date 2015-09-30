<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contractor".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created
 * @property integer $task_id
 * @property integer $client_id
 * @property integer $price
 * @property string $comment
 *
 * @property Task $task
 * @property Client $client
 */
class Contractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created', 'task_id', 'client_id', 'price'], 'integer'],
            [['task_id', 'client_id'], 'required'],
            [['comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'created' => 'Создано',
            'task_id' => 'ID задачи',
            'client_id' => 'Подрядчик',
            'price' => 'Цена',
            'comment' => 'Комментарий',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                ],
                'value' => function() { return date('U');},
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
}
