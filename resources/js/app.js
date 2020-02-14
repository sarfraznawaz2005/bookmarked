require('./bootstrap');

/////////////////////////////////////////////////////////////////////////////
// 3RD PARTY LIBRARY IMPORTS
/////////////////////////////////////////////////////////////////////////////
import Buttondisabler from 'buttondisabler';

// disable submit button after clicked once to avoid duplicatation
new Buttondisabler({
    timeout: 5000,
    text: 'Wait...'
});

window.Noty = require('noty');
window.mojs = require('mo-js');

require('summernote');

