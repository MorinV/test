<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_profile".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $secondname
 * @property string $lastname
 * @property integer $status
 * @property string $date_registred
 *
 * @property CustomerStatus $status0
 * @property Order[] $orders
 */
class CustomerProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'status', 'date_registred'], 'required'],
            [['status'], 'integer'],
            [['date_registred'], 'safe'],
            [['firstname', 'secondname', 'lastname'], 'string', 'max' => 255],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'secondname' => 'Secondname',
            'lastname' => 'Lastname',
            'status' => 'Status',
            'date_registred' => 'Зарегистрирован',
			'fullName' => 'ФИО клиента',
			'countOrders' => 'Всего заказов',
			'lastOrderText' => 'Последний заказ',
			'sumOrders' => 'Сумма заказов',
			'statusName' => 'Статус',
        ];
    }
	
	public function getFullName()
	{
		return $this->lastname . ' ' . $this->firstname . ' ' . $this->secondname;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(CustomerStatus::className(), ['id' => 'status']);
    }
	
	public function getStatusName()
	{
		return $this->status0->name;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id_user' => 'id']);
    }
	
	public function getCountOrders()
    {
        return $this->hasMany(Order::className(), ['id_user' => 'id'])->count();
    }
	
	public function getSumOrders()
    {
		$sum=0;
		foreach($this->orders as $order)
			$sum+=$order->total;
		return $sum;
    }
	
	public function getLastOrder()
	{
		return $this->hasMany(Order::className(), ['id_user' => 'id'])
					->orderBy('date DESC')
					->one();
	}
	
	public function getLastOrderText()
	{
		return 	$this->lastOrder->textNumber.' <br>'.$this->lastOrder->date.'<br>'.$this->lastOrder->textTotal;
	}
}
