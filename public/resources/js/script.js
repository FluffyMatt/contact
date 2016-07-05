$(document).ready(function() {

	// Search submit
	$('.search.icon.link').click(function() {
		$('#search').submit();
	})

	// Search json using semantic UI
	$('.ui.search').search({
		apiSettings: {
			method: 'POST',
	    	url: '/contacts/json',
			searchFields   : [
		    	'title'
		    ],
			beforeSend: function (settings) {
				settings.data.name = $('input[name="lookup"]').val();
		        return true;
		    },
	    }
	});

	// Add favourite
	$('.star.icon:not(.active)').click(function() {
		$(this).next('.contact-fav').submit();
	})

	// Close messages
	$('.close.icon').click(function() {
		$(this).parent().fadeOut('fast');
		$(this).parent().remove;
	})

});
