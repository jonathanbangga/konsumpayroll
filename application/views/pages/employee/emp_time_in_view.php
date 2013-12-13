<div class="tbl-wrap">
	<div class="main_time_in_cont">
		<div class="date_cont"><span><?php print date("F")." ".date("d").", ".date("Y");?></span></div>
		<div class="ihide">
			<?php 
				print "<span class='month_val'>".date("m")."</span> ";
				print "<span class='day_val'>".date("d")."</span> ";
				print "<span class='year_val'>".date("Y")."</span>";
			?>
		</div>
		<div class="time_cont"><span></span></div>
		<div class="in_out_cont">
			<?php 
				// If datetime is not already exist in table
				if($time_out == 0){
					print '<a href="javascript:void(0);" class="btn_left btn in_btn">In</a>';
					print '<a href="javascript:void(0);" class="btn btn-gray disable_btn" onclick="return false;">Out</a>';	
				}elseif($time_out == 1){
					print '<a href="javascript:void(0);" class="btn_left btn disable_btn" onclick="return false;">In</a>';
					print '<a href="javascript:void(0);" class="btn btn-gray out_btn">Out</a>';
				}
			?>
		</div>
	</div>
	<div class="time_in_table_cont">
		<table class="tbl" width="933px">
			<tr>
				<th>Date</th>
				<th>Time In</th>
				<th>Lunch Out</th>
				<th>Lunch In</th>
				<th>Time Out</th>
				<th>Hours</th>
				<th>Corrected</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php 
				if($time_in_list != null){
					foreach($time_in_list as $row){
			?>
				<tr>
					<td><?php print $row->date;?></td>
					<td><?php print $row->time_in;?></td>
					<td><?php print $row->lunch_out;?></td>
					<td><?php print $row->lunch_in;?></td>
					<td><?php print $row->time_out;?></td>
					<td><?php print $row->total_hours;?></td>
					<td><?php print $row->corrected;?></td>
					<td><?php print $row->reason;?></td>
					<td><?php print $row->tax_status;?></td>
					<td>Action</td>
				</tr>
			<?php 		
					}
				}else{
					echo "<td colspan='10'>";
					print msg_empty();
					echo "</td>";
				}
			?>
		</table>
	</div>
</div>
<style>
	.main_time_in_cont {
		border: 1px solid #CCCCCC;
	    height: 235px;
	}
	.date_cont {
		margin-top: 50px;
    	text-align: center;
    	height: 18px;
	}
	.date_cont span {
		font-size:18pt;
	}
	.time_cont {
		margin-top:30px;
		text-align: center;
	}
	.time_cont span{
		font-size:48pt;
		font-weight:bold;
	}
	.in_out_cont{
		margin-top: 45px;
    	text-align: center;
	}
	.btn_left{
		margin-right: 20px;
	}
	.time_in_table_cont {
		margin-top: 30px;
	}
	.disable_btn {
		opacity: 0.2!important;
	}
</style>
<script>
	function updateTime() {
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();
		var seconds = currentTime.getSeconds();
		if (minutes < 10){
			minutes = "0" + minutes;
		}
		if (seconds < 10){
			seconds = "0" + seconds;
		}
		var v = hours + ":" + minutes + ":" + seconds + " ";
		if(hours > 11){
			v+="PM";
		} else {
			v+="AM"
		}
		setTimeout("updateTime()",1000);
		jQuery(".time_cont span").html(v);
	}

	function time_in(){
		jQuery(".in_btn").click(function(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
					'process_time_in':'1',
				},
				success: function(data){
					 var status = jQuery.parseJSON(data);
	               	 if(status.success == 1){
	               		window.location.href = status.url;
	                 }else{
	                 	return false;
	               	}
				}
	 	    });
		});
	}

	function time_out(){
		jQuery(".out_btn").click(function(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
					'process_time_out':'1',
				},
				success: function(data){
					 var status = jQuery.parseJSON(data);
	               	 if(status.success == 1){
	               		window.location.href = status.url;
	                 }else{
	                 	return false;
	               	}
				}
	 	    });
		});
	}
	
	jQuery(function(){
		updateTime();
		time_in();
		time_out();
	});
</script>