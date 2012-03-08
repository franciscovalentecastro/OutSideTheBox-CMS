$(document).ready(initialize);

function initialize(){
	//Hide Text	
	hideText();
	
	//Bind Buttons
	$(".nav-bar a").hover(function( ){ $(this).find("p").toggle("slide"); }, function(){ $(this).find("p").hide(); });
}

function hideText(){	
	var textArray=$(".nav-bar p");	
	textArray.each(	function(){ $(this).hide();}	);	
}

