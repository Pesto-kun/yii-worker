<?php

namespace app\models\client;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * @author pest (pest11s@gmail.com)
 */

class Search extends Client {
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username', 'type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere([
            'status' => Client::STATUS_ACTIVE,
        ]);

        $query->andFilterWhere([
            'status' => $this->status,
            'type' => $this->type,
        ]);
        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}