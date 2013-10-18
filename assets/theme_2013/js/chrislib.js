var kpay = {
		hr: {
			company_sidebar: function(){ // 
				jQuery(".jsidebar a").each(function(e){
					var current_url = window.location.href;
					var _urls = jQuery(this).attr("href");
					if(current_url == _urls) {
						jQuery(this).parent().addClass("selected");
						return false;
					}
				});
			}
		},
		admin: {
			company:{
				add_company: function(e){
					if(jQuery.trim(jQuery("#error").html())){
						var h = jQuery("#error").html();
						alert(h);
					}
				}
			},
			userz: {
				add_users: function(urls,token) {
				 	$.ajax({
					url:urls,
					type: "POST",
					data:{
						'owner_name':jQuery("input[name='owner_name']").val(),
						'email_address':jQuery("input[name='email_address']").val(),
						'password':jQuery("input[name='password']").val(),
						'cpassword':jQuery("input[name='cpassword']").val(),
						'ZGlldmlyZ2luamM':jQuery.cookie(token),
						'add':'true'
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {
								jQuery(".success_add").dialog({width: 'auto',Maxwidth:750,close: function() { location.reload(); }});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
					});return false;
				},
				show_add_form: function(){
					jQuery(document).on('click',"#jlight_adduser",function(e){
						e.preventDefault();
						jQuery(".jreg").dialog();
					});
				}
			}
		}
};

// overwrite comments
window.alert = function(msg){

   jQuery(".source_error").html(msg);
   jQuery(".source_error").dialog({
	   width: 'inherit',
	   draggable: false,
	   modal: true,
	   dialogClass:'transparent',
	   open : function() {
		   jQuery('.source_error').dialog("option", "title" ,"Information");
	   },
	   overlay: {
   		   opacity: 0
   	   }
   });
}

jQuery(function() {
	kpay.hr.company_sidebar();
});
