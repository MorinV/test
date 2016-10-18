<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-profile-index">

    <?php  echo $this->render('_search', ['model' => $searchModel, 'nameProfiles' => $nameProfiles,]); ?>

	   <?= GridView::widget([ 
       'dataProvider' => $dataProvider, 
   	   'layout'=>"{sorter}\n{items}",
       'columns' => [ 
		   'fullName',
		   'lastOrderText:html',
		   'countOrders',
		   'sumOrders',
           'statusName', 
           'date_registred', 
       ], 
   ]); ?> 
</div>
