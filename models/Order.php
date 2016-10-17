<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $date
 *
 * @property CustomerProfile $idUser
 * @property OrderProducts[] $orderProducts
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'date'], 'required'],
            [['id_user'], 'integer'],
            [['date'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerProfile::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(CustomerProfile::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['id_order' => 'id']);
    }
	
	public function getTextNumber()
	{
		return '№ '.$this->id;
	}
	
	public function getTotal()
	{
		$sum=0;
		foreach($this->orderProducts as $orderProduct)
			$sum+=$orderProduct->quantity*$orderProduct->idProduct->price;
		return $sum;
	}
	
	public function getTextTotal()
	{
		return $this->total.' р.';
	}
}
