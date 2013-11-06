jQuery(function(){
jQuery('select.txtcustomeselect').customSelect();
});

//make height start
function gethHeight(){
var h = 0
jQuery(".dept-box").css({"height":"auto"});
$(".dept-box").each(function(){
    if(jQuery(this).height() > h){
        h = jQuery(this).height();
    }
});
jQuery(".dept-box").css({"height":h+"px"});
}
//make height end


/* all functions after window load */
jQuery(window).load(function () {
	gethHeight()
		
});