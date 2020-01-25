<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Cadastro de Produtos';
?>
<div class="site-content mb-4">
	<div class="container">
		<h2 class="title">Cadastrar Produto</h2>
		<div class="form-container">
			<?php 
				$form = ActiveForm::begin([
				'id'=>"create-product-form",
				'method' => 'POST',
				'enableAjaxValidation' => false
			]); ?>
				
				<div class="row">
					<div class="col-md-6">
						<?=$form->field($productForm, 'name')->textInput()?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<?=$form->field($productForm, 'price')->textInput(['type'=>'number'])?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<?=$form->field($productForm, 'data_validade')->widget(kartik\date\DatePicker::class, 
							[
								'options' => ['placeholder'=> 'Selecione uma data'],
								'convertFormat' => true,
						        'pluginOptions' => [
						            'todayHighlight' => true
						        ]
							]
						)?>
					</div>
				</div>

				<?= Html::submitButton('Cadastrar', ['options' => ['class'=> 'btn btn-primary']])  ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>