<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $status
 * @property string $username
 * @property string $description
 *
 * @property Contact[] $contacts
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username'], 'required'],
            [['description'], 'string'],
            [['username'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Активен',
            'username' => 'ФИО',
            'description' => 'Подробно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['client_id' => 'id']);
    }
}
