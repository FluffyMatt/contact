$(document).ready(function() {

	// Search submit
	$('.search.icon.link').click(function() {
		$('#search').submit();
	})

	$('.star.icon:not(.active)').click(function() {
		$(this).next('.contact-fav').submit();
	})

	$('.close.icon').click(function() {
		$(this).parent().fadeOut('fast');
		$(this).parent().remove;
	})

});
