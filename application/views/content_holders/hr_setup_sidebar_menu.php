<?php $uri =  $this->uri->segment(3); ?>
<ul>
	<li <?php if($uri=='employment_type'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/employment_type">Employment Type</a></li>
	<li <?php if($uri=='department_and_positions'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/department_and_positions">Departments &amp; Positions</a></li>
	<li <?php if($uri=='approval_groups'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/approval_groups">Approval Groups</a></li>
	<li <?php if($uri=='projects'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/projects">Projects</a></li>
	<li <?php if($uri=='locations'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/locations">Location</a></li>
	<li <?php if($uri=='ranks'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/ranks">Rank</a></li>
	<li <?php if($uri=='job_grade'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/job_grade">Job Grade</a></li>
	<li <?php if($uri=='leaves'){ echo 'class="selected"'; } ?>><a href="/company/hr_setup/leaves">Leave</a></li>
</ul>