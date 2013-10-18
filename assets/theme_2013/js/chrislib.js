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
			
			}
		}
};

// overwrite comments
window.alert = function(msg){
   jQuery(".source_error").html(msg).dialog({
	   	draggable: false,
	   	resizable: false,
	   	modal: true,
	   	width: 'inherit',
	   	dialogClass:'transparent',
	   	overlay: {
   	    	opacity: 0
   	    },
	    open : function() {
           jQuery('.source_error').dialog("option", "title" ,"Error");
     	}
   });
}

jQuery(function(){
	kpay.hr.company_sidebar();
});
