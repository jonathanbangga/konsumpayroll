function jAccordion(){
	jQuery("#side-menu li").click(function(){
		var _ul = jQuery(this).find("ul");
		if(!_ul.is(":visible")){
			jQuery("#side-menu ul ul").slideUp();
			jQuery(this).find("ul").stop().slideDown();
		}else{
			jQuery(this).find("ul").stop().slideUp();
		}
	});
}

function basic_file_li(){
	// 201 File
	jQuery(".201_file_li").find("ul").show();
	jQuery(".201_file_li a").eq(0).css("background","#F2F2F2");
}

function payroll_info_li(){
	// Payroll Information
	jQuery(".payroll_info_li").find("ul").show();
	jQuery(".payroll_info_li a").eq(0).css("background","#F2F2F2");
}

function loan_li(){
	// Employee Loan
	jQuery(".loan_li").find("ul").show();
	jQuery(".loan_li a").eq(0).css("background","#F2F2F2");
}

function shift_li(){
	// Employee Shift
	jQuery(".shift_li").find("ul").show();
	jQuery(".shift_li a").eq(0).css("background","#F2F2F2");
}

jQuery(function(){
	jAccordion();
});