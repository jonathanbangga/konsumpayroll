// highlight messages script
// data
var speed = 5000;
// client side
function highlight_message(msg){
		jQuery(".highlight_message").html(msg);
		jQuery(".highlight_message").fadeIn();
		setTimeout(function(){
			jQuery(".highlight_message").fadeOut();
		},speed);
}
// redirect
function redirect_highlight_message(){
	if(jQuery.cookie("msg")!=null){
		jQuery(".highlight_message").html(jQuery.cookie("msg"));
		jQuery(".highlight_message").fadeIn();
		setTimeout(function(){
			jQuery.removeCookie("msg");
			jQuery(".highlight_message").fadeOut();	
		},speed);
	}
}


