function ($) {

    "use strict";

}

$( function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker('setDate','today');
    $("#datepicker").datepicker('format', 'dd/mm/yyyy');
} )