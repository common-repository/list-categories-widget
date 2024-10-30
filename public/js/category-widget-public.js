(function(jQuery) {
	'use strict';
	var toggle_categories = function(e) {

		jQuery('.widget > ul').addClass('pfq-product-categories');

		jQuery('.widget > ul > li').children('a').removeAttr('href');
		jQuery('.widget > ul > li').find('ul').addClass('pfq-parent-list').hide();
		jQuery('.widget > ul > li > a').on('click', function(event) {
			event.preventDefault();
			jQuery(this).next().next('ul').slideToggle("slow").parent().toggleClass('pfq-active');
		});

	};

	/**
		* All of the code for your public-facing JavaScript source
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

	jQuery(document).ready(function() {});

	jQuery(window).on('load', function(e) {
		toggle_categories();
	});

})(jQuery);