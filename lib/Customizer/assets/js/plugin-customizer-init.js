(function($) {
    wp.customize('cloud2png[width]', function(value) {
        value.bind(function(to) {
            $('#cloud2png').css('width', to + 'px');
        });
    });
    wp.customize('cloud2png[height]', function(value) {
        value.bind(function(to) {
            $('#cloud2png').css('height', to + 'px');
        });
    });
	wp.customize('cloud2png[border_radius]', function(value) {
        value.bind(function(to) {
            $('#cloud2png').css('border-radius', to + 'px');
        });
    });
	wp.customize('cloud2png[border_color]', function(value) {
        value.bind(function(to) {
			console.log( to );
            $('#cloud2png').css('boxShadowColor', to ); // using css hook, see boxshadow.js
        });
    });
	wp.customize('cloud2png[border_width]', function(value) {
        value.bind(function(to) {
			$('#cloud2png').css('boxShadowSpread', to + 'px'); // using css hook, see boxshadow.js
        });
    });
}(jQuery));
