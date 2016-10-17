<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_status".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CustomerProfile[] $customerProfiles
 */
class CustomerStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProfiles()
    {
        return $this->hasMany(CustomerProfile::className(), ['status' => 'id']);
    }
}
