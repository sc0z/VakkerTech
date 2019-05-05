// VakkerTech Frontend WebPack4 Bundle
// todo: reduce bundle size by only picking used components
// note: jQuery is already imported by WordPress. Don't include to reduce bundle size.
// **in wp_enqueue_script -> make sure to add jquery as a dependency for our bundle.js

import "popper.js"; // include popper.js for bootstrap4 (do we need this?)
import "bootstrap"; // include ALL of bootstrap4's js (do we need all of it?)
// import '@fortawesome/fontawesome-svg-core';
// import '@fortawesome/free-brands-svg-icons';
// import '@fortawesome/free-regular-svg-icons';
// import '@fortawesome/free-solid-svg-icons';
import "../sass/style.scss";

import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'


"use strict";

(function($) {
	$(function() {
		console.log("Document Ready");
		library.add(fas, far, fab) 
		dom.i2svg() 
	});
})(jQuery);

