<?php
	$main_menu = "content_holders/admin_menu";
	$company_wizards_menu = "content_holders/admin_sidebar_menu";
	$script_library = "content_holders/script_library";
	$header_panel = "content_holders/admin_header_panel";
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
		<?php print $this->load->view($main_menu)?>
    <!-- HEADER END -->
  </header>
  <section id="body">
    <!-- BODY START -->
    <aside id="side-menu" class="left">
      <!-- SIDE-MENU START -->
      <?php print $this->load->view($company_wizards_menu);?>
      <!-- SIDE-MENU END -->
    </aside>
    <div class="rbox left">
      <!-- RBOX START -->
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
<div class="option_alert" title="Warning"></div>
<div class="success_messages" title="Success"></div>
</div>
<?php print $this->load->view($script_library);?>
</body>
</html>