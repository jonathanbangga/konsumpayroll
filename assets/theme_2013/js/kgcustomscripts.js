var enc = {
		init: function() {
			$('.updateBtn').click(function(){
				$('.d').hide();
				$(this).hide();
				$('.e').show();
				$('.saveBtn').show()
			});
		},
		commission: function() {
			$('.sales_amount, .earning_id').change(function(){
				var x = $(this).parent().parent().parent().attr('id');
				var sa = $('tr#'+x).find('.sales_amount').val();
				var e = $('tr#'+x).find('.earning_id').val();
				
				var data = {
						ZGlldmlyZ2luamM : $.cookie(settings.tn),
						sales_amount : sa,
						earning_id : e
				}
				$.ajax ({
					url : document.location.pathname.replace('/commission','/calculate'),
					type: 'POST',
					data : data,
					dataType: 'JSON',
					async: false,
					success: function(data) {
						$('tr#'+x).find('.rate_per').html(data.rate_per);
						$('tr#'+x).find('.tax_rate').html(data.tax_rate);
						$('tr#'+x).find('.commission_amount').html(data.commission_amount);
					}
				})
				
				
			});
		},
		earning: function() {
			$('.sales_amount, .earning_id').change(function(){
				var x = $(this).parent().parent().parent().attr('id');
				var sa = $('tr#'+x).find('.sales_amount').val();
				var e = $('tr#'+x).find('.earning_id').val();
				
				var data = {
						ZGlldmlyZ2luamM : $.cookie(settings.tn),
						sales_amount : sa,
						earning_id : e
				}
				$.ajax ({
					url : document.location.pathname.replace('/other_earnings','/calculate'),
					type: 'POST',
					data : data,
					dataType: 'JSON',
					async: false,
					success: function(data) {
						$('tr#'+x).find('.tax_rate').html(data.tax_rate);
						$('tr#'+x).find('.amount').html(data.commission_amount);
					}
				})
				
				
			});
		}
}