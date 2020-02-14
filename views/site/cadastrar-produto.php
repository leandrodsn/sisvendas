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
						<?=$form->field($productForm, 'price')->widget(\yii\widgets\MaskedInput::className(),[
							'name'=>'masked-input',
							'clientOptions' => [
								'alias' => 'decimal',
						        'digits' => 2,
						        'digitsOptional' => false,
						        'radixPoint' => ',',
						        'prefix'=>'R$ ',
						        'groupSeparator' => '.',
						        'autoGroup' => true,
						        'removeMaskOnSubmit' => true,
							]
						])?>
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

				<div class="row">
					<div class="col-md-6">
						<?=$form->field($productForm, 'is_available')->dropDownList([0=>'Não', 1=>'Sim'])?>
					</div>
				</div>

				<?= Html::submitButton('Cadastrar', ['class'=> 'btn btn-primary'])  ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>