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

		var form = $($('#bc-form').find('.form-table').get(0));
		var position = '';
		var shortcode = '[breadcrumbs show_home_link=1 show_on_home=0 show_current=1]';
		var show_home_link = '';
		var show_on_home = '';
		var show_current = '';

		(function () {
			var arrForm = form.find('input:not(input[type="submit"], input[type="hidden"], input[readonly])');
			$.each(arrForm, function (i,el) {
				var value = $(el).val();
				var self = $(el);

				position = 'position=' + value;
				self.data('value', position);
				var inputId = self.attr('id');
				var isChecked = self.prop('checked');

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

			});
		})();

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

			var arrForm = form.find('input:not(input[type="submit"], input[type="hidden"], input[readonly])');
			var arrData = '';
			$.each(arrForm, function (i,el) {
				var dataValue = $(el).data('value');
				var radio = $(el).prop('checked');
				console.log(el);
				var checkbox = $(el).attr('type') === 'checkbox';
				if (radio) arrData += dataValue?dataValue + ' ':'';
				else if (checkbox) arrData += dataValue?dataValue + ' ':'';

			});
			shortcode = '[breadcrumbs '+ arrData +']';
			$('#my_shortcode').val(shortcode);
		});

		//function copy text
		function copyText(selector) {
			selector.select();
			selector.setSelectionRange(0, 99999); /*For mobile devices*/
			document.execCommand("copy");
		}

		$('#my_shortcode').focus(function () {
			var self = $(this);
			var parent = self.parent();
			copyText(this);

			parent.css('position', 'relative');
			parent.prepend('<div id="bc-message">Text copied!</div>');
		});

		//check separator default
		var $bc_check_sep = $('#bc_check_sep');
		var $bc_color_bg = $('#bc_color_bg');
		var $bc_sep = $('#bc_sep');
		if (!$bc_check_sep.prop('checked')) $bc_color_bg.attr('disabled', true).siblings('.description').css('text-decoration','line-through');

		$bc_check_sep.change(function () {
			if ($bc_check_sep.prop('checked')){
				$bc_color_bg.attr('disabled', false).siblings('.description').css('text-decoration','none');
				$bc_sep.attr('disabled', true);
			}else{
				$bc_color_bg.attr('disabled', true).siblings('.description').css('text-decoration','line-through');
				$bc_sep.attr('disabled', false);
			}

		});

		$bc_sep.change(function () {
			checkValSep();
		});

		checkValSep();
		function checkValSep() {
			if ($bc_sep.val() !== ''){
				$bc_check_sep.attr('checked', false);
				$bc_color_bg.siblings('.description').css('text-decoration','line-through');
			}else{
				$bc_check_sep.attr('checked', true);
				$bc_color_bg.siblings('.description').css('text-decoration','none');
			}
		}

	});

})( jQuery );
