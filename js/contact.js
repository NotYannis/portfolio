$(document).ready(function() {
	$("button.panel_button").click(function(){
		$("div#panel").animate({
			height: "350px"
		})
		.animate({
			height: "310px"
		}, "fast");
		$("button.panel_button").toggle();
	
	});	
	
   $("button#hide_button").click(function(){
		$("div#panel").animate({
			height: "0px"
		}, "fast");
		
	
   });	
	
});