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
				},
				delete_company: function(urls,token){ 
					jQuery(document).on("click", ".jcomp_delete", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var fid = el.attr("set_id");
						jQuery(".option_alert").empty().html("Are you sure you want to delete this company?");
						jQuery(".option_alert").dialog({
							resizable: false,
							height: 150,
							width:"320",
							modal: true,
							dialogClass: 'transparent',
							buttons: {
								"Yes": function () {
									jQuery.post(urls,{"delete":'true',"id":fid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(re){
										jQuery(".option_alert").dialog('close');
										alert("You have successfully updated");
										window.location.href = "/admin/company_setup/add";
										
									});
								},
								"No": function () {
									 jQuery(".option_alert").dialog('close');
								}
							}
						});
					});
				},
				show_view: function(urls,token){
					jQuery(document).on("click", ".jcomp_view", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var fid = el.attr("set_id"); 
						jQuery.post(urls,
							{
								"type": "company_view",
								"update": "true",
								"id": fid,
								"ZGlldmlyZ2luamM": jQuery.cookie(token)
							},
							function (json) {
								var res = jQuery.parseJSON(json);  
								jQuery("#jregname").empty().text(res.registered_business_name);
								jQuery("#jowner").empty().text(res.owner_name);
								jQuery("#jtradename").empty().text(res.trade_name);
								jQuery("#jbus_add").empty().text(res.business_address);
								jQuery("#jcity").empty().text(res.city);
								jQuery("#jzip").empty().text(res.zipcode);
								jQuery("#jorg").empty().text(res.organization_type);
								jQuery("#jind").empty().text(res.industry);
								jQuery("#jbpno").empty().text(res.business_phone);
								jQuery("#jext").empty().text(res.extension);
								jQuery("#jmob").empty().text(res.mobile_number);
								jQuery("#jfax").empty().text(res.fax);
								jQuery(".view_company").dialog(
									{	
										draggable:false,
										resizable: false,
										height: 'auto',
										width:"320",
										modal: true,
										dialogClass: 'transparent',
										buttons:{
											"Close": function(){
												jQuery(".view_company").dialog('close');
											}
										}
									
									});
							});
					});
				},
				update_company: function(urls,token) {
					jQuery(document).on("click", ".jcomp_edit", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var sid = el.attr("set_id");
						jQuery.post(urls,
							{
								"type": "company_view",
								"update": "true",
								"id": sid,
								"ZGlldmlyZ2luamM": jQuery.cookie(token)
							},
							function (json) {
								var res = jQuery.parseJSON(json);  
								jQuery("#ureg_business_name").empty().val(res.registered_business_name);
								jQuery("#ucomp_id").empty().val(res.company_id);
								jQuery("#jowner").empty().val(res.owner_name);
								jQuery("#utrade_name").empty().val(res.trade_name);
								jQuery("#ubusiness_address").empty().val(res.business_address);
								jQuery("#ucity").empty().val(res.city);
								jQuery("#uzip_code").empty().val(res.zipcode);
								jQuery("#uorg_type").empty().val(res.organization_type);
								jQuery("#uindustry").empty().val(res.industry);
								jQuery("#ubusiness_phone").empty().val(res.business_phone);
								jQuery("#uextension").empty().val(res.extension);
								jQuery("#umobile_no").empty().val(res.mobile_number);
								jQuery("#fax").empty().val(res.fax);
								jQuery(".jedit_compform").dialog(
									{	
										draggable:false,
										resizable: false,
										height: 'auto',
										width:"320",
										modal: true,
										dialogClass: 'transparent',
										buttons:{
											"Close": function(){
												jQuery(".jedit_compform").dialog('close');
											}
										}
									
									});
							});
						
						jQuery(".jedit_compform").dialog({
							draggable: false,
							resizable: false,
							height: 'auto',
							width: "320",
							modal: true,
							dialogClass: 'transparent'
						});
					});
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
	   width:'320',
	   dialogClass:'transparent',
		buttons: {
			'Close': function() {
				$( this ).dialog( "close" );
			}
		},
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
