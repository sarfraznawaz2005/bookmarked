// custom js

// disable submit button after clicked once to avoid duplicatation
import Buttondisabler from "buttondisabler";

new Buttondisabler({
    timeout: 5000,
    text: 'Wait...'
});

$('.select2, select').select2();
$('.tags').select2({"tags": true});