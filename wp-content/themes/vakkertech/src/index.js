// VakkerTech Frontend WebPack4 Bundle
// todo: reduce bundle size by only picking used components
// note: jQuery is already imported by WordPress. Don't include to reduce bundle size.
// **in wp_enqueue_script -> make sure to add jquery as a dependency for our bundle.js
//import "jquery"; // required to build Bootstrap 4
import "popper.js"; // include popper.js for bootstrap4 (do we need this?)
import "bootstrap"; // include ALL of bootstrap4's js (do we need all of it?)
import "./sass/style.scss"; // import Sass to be compiled/extracted/minified

// Import FontAwesome 5 Free SVG Icons
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';


"use strict";

const multiplyES6 = (x, y) => { return x * y };

(function($) {
	$(function() {
		console.log("Document Ready");
		console.log("ES6 + babel is working" + multiplyES6(3,7));
		
		// Setup all SVG fontawesome icons
		// todo: chunk/optimize this function
		library.add(fas, far, fab);
		dom.i2svg(); 
	});
})(jQuery);

