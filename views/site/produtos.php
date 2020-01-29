<?php 
use yii\grid\GridView;
$this->title = "Protudos"
?>

<div class="site-content">
	<div class="container">
		<div class="rows justify-content-center">
			<div class="col-md-8 col-sm-9">
				<h2>Listagem de Produtos</h2>
				<?= GridView::widget([
			        'dataProvider' => $provider,
			        'columns' => [
			            [
			            	'class' => 'yii\grid\SerialColumn',	
			        	],
			            'name',
			           	[	
			           		'attribute' => 'price',
			           		'value' => function($model){ return Yii::$app->formatter->asCurrency($model->price);}
			           	],
			           	[
			           		'attribute'=>'data_validade',
			           		'value'=>function($model){ return date('d/m/yy', strtotime($model->data_validade));}
			           	],
			           	[
			           		'attribute'=>'is_available',
			           		'value'=> function($model){return $model->is_available == 1?'Sim':'Não';}
			           	]
			        ],
			    ]);?>
			</div>			
		</div>
	</div>
</div>