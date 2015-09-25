<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $client_id
 * @property string $title
 * @property integer $date
 * @property integer $expected_profit
 * @property integer $result_profit
 * @property string $description
 *
 * @property Client $client
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created', 'updated', 'closed', 'client_id', 'expected_profit', 'result_profit'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Открыто',
            'created' => 'Создано',
            'updated' => 'Обновлено',
            'closed' => 'Закрыто',
            'client_id' => 'ID клиента',
            'title' => 'Название задачи',
            'date' => 'Дата завершения',
            'expected_profit' => 'Ожидаемая прибыль',
            'result_profit' => 'Прибыль по факту',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
}
