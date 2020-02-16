require('./bootstrap');

/////////////////////////////////////////////////////////////////////////////
// 3RD PARTY LIBRARY IMPORTS
/////////////////////////////////////////////////////////////////////////////

/* disable submit button after clicked once to avoid duplication */
import Buttondisabler from "buttondisabler";

new Buttondisabler({
    timeout: 5000,
    text: 'Wait...'
});

window.swal = require('sweetalert2');
window.Noty = require('noty');

require('mo-js');
require('select2');

require('datatables.net');
require('datatables.net-bs4');

