<?php

namespace app\models\task;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * @author pest (pest11s@gmail.com)
 */

class DashboardSearch extends Task {
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority', 'client_id', 'user_id'], 'integer'],
            [['title'], 'string'],
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
        $query = Task::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'priority' => SORT_DESC,
                    'date' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere([
            'status' => Task::STATUS_ACTIVE,
        ]);

        $query->andFilterWhere([
            'priority' => $this->priority,
            'client_id' => $this->client_id,
            'user_id' => $this->user_id,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}