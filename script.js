(function ( $ , window , document , undefined) {
	$(document).ready(function(){
    	$('.showhidden').on('click',function(){
    		$(this).toggleClass('open');
    		$(this).next().toggleClass('ahidden');
    	});
    });
} ( jQuery , window, document)); 
