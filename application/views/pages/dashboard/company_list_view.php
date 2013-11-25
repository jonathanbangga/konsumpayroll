 <div class="tbl-wrap">
	<?php if($company->num_rows()>0){ ?>
		<table class="company-list-tbl">
			<?php 
			foreach($company->result() as $row){?>
			 <tr>
              <td class="txtcenter" style="width:200px;">
             
              <img src="<?php echo image_exist($row->company_logo,$row->company_id);?>" class="list_logos" alt=" ">              
              </td>
              <td style="width:340px;"><h1><?php echo $row->company_name;?></h1></td>
              <td style="width:200px;" class="txtright">
              <a class="btn btn-gray" href="<?php echo "/".$row->sub_domain."/hr/emp_basic_information"?>">MANAGE</a> 
              <a class="btn btn-red" href="#">DELETE</a>
              </td>
            </tr>
			<?php 
			} ?>
          </table>
	<?php
	}else{
		echo "No company yet";
	}
	?>
          
        </div>
        <a href="/company/company_setup/company_information/" class="btn">ADD COMPANY</a>
