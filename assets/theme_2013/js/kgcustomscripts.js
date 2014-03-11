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

var exp = {
		init: function() {
			var cnt = 0;
			$('.addBtn').click(function(){
				$('.saveBtn').show();
				
				var x = cnt;
				cnt++;
				var url = location.pathname + '/add_expense/' + x;
				
				$.get(url, function(data){
					$('.expenseBox tbody').append(data);
					$('.datepicker').datepicker({
						dateFormat: 'dd/mm/yy'
					});
				});
			});
			
			$(document).on('change','.employee',function() {
				var y = $(this).val();
				var z = $(this).attr('id');
				$.ajax({
					url: location.pathname + '/get_employee/' + y,
					type: 'GET',
					dataType: 'JSON',
					success: function(data) {
						$('tr#'+z).find('.name').html(data.name);
					}
				});
			});
			
			$(document).on('change','.expense_type_id',function() {
				var y = $(this).val();
				var z = $(this).attr('id');
				$.ajax({
					url: location.pathname + '/get_expense_type/' + y,
					type: 'GET',
					dataType: 'JSON',
					success: function(data) {
						$('tr#'+z).find('.minimum').html(data.minimum_amount);
						$('tr#'+z).find('.maximum').html(data.maximum_amount);
					}
				});
			})
		},
		form_validation: function() {
			
		}
}