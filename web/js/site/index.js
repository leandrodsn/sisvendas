(function($){

	var $keys;
	var form = $("#form-venda");
	$('.btn-success').on('click', function(){
		$keys = $("#grid").yiiGridView('getSelectedRows');
		console.log($keys);
		$.ajax({
			url: document.location.origin + '/site/venda',
			type: 'POST',
			data: {ids: $keys},
			success:function(data){
				if(data.message == 'error')
					form[0].reset();
				else
					location.reload();
			}
		});
	});

	var rows = $("#form-venda tbody tr");
	var label_price = $(".badge-price");
	var total_price = parseFloat($(".badge-price").text().replace(/[^0-9,.]/g, ''));
	rows.each(function($e){
		let siblings = $(this).find("td").siblings();
		$(this).find("input[type='checkbox']").on('change', function(){
			let price = siblings.last().html();
			price = price.replace(/[^0-9.,]/g, '').replace(',', '.');
			if($(this).is(':checked'))
				total_price = total_price+parseFloat(price);
			else
				total_price = total_price-parseFloat(price);
			price_string = 'R$ '+total_price.toFixed(2).toString().replace('.', ',');
			$('.badge-price').text(price_string);
		});
	});

})(jQuery);