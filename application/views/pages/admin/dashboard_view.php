<h1><?php echo $page_title; ?></h1>
<ul id="actlog">
<?php 
	if($logs) {
	$date = "";
		foreach($logs as $logs_fetch):
			echo "<li>";
				if($date !=idates($logs_fetch->date)) {	
					echo "<h3>".idates($logs_fetch->date)."</h3>";
				}
				$date = idates($logs_fetch->date);	 
			echo $logs_fetch->name." on ".time_only($logs_fetch->date);
			echo "</li>";	
		endforeach;
	} else {
?>
	<li>No activity yet has been made to the system yet.</li>
<?php 
	}
?>
</ul>
<p><?php echo $pagi;?></p>