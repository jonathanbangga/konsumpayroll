
   <div class="activity-box box-log left">
        <!-- ACTIVITY-BOX START -->
        <h1>Activity Logs</h1>
        <ul>
        <?php 
        	if($logs){
        		$date = "";
        		foreach($logs as $logs_fetch):
				echo " <li>";
        			if($date !=idates($logs_fetch->date)) {	
						echo " <div class=\"activity-date\">".idates($logs_fetch->date)."</div>";
					}
					$date = idates($logs_fetch->date);	 
					echo "<section>";
              		echo "<p><span>".time_only($logs_fetch->date)."</span> ".$logs_fetch->name."</p>";
           			echo "</section>";
         		echo "</li>";	
				endforeach;
        	}else{
        		echo '<li> <div class="activity-date">'.idates(idates_now()).'</div>';
        		echo '<section><p>No activity yet has been made to the system yet.</p></section>';
        		echo '</li>';
        	}
        ?>
        
        </ul>
        <p><?php echo $pagi;?></p>
        <!-- ACTIVITY-BOX END -->
      </div>
      
      <div class="notification-box box-log right">
        <!-- ACTIVITY-BOX START -->
        <h1>Notifications</h1>
<ul>
        	<li>Information Technology will expire in November 17, 2013</li>
        	<li>Microsoft admin added a user in information technology ltd</li>
        	<li>Information Technology will expire in November 17, 2013</li>
        	<li>Microsoft admin added a user in information technology ltd</li>
        </ul>
        <!-- ACTIVITY-BOX END -->
      </div>
      <div class="clearB"></div>
	  