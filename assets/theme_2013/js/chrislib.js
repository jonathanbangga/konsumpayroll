var kpay = {
		overall:{
			show_pops: function(classhere){
				jQuery(classhere).dialog({
					draggable: false,
					resizable: false,
					height: 'auto',
					width: "auto",
					modal: true,
					dialogClass: 'transparent'
				});
			},
			show_success: function(classhere) {
				jQuery(classhere).dialog({
					draggable: false,
					resizable: false,
					height: 'auto',
					width: "auto",
					modal: true,
					dialogClass: 'transparent',
					buttons: {
						'Close': function() {
							jQuery(this).dialog("close");
							location.reload();
						}
					}
				});
			}
		},
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
		owner: {
			approvers: {
				popup_approver: function(){
				// for pop up
					jQuery(document).on("click", ".jpop_approver", function (e) {
						e.preventDefault();
						kpay.overall.show_pops(".jpop_approvers");	
					});
				// closing pop up approver
					jQuery(document).on("click", ".jcancel", function (e) {
						e.preventDefault();
						jQuery(".jpop_approvers").dialog("close");
					});
				},
				save_approver: function(urls,token){
					var fields = {
									"lname":jQuery("input[name='lname']:visible").val(),
									"fname":jQuery("input[name='fname']:visible").val(),
									"mname":jQuery("input[name='mname']:visible").val(),
									"fax":jQuery("input[name='fax']:visible").val(),
									"email":jQuery("input[name='email']:visible").val(),
									"contact_no":jQuery("input[name='contact_no']:visible").val(),
									"username":jQuery("input[name='username']:visible").val(),
									"ZGlldmlyZ2luamM": jQuery.cookie(token),
									"submit":"true"
								};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);	
						if(res.success == '0'){
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
							kpay.overall.show_success(".success_messages");
						}
					});	
					return false;
				},
				delete_approver: function(urls,token,message){
					jQuery(document).on("click", ".jdel_approvers", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var unique_id = el.attr("acid");
						var act_id = el.attr("account_id");
						jQuery(".opt_selection").empty().html(message);
						jQuery(".opt_selection").dialog({
							resizable: false,
							draggable: false,
							height: 150,
							modal: true,
							width: '320',
							maxWidth: '600',
							buttons: {
								"Yes": function () {
									jQuery("#jwrap_"+unique_id).remove();
									jQuery(".opt_selection").dialog("close");
									jQuery.post(urls,{"account_id":act_id,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(json){
										var result = jQuery.parseJSON(json);
										if(result.success == '0'){
											alert(result.error);
										}else{
										jQuery(".success_messages").empty().html("<p>You have Successfully deleted company approver</p>");
										kpay.overall.show_success(".success_messages");
										}
									});
								},
								No: function () {
									jQuery(".opt_selection").dialog("close");
								}
							}
						});
					});
				},
				get_approvers: function(urls,token,company_id,account_id){
					jQuery.post(urls,{
						"company_id":company_id,
						"account_id":account_id,
						"ZGlldmlyZ2luamM": jQuery.cookie(token)
					},function(res){
						var results = jQuery.parseJSON(res);
						if(results.success == "1"){
							jQuery("input[id^='edit_company_id']").empty().val(results.approvers.company_id);
							jQuery("input[id^='edit_account_id']").empty().val(results.approvers.account_id);
							jQuery("input[id^='edit_fname']").empty().val(results.approvers.first_name);
							jQuery("input[id^='edit_mname']").empty().val(results.approvers.middle_name);
							jQuery("input[id^='edit_lname']").empty().val(results.approvers.last_name);
							jQuery("input[id^='edit_email']").empty().val(results.approvers.email);
							jQuery("input[id^='old_edit_email']").empty().val(results.approvers.email);
							jQuery("input[id^='edit_mobile']").empty().val(results.approvers.mobile_no);
							jQuery("input[id^='edit_level']").empty().val(results.approvers.level);
							kpay.overall.show_pops(".jpop_edit_approvers");	
						}else{
							alert(results.error);
						}
					});
				},
				update_approverscompany: function(urls,token){
					var comp_id = jQuery("input[id^='edit_company_id']").val();
					var account_id = jQuery("input[id^='edit_account_id']").val();
					var fname	=jQuery("input[id^='edit_fname']").val();
					var mname	=jQuery("input[id^='edit_mname']").val();
					var lname	=jQuery("input[id^='edit_lname']").val();
					var email	=jQuery("input[id^='edit_email']").val();
					var mobile	=jQuery("input[id^='edit_mobile']").val();
					var old_email =jQuery("input[id^='old_edit_email']").val(); 
					var level	=jQuery("input[id^='edit_level']").val();
					jQuery.post(urls,{
						"edit_company_id":comp_id,
						"edit_account_id":account_id,
						"edit_fname":fname,
						"edit_mname":mname,
						"edit_lname":lname,
						"edit_email":email,
						"old_edit_email":old_email,
						"edit_mobile":mobile,
						"edit_level":level,
						"ZGlldmlyZ2luamM": jQuery.cookie(token)
					},function(res){
						var results = jQuery.parseJSON(res);
						console.log(results);
						if(results.success == "1"){
							jQuery(".success_messages").empty().html("<p>You have Successfully updated company approvers</p>");
							kpay.overall.show_success(".success_messages");
						}else{
							alert(results.error);
						}
					});
				},
				add_approvers: function(urls,token,emp_id,first_name,middle_name,last_name,level){
					jQuery.post(urls,{
						"emp_id[]":emp_id,
						"first_name[]":first_name,
						"middle_name[]":middle_name,
						"last_name[]":last_name,
						"level[]":level,
						"approver_save":'true',
						"ZGlldmlyZ2luamM": jQuery.cookie(token)
					},function(res){
						var results = jQuery.parseJSON(res);
						if(results.success == "1"){
							jQuery(".success_messages").empty().html("<p>You have Successfully updated company approvers</p>");
							kpay.overall.show_success(".success_messages");
						}else{
							alert(results.error);
						}
					});
					return false;
				}
			},
			principal:{
				show_pop: function() {
					jQuery(document).on("click","#add_more_principal",function(e){
						e.preventDefault();
						var el = jQuery(this);
						kpay.overall.show_pops(".add_principal");
					});
					jQuery(document).on("click",".add_principal_cancel",function(e){
						e.preventDefault();
						var el = jQuery(this);
						jQuery(".add_principal").dialog('close');
					});
				},
				add_principal: function(urls,token){
					var fields = {
						"lname": jQuery("input[name='lname']:visible").val(),
						"fname": jQuery("input[name='fname']:visible").val(),
						"mname": jQuery("input[name='mname']:visible").val(),
						"fax": jQuery("input[name='fax']:visible").val(),
						"email": jQuery("input[name='email']:visible").val(),
						"contact_no": jQuery("input[name='contact_no']:visible").val(),
						"payroll_cloud_id": jQuery("input[name='payroll_cloud_id']:visible").val(),
						"ZGlldmlyZ2luamM": jQuery.cookie(token),
						"submit": "true"
					};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);	
						if(res.success == '0'){
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
							kpay.overall.show_success(".success_messages");
						}
					});	
					return false;
				},
				updated_principal: function(urls,token){
					var fields = {
						"lname": jQuery("input[name='lname']:visible").val(),
						"fname": jQuery("input[name='fname']:visible").val(),
						"mname": jQuery("input[name='mname']:visible").val(),
						"fax": jQuery("input[name='fax']:visible").val(),
						"email": jQuery("input[name='email']:visible").val(),
						"old_email":jQuery("input[name='old_email']").val(),
						"contact_no": jQuery("input[name='contact_no']:visible").val(),
						"payroll_cloud_id": jQuery("input[name='payroll_cloud_id']:visible").val(),
						"old_payroll_cloud_id": jQuery("input[name='old_payroll_cloud_id']").val(),
						"company_id":jQuery("input[name='company_id']").val(),
						"principal_id":jQuery("input[name='cprincipal_id']").val(),
						"emp_id":jQuery("input[name='emp_id']").val(),
						"ZGlldmlyZ2luamM": jQuery.cookie(token),
						"update": "true"
					};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);	
						if(res.success == '0'){
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully Updated</p>");
							kpay.overall.show_success(".success_messages");
						}
					});	
					return false;
				}
			},
			cost_center:{
				add_costcenter: function(urls,token,center_code,description){
					var fields = {
							"cost_center_code[]":center_code,
							"cost_center_description[]":description,
							"ZGlldmlyZ2luamM":jQuery.cookie(token),
							"submit":"true"
							};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);
						if(res.success == 0)
						{
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully added cost center</p>");
							kpay.overall.show_success(".success_messages");
						}
					});
					return false;
				},
				delete_costcenter: function(urls,token,cost_center_id,company_id){
					var fields = {
							"cost_center_id":cost_center_id,
							"company_id":company_id,
							"ZGlldmlyZ2luamM":jQuery.cookie(token),
							"delete":'true'
							};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);
						if(res.success == 0)
						{
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully deleted cost center</p>");
							kpay.overall.show_success(".success_messages");
						}
						
					});
					return false;
				},
				get_cost_center: function(urls,token,comp_id,cost_id){
					jQuery.post(urls,{
						"company_id":comp_id,
						"cost_center_id":cost_id,
						"ZGlldmlyZ2luamM": jQuery.cookie(token)
					},function(res){
						var results = jQuery.parseJSON(res);
						if(results.success == "1"){
							jQuery("input[id^='edit_id_cost_center']").empty().val(results.cost_centers.cost_center_id);
							jQuery("input[id^='old_edit_cost_center_code']").empty().val(results.cost_centers.cost_center_code);
							jQuery("#edit_company_id").empty().val(results.cost_centers.company_id);
							jQuery("input[id^='edit_cost_center_code']").empty().val(results.cost_centers.cost_center_code);
							jQuery("#edit_desc").empty().val(results.cost_centers.description);
							kpay.overall.show_pops("#jeditparent_costcenter");
						}else{
							alert(results.error);
						}
					});
				},
				update_cost_center: function(urls,token,comp_id,cost_center_id,cost_center_code,desc,cost_center_id_old){
					jQuery.post(urls,{
						"company_id":comp_id,
						"cost_center_id":cost_center_id,
						"old_edit_cost_center_code":cost_center_id_old,
						"cost_center_code":cost_center_code,
						"description":desc,
						"ZGlldmlyZ2luamM": jQuery.cookie(token),
						"update":"true"
					},function(res){
						var results = jQuery.parseJSON(res);
						if(results.success == "1"){
							jQuery(".success_messages").empty().html("<p>You have Successfully updated cost center</p>");
							jQuery("#jeditparent_costcenter").dialog('close');
							kpay.overall.show_success(".success_messages");
						}else{
							alert(results.error);
						}
					});
				}
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
								jQuery("#jregname").empty().text(res.company_name);
								jQuery("#jowner").empty().text(res.owner_name);
								jQuery("#jsubscription_date").empty().text(res.subscription_date);
								jQuery("#jno_employee").empty().text(res.number_of_employees);
								jQuery("#jbus_add").empty().text(res.business_address);
								jQuery("#jemail").empty().text(res.email_address);
								jQuery("#jcity").empty().text(res.city);
								jQuery("#jzip").empty().text(res.zipcode);
								jQuery("#jorg").empty().text(res.organization_type);	
								jQuery("#jbpno").empty().text(res.business_phone);
								jQuery("#jext").empty().text(res.extension);
								jQuery("#jmob").empty().text(res.mobile_number);
								jQuery("#jfax").empty().text(res.fax);
								jQuery("#jprovince").empty().text(res.province);
								jQuery(".view_company").dialog(
									{	
										draggable:false,
										resizable: false,
										height: 'auto',
										width:"auto",
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
				update_company_form: function(urls,token){
					jQuery.post(urls,
						{
							"type": "company_view",
							"update": "true",
							"id": sid,
							"ureg_business_name":jQuery("#ureg_business_name").val(),
							"jowner":jQuery("select[name='jowner']").val(),
							"ucomp_id":jQuery("#ucomp_id").val(),
							"utrade_name":jQuery("#utrade_name").val(),
							"ubusiness_address":jQuery("#ubusiness_address").val(),
							"ucity":jQuery("#ucity").val(),
							"uzip_code":jQuery("#uzip_code").val(),
							"uorg_type":jQuery("#uorg_type").val(),
							"uindustry":jQuery("#uindustry").val(),
							"ubusiness_phone":jQuery("#ubusiness_phone").val(),
							"uextension":jQuery("#uextension").val(),
							"umobile_no":jQuery("#umobile_no").val(),
							"ufax":jQuery("#ufax").val(),
							"ZGlldmlyZ2luamM": jQuery.cookie(token)
						},
						function (json) {
							console.log(json);
							return false;
						});
						return false;
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
								jQuery("#ureg_business_name").empty().val(res.company_name);
								jQuery("select[name='jowner']").val(res.company_owner_id);
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
								jQuery("#ufax").empty().val(res.fax);
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
				},
				popup_add_company: function(){
					jQuery(document).on("click","#jlight_addcompany",function(e){
						e.preventDefault();
						var el = jQuery(this);
						jQuery(".jpop_container").dialog({
							draggable: false,
							resizable: false,
							height: 'auto',
							width: "320",
							modal: true,
							dialogClass: 'transparent'
						});
					});
				},
				form_add_company: function(urls,token){
					var fields = {
							"reg_business_name":jQuery("input[name='reg_business_name']").val(),
							"owner":			jQuery("select[name='owner']").val(),
							"subscription_date":jQuery("input[name='subscription_date']").val(),
							"no_employees":		jQuery("input[name='no_employees']").val(),
							"email_add":		jQuery("input[name='email_add']").val(),
							"business_phone":	jQuery("input[name='business_phone']").val(),
							"mobile_no":	jQuery("input[name='mobile_no']").val(),
							"fax":			jQuery("input[name='fax']").val(),
							"business_address":jQuery("input[name='business_address']").val(),
							"city":			jQuery("input[name='city']").val(),
							"province":		jQuery("input[name='province']").val(),
							"zip_code":		jQuery("input[name='zip_code']").val(),
							"ZGlldmlyZ2luamM":jQuery.cookie(token),
							"submit":"true"
							};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);
						if(res.success == 'false')
						{
							alert(res.error);
						}else{
							
						}
					});

					return false;
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
						kpay.overall.show_pops(".jshowupdate");
						jQuery("form.jaddusers_update")[0].reset();
						jQuery.post(urls,{"update_edit":'1',"admin_id":getid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(ret){
							var jres = jQuery.parseJSON(ret);
							jQuery("input[name='edit_owner']").val(jres.owner_name);
							jQuery("input[id^='edit_owner_id']").val(jres.company_owner_id);
							jQuery("input[id^='edit_email']").val(jres.email);
							jQuery("input[id^='edit_old_email']").val(jres.email);
							jQuery("input[id^='edit_account_id']").val(jres.account_id);
							jQuery("input[id^='edit_payroll_system_account_id']").val(jres.payroll_system_account_id);
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
						"edit_account_id":jQuery("input[id^='edit_owner']").val(),
						'edit_payroll_system_account_id':jQuery("input[id^='edit_payroll_system_account_id']").val(),
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
								jQuery.post(urls,{"company_owner_id":ids,"ZGlldmlyZ2luamM":jQuery.cookie(token),"delete":"true"});
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
							jQuery("input[id^='accounts_id']").val(jres.account_id);
							jQuery("input[id^='edit_email']").val(jres.email);
							jQuery("input[id^='edit_old_email']").val(jres.email);
							jQuery("input[id^='edit_username']").val(jres.payroll_cloud_id);
							jQuery("input[id^='edit_username_old']").val(jres.payroll_cloud_id);
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
						'accounts_id':jQuery("input[name='accounts_id']").val(),
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
			},
			subdomain: {
				select_company: function(urls,token){
					jQuery(document).on('change','#company',function(e){
						e.preventDefault();
						var el = jQuery(this);
						var vl = el.val();
						jQuery("input[name='subdomain']").empty();
						if(vl !=""){
							jQuery.post(urls,
							{
							"company":vl,
							"ZGlldmlyZ2luamM": jQuery.cookie(token)
							},function(json){
								var res = jQuery.parseJSON(json);
								jQuery("input[name='subdomain']").val(res.sub_domain);
							});
						}
					});
				}
			}
		}
};

// global functions 
// returns array fields like input[name='empid[]'] 
function array_fields(field){
	var object_data = [];
		jQuery(field).each(function(a,b){
			object_data.push(jQuery(this).val());  
		});
	return object_data;	
}
// ADD ERROR TO YOUR FIELDS
function ierror_field(fields){
	jQuery(fields).each(function(e){
		var el = jQuery(this);
		if(el.val() == ""){
			jQuery(this).addClass('emp_str');
		}else{
			jQuery(this).removeClass('emp_str');
		}
	});
}
// MARK ERROR
function ierror_mark(fields){
	var codered = 0;
	jQuery(fields).each(function(){
		if(jQuery(this).hasClass("emp_str")){
			codered++;
		}
	});
	return codered;
}

// overwrite comments
window.alert = function(msg){
   jQuery(".source_error").html(msg);
   jQuery(".source_error").dialog({
	   width: 'inherit',
	   draggable: false,
	   modal: true,
	   width:'auto',
	   minWidth:'400',
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
   	   },
	   show: {
			effect: "bounce",
			duration:'slow'
		}
   });
}

jQuery(function() {
	kpay.hr.company_sidebar();
});
