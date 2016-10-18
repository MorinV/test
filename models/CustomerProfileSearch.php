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
	public $fullName; 
	public $lastOrderText;
	public $minOrders;
	
	 
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['firstname', 'secondname', 'lastname', 'date_registred', 'minOrders', 'fullName', 'lastOrderText'], 'safe'],
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
			'lastOrderId' => [
				'asc' => ['order.id' => SORT_ASC],
                'desc' => ['order.id' => SORT_DESC],
                'label' => 'Последний заказ',
			]
			
        ]
    ]);

		if (!($this->load($params) && $this->validate())) {
			$query->joinWith(['orders']);
			return $dataProvider;
		}
		
		$this->addCondition($query, 'id');
		$this->addCondition($query, 'firstname', true);
		$this->addCondition($query, 'lastname', true);
		$this->addCondition($query, 'secondname', true);
		$this->addCondition($query, 'status');
		
		$words=explode(" ", $this->fullName);
		foreach ($words as $word)
			$query->andWhere('CONCAT(`lastname`, " ",`firstname`," ",`secondname`) LIKE "%' . $word. '%" ');
		
		$query->joinWith(['orders']);
        return $dataProvider;
    }
	
	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}
	 
		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
	 
		/*
		 * Для корректной работы фильтра со связью со
		 * свой же моделью делаем:
		 */
		$attribute = "customer_profile.$attribute";
	 
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
