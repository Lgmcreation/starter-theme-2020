import jquery from 'jquery';
window.jQuery = jquery;
window.$ = jquery;
/*POLYFILL*/
import './polyfill/forEach';
import './polyfill/focus-visible';
import './polyfill/requestAnimationFrame';

/*SRC*/
import './src/skip-link-focus-fix';
import './src/menu.js';
import './src/scrollTo.js';