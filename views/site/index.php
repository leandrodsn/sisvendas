<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    

    <div class="body-content mt-5">
	
    	<h1><?= Html::encode($this->title) ?></h1>
		
		<?php ActiveForm::begin(['id' => 'form-venda', 'action' => 'site/venda'])?>
		<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        "id" => "grid",
	        'columns' => [
	            [
	            	'class' => 'yii\grid\CheckboxColumn', 
	            	'multiple' => true
	        	],
	            'descricao',
	           	[	
	           		'attribute' => 'preco',
	           		'value' => function($model){ return Yii::$app->formatter->asCurrency($model->preco);}
	           		
	           	]	
	            
	        ],
	    ]);?>
		
		<?= Html::button('Concluir venda', ['class' => 'btn btn-success']) ?>
		<?php ActiveForm::end();?>
    </div>

    <div class="container">
    	<div class="row">
    		<?php foreach ($clientes as $c):?>
				<p><?=$c->nome?></p>
				<p><?=$c->email?></p>
				<p><?=$c->cpf?></p>
    		<?php endforeach; ?>
    	</div>
    </div>
</div>
