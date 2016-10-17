<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CustomerProfile;

/**
 * CustomerProfileSearch represents the model behind the search form about `app\models\CustomerProfile`.
 */
class CustomerProfileSearch extends CustomerProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['firstname', 'secondname', 'lastname', 'date_registred', 'fullName'], 'safe'],
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
        $query = CustomerProfile::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->setSort([
        'attributes' => [
            'id',
            'fullName' => [
                'asc' => ['firstname' => SORT_ASC, 'lastname' => SORT_ASC],
                'desc' => ['firstname' => SORT_DESC, 'lastname' => SORT_DESC],
                'label' => 'Full Name',
                'default' => SORT_ASC
            ],
            'country_id'
        ]
    ]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}
		

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'date_registred' => $this->date_registred,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'secondname', $this->secondname])
            ->andFilterWhere(['like', 'lastname', $this->lastname]);


        return $dataProvider;
    }
}
