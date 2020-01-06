(function($){

	var $keys;
	$('.btn-success').on('click', function(){
		$keys = $("#grid").yiiGridView('getSelectedRows');
		console.log($keys);
		$.ajax({
			url: document.location.origin + '/site/venda',
			type: 'POST',
			data: {ids: $keys},
			success:function(data){
				console.log(data);
			}
		});
	});

	//console.log(document.location);


})(jQuery);