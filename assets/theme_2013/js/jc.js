// highlight messages script
// client side
function highlight_message(msg,container,speed){
		var container = (container)?container:".highlight_message";
		var speed = (speed)?speed:5000;
		jQuery(container).html(msg);
		jQuery(container).fadeIn();
		setTimeout(function(){
			jQuery(container).fadeOut();
		},speed);
}
// redirect
function redirect_highlight_message(container,speed){
	var container = (container)?container:".highlight_message";
	var speed = (speed)?speed:5000;
	if(jQuery.cookie("msg")!=null){
		jQuery(container).html(jQuery.cookie("msg"));
		jQuery.removeCookie("msg");
		jQuery(container).fadeIn();
		setTimeout(function(){
			jQuery(container).fadeOut();	
		},speed);
	}
}

function is_numeric(str){
	var patt1 = /\D/; // search for non numeric
	var result = str.match(patt1);
	if(result==null){
		return true;
	}else{
		return false;
	}
}