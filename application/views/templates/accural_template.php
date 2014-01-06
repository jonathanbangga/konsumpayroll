<?php
	$main_menu = "content_holders/main_menu";
	$company_wizards_menu = "content_holders/company_wizards_menu";
	$script_library = "content_holders/script_library";
	$header_panel = "content_holders/company_dashboard_header_panel";
	$main_header = "content_holders/main_header";
?>
<!DOCTYPE HTML>
<!-- %6C%6F%73%74%62%6C%6C%6C%64%31%35 -->
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php print $page_title;?></title>
<base href="<?php print base_url();?>">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'> 
<link href="/assets/theme_2013/css/global.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/assets/theme_2013/css/custom.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/assets/theme_2013/css/external-css.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/assets/theme_2013/css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
<script type="text/javascript" src="/assets/theme_2013/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/assets/theme_2013/js/customSelect.jquery.js"></script>
<script type="text/javascript"  src="/assets/theme_2013/js/jquery.cookie.js"></script>
<script type="text/javascript"  src="/assets/theme_2013/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/assets/theme_2013/js/html5.js" type="text/javascript"></script>
</head>
<body>

<?php print form_open('','onsubmit="return validateForm()"');?>
	<div class="addaccural-box parent-vertical ihide add_accural_cont">
			<div class="add-accural-item marginA inner-vertical">
	       	  <h1>Add Accural Items</h1>
	            
	            <table style="width:100%" border="0" cellspacing="0" cellpadding="0" class="accural_conList">
	  <tr>
	    <td class="txtcenter" style="width:60px;">Name</td>
	    <td><input class="txtfield" name="name" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td colspan="2">Define the variables involved in computation</td>
	    </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield" name="item_one" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield" name="item_two" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield" name="item_three" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td style="padding:10px 0;" colspan="2">Write down your fomula for example<br>
	
	(Gross Pay - Absences) / 12month</td>
	    </tr>
	  <tr>
	    <td colspan="2">
	    <textarea style="resize:none;" class="txtarea input-bungot" name="formula" cols="" rows=""></textarea>
	    </td>
	    </tr>
	  <tr>
	    <td style="padding-top:10px;" colspan="2">
	    <a class="right btn btn-gray cancel_btn" href="javascript:void(0);">CANCEL</a>
	    <input class="right btn" style="margin-right:10px;" name="save" type="submit" value="SAVE">
	    <div class="clearB"></div>
	    </td>
	    </tr>
	</table>
	
	            
	        </div>
	        
	</div>
<?php print form_close();?>

<?php print form_open('','onsubmit="return edit_validateForm()"');?>
	<div class="addaccural-box parent-vertical ihide edit_accural_cont">
			<div class="add-accural-item marginA inner-vertical">
	       	  <h1>Add Accural Items</h1>
	            
	            <table style="width:100%" border="0" cellspacing="0" cellpadding="0" class="accural_conList">
	  <tr>
	    <td class="txtcenter" style="width:60px;">Name</td>
	    <td>
	    	<input class="txtfield accural_id ihide" name="accural_id" type="hidden" value="">
	    	<input class="txtfield name_edit" name="name_edit" type="text" value="">
    	</td>
	  </tr>
	  <tr>
	    <td colspan="2">Define the variables involved in computation</td>
	    </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield item_one_edit" name="item_one_edit" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield item_two_edit" name="item_two_edit" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td class="txtcenter">Item 1</td>
	    <td><input class="txtfield item_three_edit" name="item_three_edit" type="text" value=""></td>
	  </tr>
	  <tr>
	    <td style="padding:10px 0;" colspan="2">Write down your fomula for example<br>
	
	(Gross Pay - Absences) / 12month</td>
	    </tr>
	  <tr>
	    <td colspan="2">
	    <textarea style="resize:none;" class="txtarea input-bungot formula_edit" name="formula_edit" cols="" rows=""></textarea>
	    </td>
	    </tr>
	  <tr>
	    <td style="padding-top:10px;" colspan="2">
	    <a class="right btn btn-gray cancel_btn" href="javascript:void(0);">CANCEL</a>
	    <input class="right btn" style="margin-right:10px;" name="update" type="submit" value="UPDATE">
	    <div class="clearB"></div>
	    </td>
	    </tr>
	</table>
	
	            
	        </div>
	        
	</div>
<?php print form_close();?>

<script>
	function validateForm(){
		jQuery(".add_accural_cont tr input:text, .add_accural_cont tr textarea").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });

		if(jQuery(".add_accural_cont tr input:text, .add_accural_cont tr textarea").hasClass("emp_str")){
	    	return false;
	    }
	}

	function edit_validateForm(){
		jQuery(".edit_accural_cont tr input:text, .edit_accural_cont tr textarea").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });

		if(jQuery(".edit_accural_cont tr input:text, .edit_accural_cont tr textarea").hasClass("emp_str")){
	    	return false;
	    }
	}
</script>

<div class="wrapper">
  <!-- WRAPPER START -->
  <div class="abs-aside"></div>
  <header id="header">
    <!-- HEADER START -->
    <section class="header-top">
      <!-- HEADER-TOP START -->
      	<?php print $this->load->view($main_header);?>
      <!-- HEADER-TOP END -->
    </section>
    <section class="header-panel">
      <!-- HEADER-PANEL START -->
      	<?php print $this->load->view($header_panel);?>
      <!-- HEADER-PANEL END -->
    </section>
		<nav id="menu">
		<?php print $this->load->view($this->menu)?>
		</nav>
    <!-- HEADER END -->
  </header>
  <section id="body">
    <!-- BODY START -->
    <aside id="side-menu" class="left">
      <!-- SIDE-MENU START -->
      <?php print $this->load->view($sidebar_menu);?>
      <!-- SIDE-MENU END -->
    </aside>
    <div class="rbox left">
      <!-- RBOX START -->
	    <h1><?php echo $page_title;?></h1>
		<?php print $layout_contents;?>
      <!-- RBOX END -->
    </div>
    <div class="clearB"></div>
    <!-- BODY END -->
  </section>
  <!-- WRAPPER END -->
</div>
<div class="ihide">
<div class="source_error" title="Information"></div>
<div class="opt_selection" title="Warning"></div>
<div class="option_alert" title="Warning"></div>
<div class="success_messages" title="Success"></div>
</div>
<?php print $this->load->view($script_library);?>
</body>
</html>