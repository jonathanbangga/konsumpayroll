<div class="main-content">
	<?php echo form_open()?>
	<div class="tbl-wrap">
		<table width="1175" border="0" cellspacing="0" cellpadding="0" class="tbl expenseBox">
			<thead>
			<tr>
				<th width="41">&nbsp;</th>
				<th width="41">&nbsp;</th>
				<th width="116">Employee ID</th>
				<th width="176">Employee Name</th>
				<th width="118">Expense Type</th>
				<th width="118">Minimum</th>
				<th width="118">Maximum</th>
				<th width="116">Date</th>
				<th width="117">Amount</th>
			</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	<div class="group-btns" style="margin: -25px 0 30px; overflow: hidden">
		<a href="#" class="btn btn-red left">Delete</a>
		<a href="#" class="btn right addBtn" onclick="return false">Add More</a>
		<button type="submit" class="btn right saveBtn hide" style="height:27px; margin:0 5px">Save</a>
	</div>
	<?php echo form_close()?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	exp.init();
});
</script>
