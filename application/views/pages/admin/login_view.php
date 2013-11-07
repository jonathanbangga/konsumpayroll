<?php echo form_open("login/validate_login/1");?>
<div class="logo3">
      <!-- LOGO3 START -->
      <img src="/assets/theme_2013/images/img-logo3.png" alt=" ">
      <!-- LOGO3 END -->
    </div>
    <table style="width:180px" class="marginA">
  <tr>
    <td colspan="2"><input class="txtfield input-bungot" name="user" type="text" placeholder="Email"></td>
    </tr>
  <tr>
    <td colspan="2"><input class="txtfield input-bungot" name="pass" type="password" placeholder="Password"></td>
    </tr>
  <tr>
    <td><a class="forgot-password" href="#">Forgot Password?</a></td>
    <td class="txtright"><input class="btn btn-blue" type="submit" value="LOGIN"></td>
  </tr>
</table>
<?php echo form_close();?>