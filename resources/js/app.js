import './bootstrap';

import Alpine from 'alpinejs';

// Added: Actual Bootstrap JavaScript dependency
import 'bootstrap';

// Added: Popper.js dependency for popover support in Bootstrap
import '@popperjs/core';
//sweetalert2
import Swal from "sweetalert2"
import $ from 'jquery';

window.Alpine = Alpine;
Alpine.start();

window.$ = $;
window.Swal = Swal;
