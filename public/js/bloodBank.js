$(function() {

    $('.alert-success').not('.alert-important').delay(3000).fadeOut(350);

    // Custom Message for the select box
    $('.listRoles').select2({
        "language": {

            "noResults": function() { return "لا توجد نتائج مماثله"; }

        },

    });

});