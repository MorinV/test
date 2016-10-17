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

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php /*
	<table class="table">
	<tr><td>ФИО Клиента</td><td>Последний заказ</td><td>Всего заказов</td><td>Сумма заказов</td><td>Статус клиента</td><td>Зарегестрирован</td></tr>
	<?php foreach($models as $model) { ?>
	<tr>
		<td>
			<?= Html::encode($model->lastname) ?>
			<?= Html::encode($model->firstname) ?>
			<?= Html::encode($model->secondname) ?>
		</td>
		<td>
			<?= Html::encode($model->lastOrder->textNumber) ?>
			<br>
			<?= Html::encode($model->lastOrder->date) ?>
			<br>
			<?= Html::encode($model->lastOrder->textTotal) ?>
		</td>
		<td>
			<?= Html::encode($model->countOrders) ?>
		</td>
		<td>
			<?= Html::encode($model->sumOrders) ?>
		</td>
		<td>
			<?= Html::encode($model->status0->name) ?>
		</td>
		<td>
			<?= Html::encode($model->date_registred) ?>
		</td>
	</tr>
	<?php } ?>
	</table>
*/ ?>

	   <?= GridView::widget([ 
       'dataProvider' => $dataProvider, 
       'filterModel' => $searchModel, 
	   'layout'=>"{items}",
       'columns' => [ 
		   'fullName',
		   'lastOrderText',
		   'countOrders',
		   'sumOrders',
           'statusName', 
           'date_registred', 
       ], 
   ]); ?> 
</div>
