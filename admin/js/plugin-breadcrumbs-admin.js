(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function () {

		var form = $('#bc-form');
		var position = '';
		var shortcode = '[breadcrumbs show_home_link=1 show_on_home=0 show_current=1]';
		var show_home_link = '';
		var show_on_home = '';
		var show_current = '';

		form.on('change', 'input:not(input[type="submit"])', function () {
			var self = $(this);
			var type = self.attr('type');
			var value = self.val();


			switch (type) {
				case 'radio':
					position = 'position=' + value;
					self.data('value', position);
					break;
				case 'checkbox':
					var inputId = self.attr('id');
					var isChecked = self.prop('checked');
					console.log(isChecked);
					if (inputId === 'show_home_link'){
						isChecked = isChecked? 1:0;
						show_home_link = 'show_home_link=' + isChecked;
						self.data('value', show_home_link);
					}
					if (inputId === 'show_on_home'){
						isChecked = isChecked? 1:0;
						show_on_home = 'show_on_home=' + isChecked;
						self.data('value', show_on_home);
					}
					if (inputId === 'show_current'){
						isChecked = isChecked? 1:0;
						show_current = 'show_current=' + isChecked;
						self.data('value', show_current);
					}
					break;
			}

			console.log(show_home_link);
			console.log(show_on_home);
			console.log(show_current);
			console.log(position);
			var arrForm = form.find('input:not(input[type="submit"], input[type="hidden"], input[readonly])');
			var arrData = '';
			$.each(arrForm, function (i,el) {
				var dataValue = $(el).data('value');
				arrData += dataValue?dataValue + ' ':'';

			});
			shortcode = '[breadcrumbs '+ arrData +']';

			console.log(arrData);
			console.log(shortcode);
		});
	});

})( jQuery );
