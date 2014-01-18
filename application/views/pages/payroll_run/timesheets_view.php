<?php
echo form_open_multipart("/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets"); 
?>
<div class="main-content"> 
<div style="display:none;" class="highlight_message">Message</div>
<!-- MAIN-CONTENT START -->
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
<p>
<table class="tbl1">
	<tbody>
		<tr>
			<td>Choose what data to process</td>
			<td>
				<select name="" class="txtselect">
					<option>Import File</option>
					<option>Time-ins</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Choose file to import</td>
			<td>
				<input type="file" name="file" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="upload" class="btn" value="upload" />
			</td>
		</tr>
	</tbody>
</table>




</p>  
<div class="tbl-wrap">
  <table width="915" border="0" cellspacing="0" cellpadding="0" class="tbl">
	<tr>
	  <!--<th width="96">Source </th>-->
	  <th width="101">Employee ID</th>
	  <th width="171">Employee Name</th>
	  <th width="96">Date</th>
	  <th width="111">Time In</th>
	  <th width="111"> Time Out</th>
	</tr>
	<tr>
	  <!--<td>Excel</td>-->
	  <td>09-00678</td>
	  <td>Robert Jaworski</td>
	  <td>2013-08-10</td>
	  <td>12:14:04</td>
	  <td>12:14:04</td>
	</tr>
	<tr>
	  <!--<td>Excel</td>-->
	  <td>09-00678</td>
	  <td>Robert Jaworski</td>
	  <td>2013-08-10</td>
	  <td>12:14:04</td>
	  <td>12:14:04</td>
	</tr>
  </table>
</div>
<p class="pagination" style="margin-top:-25px;"><a href="#" class="prev">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#" class="next">Next</a> </p>
<!-- MAIN-CONTENT END --> 
</div>
<div class="footer-grp-btn" style="width:820px;"> 
<!-- FOOTER-GRP-BTN START --> 
<a class="btn btn-gray left" href="#">BACK</a>
<input class="btn right" name="" type="button" value="SAVE">
<!-- FOOTER-GRP-BTN END --> 
</div>
<?php echo form_close(); ?>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.tbl1 td{
	padding: 10px;
}
</style>
<script>
jQuery(document).ready(function(){
	// load highlight message script
	redirect_highlight_message();
});
</script>