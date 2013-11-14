 <div class="tbl-wrap">
          <table class="company-list-tbl">
			<?php 
			foreach($company->result() as $row){?>
			 <tr>
              <td class="txtcenter" style="width:200px;"><img src="<?php echo $row->company_logo ?>" alt=" "></td>
              <td style="width:340px;"><h1><?php echo $row->company_name; ?></h1></td>
              <td style="width:200px;" class="txtright"><a class="btn btn-gray" href="#">MANAGE</a> <a class="btn btn-red" href="#">DELETE</a></td>
            </tr>
			<?php 
			} ?>
          </table>
        </div>
        <a href="/company/company_setup/company_information/" class="btn">ADD COMPANY</a>
