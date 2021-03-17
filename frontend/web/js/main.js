$( document ).ready(function() {
    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {

        jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

            jQuery(this).html("Address: " + (index + 1))

        });

    });

    $(".dynamicform_wrapper").on("afterDelete", function(e) {

        jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

            jQuery(this).html("Address: " + (index + 1))

        });

    });
});