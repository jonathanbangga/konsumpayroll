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
								jQuery(".success_add").dialog({width: 'auto',Maxwidth:750,close: function() {
									window.location.href ="/admin/users/all_users";

								}});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
					});return false;
				},	
				update_user: function(urls,token){
					jQuery(document).on("click",".juser_edit",function(e) {
						e.preventDefault();
						var el = jQuery(this);
						var getid= el.attr("set_id");
						jQuery(".jshowupdate").dialog();
						jQuery("form.jaddusers_update")[0].reset();
						jQuery.post(urls,{"update_edit":'1',"admin_id":getid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(ret){
							var jres = jQuery.parseJSON(ret);
							jQuery("input[name='edit_owner']").val(jres.owner_name);
							jQuery("input[id^='edit_owner_id']").val(jres.company_owner_id);
							jQuery("input[id^='edit_email']").val(jres.email_address);
							jQuery("input[id^='edit_old_email']").val(jres.email_address);
							jQuery("input[id^='edit_pass']").val();
							jQuery("input[id^='edit_cpass']").val();
						});
					});
				},
				update_user_form: function(urls,token) {
					$.ajax({
					url:urls,
					type: "POST",
					data:{
						'edit_id':jQuery("input[id^='edit_owner_id']").val(),
						'edit_name':jQuery("input[name='edit_owner']").val(),
						'edit_email':jQuery("input[id^='edit_email']").val(),
						'edit_old_email':jQuery("input[id^='edit_old_email']").val(),
						'edit_pass':jQuery("input[id^='edit_pass']").val(),
						'edit_cpass':jQuery("input[id^='edit_cpass']").val(),
						'ZGlldmlyZ2luamM':jQuery.cookie(token),
						'update':'true'
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {
								
								jQuery(".success_updated").dialog({width: 'auto',Maxwidth:750,close: function() {
								window.location.href ="/admin/users/all_users"; 
								}});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
					});
					return false;
				},
				delete_users: function(urls,token) {		
					jQuery(document).on("click",".juser_del",function(e){
						e.preventDefault();
						var el = jQuery(this);
						var ids = el.attr("set_id");
						jQuery(".option_alert").html("Are you sure you want to delete this user?");
						jQuery(".option_alert").dialog({
							resizable: false,
							height: 150,
							modal: true,
							buttons: {
							"Yes": function () {
								jQuery("#jcomp_"+ids).remove();
								jQuery.post(urls,{"admin_id":ids,"ZGlldmlyZ2luamM":jQuery.cookie(token),"delete":"true"});
								jQuery(".option_alert").dialog("close");
							},
							No: function () {
								jQuery(".option_alert").dialog("close");
							}
							}
						});						
					});
				},
				add_users_admin: function(urls,token) {
				 	$.ajax({
					url:urls,
					type: "POST",
					data:{
						'name':jQuery("input[name='name']:visible").val(),
						'email_address':jQuery("input[name='email_address']:visible").val(),
						'username':jQuery("input[name='username']:visible").val(),
						'password':jQuery("input[name='password']:visible").val(),
						'cpassword':jQuery("input[name='cpassword']:visible").val(),
						'ZGlldmlyZ2luamM':jQuery.cookie(token),
						'add':'true',
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {
								jQuery(".success_add").dialog({width: 'auto',Maxwidth:750,close: function() {
									window.location.href ="/admin/users/all_admin";

								}});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
					});return false;
				},
				update_admin_user: function(urls,token){		
					jQuery(document).on("click",".edit_admin",function(e) {
						e.preventDefault();
						var el = jQuery(this);
						var getid= el.attr("set_id");
						jQuery(".edit_users_reg").dialog();
						jQuery("form.jaddusers_update")[0].reset();
						jQuery.post(urls,{"update_edit":'1',"admin_id":getid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(ret){
							var jres = jQuery.parseJSON(ret);
							jQuery("input[id^='edit_name']").val(jres.name);
							jQuery("input[id^='edit_id']").val(jres.konsum_admin_id);
							jQuery("input[id^='edit_email']").val(jres.email_address);
							jQuery("input[id^='edit_old_email']").val(jres.email_address);
							jQuery("input[id^='edit_username']").val(jres.username);
							jQuery("input[id^='edit_username_old']").val(jres.username);
							jQuery("input[id^='edit_password']").val();
							jQuery("input[id^='edit_cpassword']").val();
						});
					});
				},
				update_admin_user_form: function(urls,token) {
					$.ajax({
					url:urls,
					type: "POST",
					data:{
						'edit_id':jQuery("input[name='id']").val(),
						'edit_name':jQuery("input[name='name']:visible").val(),
						'edit_email':jQuery("input[name='email_address']:visible").val(),
						'edit_username':jQuery("input[name='username']:visible").val(),
						'edit_username_old':jQuery("input[name='username_old']").val(),
						'edit_password':jQuery("input[name='password']:visible").val(),
						'edit_cpassword':jQuery("input[name='cpassword']:visible").val(),
						'edit_old_email':jQuery("input[id^='edit_old_email']").val(),
						'ZGlldmlyZ2luamM':jQuery.cookie(token),
						'update':'true'
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {
								jQuery(".success_update").dialog({width: 'auto',Maxwidth:750,close: function() {
								window.location.href ="/admin/users/all_admin"; 
								}});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
					});
					return false;
				},
				delete_admin_user: function(urls,token){
					jQuery(document).on("click",".del_admin",function(e){
						e.preventDefault();
						var el = jQuery(this);
						var ids = el.attr("set_id");
						jQuery(".option_alert").html("Are you sure you want to delete this user?");
						jQuery(".option_alert").dialog({
							resizable: false,
							height: 150,
							modal: true,
							buttons: {
							"Yes": function () {
								jQuery.post(urls,{
								'delete':true,
								'admin_id':ids,
								'ZGlldmlyZ2luamM':jQuery.cookie(token),
								},function(d){
									alert("User has been deleted");
									jQuery(".option_alert").dialog("close");
									jQuery(".admin_list_id"+ids).hide('slow',function(){
										window.location.href ="/admin/users/all_admin/";
									});
								});
							},
							No: function () {
								jQuery(".option_alert").dialog("close");
							}
							}
						});						
					});
				},
				delete_user: function(urls,token){				
					jQuery(document).on("click",".juser_del",function(e){
						e.preventDefault();
						var el = jQuery(this);
						var ids = el.attr("set_id");
						jQuery(".option_alert").html("Are you sure you want to delete this user?");
						jQuery(".option_alert").dialog({
							resizable: false,
							height: 150,
							modal: true,
							buttons: {
							"Yes": function () {
								jQuery("#jcomp_"+ids).remove();
								jQuery(".option_alert").dialog("close");
								jQuery.post(urls,{
								'delete':true,
								'user_id':ids,
								'ZGlldmlyZ2luamM':jQuery.cookie(token),
								},function(d){
									alert("User has been deleted");
									jQuery(".option_alert").dialog("close");
									jQuery(".admin_list_id"+ids).hide('slow',function(){
										window.location.href ="/admin/users/all_admin/";
									});
								});
							},
							No: function () {
								jQuery(".option_alert").dialog("close");
							}
							}
						});						
					});
				},
				show_add_form: function(){
					jQuery(document).on('click',"#jlight_adduser",function(e){
						e.preventDefault();
						jQuery("form.jaddusers")[0].reset();
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
		   jQuery('.source_error').dialog("option", "title" ,"Warning");
	   },
	   overlay: {
   		   opacity: 0
   	   }
   });
}

jQuery(function() {
	kpay.hr.company_sidebar();
});
