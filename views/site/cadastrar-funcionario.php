<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Cadastro de Funcionarios';
?>
<div class="site-content mb-4">
	<div class="container">
		<h2 class="title">Cadastrar Funcionario</h2>
		<div class="form-container">
			<?php 
				$form = ActiveForm::begin([
				'id'=>"create-func-form",
				'method' => 'POST',
				'enableAjaxValidation' => false
			]); ?>
				<div class="row">
					<div class="col-md-6">
						<?=$form->field($funcForm, 'nome')->textInput()?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<?=$form->field($funcForm, 'tel')->widget(\yii\widgets\MaskedInput::className(),[
							'name'=>'masked-input',
							'mask' => ['(99) 99999-9999', '(99) 99999-9999']
						])?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<?=$form->field($funcForm, 'cpf')->widget(\yii\widgets\MaskedInput::className(),[
							'name'=>'masked-input',
							'mask' => '999.999.999-99'
						])?>
					</div>
				</div>

				<?= Html::submitButton('Cadastrar', ['options' => ['class'=> 'btn btn-primary']])  ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>