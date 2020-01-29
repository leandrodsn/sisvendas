<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Sisvendas';
?>
<div class="site-index">
    <h2 class="title">Wellcome to Sisvendas!</h2>
    <div class="body-content mt-5">
    	<h1><?= Html::encode($this->title) ?></h1>
    	<div class="wrapper-price">
    		<h1 class="btn btn-primary"> Total: <span class="badge badge-light badge-price">R$ 0,0</span></h1>
    	</div>
    	<div class="tab-price">0</div>
		<?php ActiveForm::begin(['id' => 'form-venda', 'action' => 'site/venda'])?>
		<?= GridView::widget([
	        'dataProvider' => $provider,
	        "id" => "grid",
	        'columns' => [
	            [
	            	'class' => 'yii\grid\CheckboxColumn',	
	            	'multiple' => true
	        	],
	            'name',
	           	[	
	           		'attribute' => 'price',
	           		'value' => function($model){ return Yii::$app->formatter->asCurrency($model->price);}
	           	]	
	        ],
	    ]);?>
		<?= Html::button('Concluir venda', ['class' => 'btn btn-success']) ?>
		<?php ActiveForm::end();?>
    </div>
</div>
