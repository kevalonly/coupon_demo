 $(document).ready(function() {
	$('.apply_code').on('click', function () {
		var coupon_code = $('#coupon_code').val();
		var product_price = $('#product_price').val();
		if(coupon_code !='')
		{
			$.ajax({
				type: 'post',
				url: '/coupon/coupon_validator',
				data: {
					'_token': $('input[name=_token]').val(),
					'coupon_code': coupon_code,
					'product_price':product_price
				},
				success: function(data) {
					console.log(data);
					if ((data.errors)){
						$('.error').removeClass('hidden');
						$('.success').addClass('hidden');
						$('#cart_button').addClass('hidden');
						$('.error').text(data.errors.message);
					}
					else {
						$('.error').addClass('hidden');
						$('.success').removeClass('hidden');						
						$('#cart_button').removeClass('hidden');						
						$('.success').text(data.success.message);
						$('#coupon_id').val(data.coupon_id);
						$('#product_price').val(data.discount_amount);
						$('#discounted_price_tag').html("<div class='form-group'><strong>Discouted price: </strong>"+ data.discount_amount +"</div>");
						//$('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
					}
				},

			});
		}
		else
		{
			$('.error').removeClass('hidden');
			$('.error').text('enter valid coupon code');
		}
	});
});