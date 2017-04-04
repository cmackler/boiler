//Responsive Menu Script        
jQuery(document).ready(function(){
	jQuery('.menu-button').click(function () {
		jQuery('.rd-menu').slideToggle('fast');
		jQuery('.rd-parent').removeClass('clicked');
		$(this).toggleClass('open');
	});	
	jQuery('#nav-rd li').has('ul').addClass('rd-parent');
	jQuery('.rd-parent').append('<span class="icon-plus"></span>');
	jQuery('.icon-plus').click(function() {
				jQuery(this).parent().toggleClass('clicked');
				jQuery(this).parent().siblings().removeClass('clicked');
	});
	jQuery('#nav ul li').hover(function() {
		jQuery(this).children('ul').slideToggle('fast');
	});
	jQuery('.nav-container li > a[href^="/' + window.location.pathname.split("")[1] + '"]').addClass('active');
});

