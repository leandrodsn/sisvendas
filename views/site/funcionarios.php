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
			            'nome',
			           	'tel',
			           	'cpf' 
			        ],
			    ]);?>
			</div>			
		</div>
	</div>
</div>