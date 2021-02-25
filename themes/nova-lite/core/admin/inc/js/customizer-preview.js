( function( $ ) {

	$('.preview-notice').append('<a class="getpremium" target="_blank" href="' + novalite_details.url + '">' + novalite_details.label + '</a>'); 
	$('.preview-notice').on("click",function(a){a.stopPropagation()});

} )( jQuery );   