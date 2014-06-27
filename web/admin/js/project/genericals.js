jQuery('#login-users').click(function() {  

	jQuery('.main-container').first().css('display','none');
	jQuery('.main-container').last().css('display','block');
	jQuery('body').addClass("login-layout");

    return false;
  });

jQuery('#elementos-usuarios').on('click', function(e) {
    e.stopPropagation();
});

jQuery(document).on('click', function (e) {
	jQuery('.main-container').first().css('display','block');
	jQuery('.main-container').last().css('display','none');
	jQuery('body').removeClass("login-layout");
	return false;
 // Do whatever you want; the event that'd fire if the "special" element has been clicked on has been cancelled.
});