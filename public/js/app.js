// Namespace global propre
var Web4All = (function($) {

    const init = function() {
        Menu.init();
        Modal.init();
        FormValidation.init();
        Stars.init();
    };

    return {
        init: init
    };

})(jQuery);


// Initialisation unique
$(document).ready(function() {
    Web4All.init();
});
