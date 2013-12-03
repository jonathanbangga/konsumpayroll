<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Night Shift Differential is an additional payment for employees that are working on night shifts.<br>
          It is computed generally from work done between 10:00 PM until 6:00 AM the following day.<br>
          If you have a different time range for recognizing night shift differential, please select the time below.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="width:45px;">From</td>
              <td>
				<select style="width:60px;" class="txtselect" name="">
					<?php for($i=1;$i<=12;$i++){ ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
                </select>
                :
                <select style="width:60px;" class="txtselect" name="">
					<?php for($i=0;$i<=60;$i++){ ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
                </select>
                <select style="width:60px;" class="txtselect" name="">
                  <option>AM</option>
                  <option>PM</option>
                </select></td>
              <td style="width:55px;" class="txtcenter">To</td>
              <td><select style="width:60px;" class="txtselect" name="">
                  <option>08</option>
                </select>
                :
                <select style="width:60px;" class="txtselect" name="">
                  <option>00</option>
                </select>
                <select style="width:60px;" class="txtselect" name="">
                  <option>AM</option>
                  <option>PM</option>
                </select></td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p> Night Differential Rate (%)
          <input style="width:55px; margin-left:5px;" class="txtfield" name="" type="text">
        </p>
		<a href="javascript:void(0);" class="btn" id="save">SAVE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>