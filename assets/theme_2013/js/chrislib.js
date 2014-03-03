/*
*	@version : Azelot
*	@author: Christopher Cuizon
*	@plugin name : chrislib
*	@credits : github.com/bigfoot/konsumpayroll
*/
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
			},
			ajax_save: function(urls,fields){
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
						if(res.success == 0){
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
						if(res.success == 0){
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
						var psa_id = el.attr("psa_id"); 
						jQuery.post(urls,
							{
								"type": "view",
								"update": "true",
								"psa_id": psa_id,
								"ZGlldmlyZ2luamM": jQuery.cookie(token)
							},
							function (json) {
								var res = jQuery.parseJSON(json);  
								jQuery("#jregname").empty().text(res.name);
								jQuery("#jowner").empty().text(res.owner_name);
								jQuery("#jsubscription_date").empty().text(res.subscription_date);
								jQuery("#jemail").empty().text(res.email);
								jQuery("#jcity").empty().text(res.city ? res.city : "None");
								jQuery("#jaddress").empty().text(res.address ? res.address : "None");
								jQuery("#jstreet").empty().text(res.street ? res.street : "None");	
								jQuery("#jmobile").empty().text(res.mobile ? res.mobile : "None");
								jQuery(".view_company").dialog({	
										draggable:false,
										resizable: false,
										height: '320',
										width:"280",
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
				update_department: function(urls,token) {
					jQuery(document).on("click", ".jcomp_edit", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var psa_id = el.attr("psa_id");
						jQuery.post(urls,
							{
								"type": "company_view",
								"update": "true",
								"psa_id": psa_id,
								"ZGlldmlyZ2luamM": jQuery.cookie(token)
							},
							function (json) {
								var res = jQuery.parseJSON(json);  
								console.log(res);
								jQuery("#psa_name").empty().val(res.psa.name);
								jQuery("#old_psa_name").empty().val(res.psa.name);							
								jQuery("#psa_id").empty().val(res.psa.payroll_system_account_id);
								jQuery("#old_account_id").empty().val(res.psa.account_id);
								jQuery("select[name='jowner']").html(res.options);
								jQuery("select[name='jowner']").val(res.psa.account_id);
								jQuery(".jedit_compform").dialog({	
										draggable:false,
										resizable: false,
										height: 'auto',
										width:"320",
										modal: true,
										dialogClass: 'transparent'
								});
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
						kpay.overall.show_pops(".jshowupdate");
						jQuery("form.jaddusers_update")[0].reset();
						jQuery.post(urls,{"update_edit":'1',"admin_id":getid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(ret){
							var jres = jQuery.parseJSON(ret);
							jQuery("input[id^='edit_email']").val(jres.email);
							jQuery("input[id^='edit_owner']").val(jres.owner_name);
							jQuery("input[id^='edit_old_email']").val(jres.email);
							jQuery("input[id^='edit_account_id']").val(jres.account_id);		
						});
					});
				},
				update_user_form: function(urls,token) {
					$.ajax({
					url:urls,
					type: "POST",
					data:{
						'edit_account_id':jQuery("input[id^='edit_account_id']").val(),
						'edit_name':jQuery("input[name='edit_owner']").val(),
						'edit_email':jQuery("input[id^='edit_email']").val(),
						'edit_old_email':jQuery("input[id^='edit_old_email']").val(),
						'ZGlldmlyZ2luamM':jQuery.cookie(token),
						'update':'true'
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {						
								jQuery(".success_updated").dialog({width: 'auto',Maxwidth:750,close: function() {
								window.location.href ="/admin/users/all_users"; 
								},buttons: {
									'Close': function() {
										jQuery(this).dialog("close");
										location.reload();
									}
								}
								});
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
								'No': function () {
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
						kpay.overall.show_pops(".edit_users_reg");
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
						'edit_username':jQuery("input[name='username']").val(),
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
									jQuery.post(urls,
									{
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
								"No": function () {
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
				show_add_form: function(){ // NOT USED
					jQuery(document).on('click',"#jlight_adduser",function(e){
						e.preventDefault();
						jQuery("form.jaddusers")[0].reset();
						jQuery(".jreg").dialog();
					});
				},// update password only
				show_admin_details_pass: function(urls,token,getid){
					jQuery("form.ichange_pass")[0].reset();
					jQuery.post(urls,{"update_edit":'1',"admin_id":getid,"ZGlldmlyZ2luamM":jQuery.cookie(token)},function(ret){
						var jres = jQuery.parseJSON(ret);
						jQuery("input[id^='editpass_accountid']").empty().val(jres.account_id);
						jQuery("input[id^='editpass_username']").empty().val(jres.payroll_cloud_id);
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

// VALIDATES MULTIPLE EMAIL
function ierror_email(fields){
	jQuery(fields).each(function(e){
		var el = jQuery(this);
		if(check_emailski(el.val()) == false){
			jQuery(this).addClass('emp_str');
		}else{
			jQuery(this).removeClass('emp_str');
		}
	});
}

// VALIDATES PAYROLL CLOUD ID MUST BE 10 atleast
function ierror_emp_minlength(fields){
	jQuery(fields).each(function(e){
		var el = jQuery(this);
		if(el.val().length < 10){
			jQuery(this).addClass('emp_str');
		}else{
			jQuery(this).removeClass('emp_str');
		}
	});
}


// MARK DUPLICATE
function ierror_duplicate(fields){
	var dup = 0;
	jQuery(fields).each(function(){
		var first = jQuery(this).val();
		 jQuery(fields).not(this).each(function(){
			var el = jQuery(this);
			var second =el.val();
			 if(first !="" && second !=""){
				 if(first == second){
					 dup++;
					 el.addClass("emp_str");
				 }
			 }
		});
	});
	return dup;
}

// DATE RANGES FROM AND TO
function idate_ranges(){
	$( "#jdate_from, #jdate_to" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		dateFormat:'yy-mm-dd',
		onSelect: function( selectedDate ) {
			if(this.id == 'jdate_from'){
			  var dateMin = $('#jdate_from').datepicker("getDate");
			  var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
			  var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 31); 
			  $('#jdate_to').datepicker("option","minDate",rMin);
			 // $('#jdate_to').datepicker("option","maxDate",rMax);                    
			}	
		}
	});
}


// overwrite alert functionalities
window.alert = function(msg){
   jQuery(".source_error").html(msg);
   jQuery(".source_error").dialog({
		width: 'inherit',
		draggable: false,
		modal: true,
		minWidth:'400',
		maxWidth:'600',
		width:'300',
		dialogClass:'transparent',
		buttons: {
			'Close': function() {
				$( this ).dialog("close");
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

// HIGHTLIGHT SUCCESS 
function hightlight_success(){
	var icheck = jQuery.trim(jQuery(".highlight_message").text());
	if(icheck){
		jQuery(".successContBox").fadeIn("slow");
	}
}
		
// plugin style scripting

$.fn.enter = function(fn) {  
    return this.each(function() { 
		var el = jQuery(this);
        el.bind('enterPress',fn);
        el.keyup(function(e){
            if(e.keyCode == 13){ el.trigger("enterPress"); }
        });
    });  
}; 

// end plugin style

// SHOW STATUS
function ishow_status(){
	var check_text = jQuery.trim(jQuery("#jmessages").text());
	if(check_text !=""){
		jQuery("#show_success").fadeIn('slow',function(){
			jQuery(this).fadeOut(6000);
		});
	}
}

//CHECK IF EMAIL IS VALID IF RETURN TRUE THEN VALID
function check_emailski(email) {  
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

// NUMBERS ONLY
function inum(iprior){
	jQuery(iprior).keydown(function(event) {
        // Allow special chars + arrows 
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 13 
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                return;
        }else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });    
}

// SHOW FADERS
function god_signs(){
	var successContBox = jQuery.trim(jQuery(".successContBox").text());
	if(successContBox != ""){
		jQuery(".successContBox").fadeIn("slow");
		setTimeout(function(){
			jQuery(".successContBox").fadeOut('100');
		},3000);
	}
}

// select all checkbox
function icheck_box(inputcheck,inputallcheck){
	jQuery(document).on("change","input[name='"+inputcheck+"']",function(e){
		var el = jQuery(this);
		console.log(el.is(":checked"));
		if(el.is(":checked")){
			jQuery("input[name='"+inputallcheck+"']").prop("checked","checked");
		}else{
			 jQuery("input[name='"+inputallcheck+"']").removeAttr("checked");
		}
	});
}

// idisable u right click heheh 
function disable_properties(){
	jQuery(document).on('contextmenu', function() { return false; });
	jQuery(document).keypress("u",function(e) {  if(e.ctrlKey) return false; });
	jQuery(document).click(function(e) {  if (e.ctrlKey)  return false;});
}

jQuery(function() {
	kpay.hr.company_sidebar();
	//disable_properties();
});
