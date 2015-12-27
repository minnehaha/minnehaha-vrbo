if (typeof jQuery !== 'undefined') {
    (function($) {
        $('#spinner').ajaxStart(function() {
            $(this).fadeIn();
        }).ajaxStop(function() {
                $(this).fadeOut();
            });
    })(jQuery);
}
$(document).ready(function(){
    var $dialog = $('<div></div>')
        .html('<div class="progress progress-striped active"><div class="bar" style="width: 40%;"></div></div>')
        .dialog({
            autoOpen: false,
            resizable: false,
            draggable: false,
            modal: true,
            minHeight: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar").hide();
            }
        });
    $("#submitInq").click(function(event){
        $dialog.dialog('open');
        $('#inquireForm').submit();
        return false;
    });
    $("#submitCentralInq").click(function(event){
        $dialog.dialog('open');
        $('#inquirerCentralForm').submit();
        return false;
    });
    $("#testimonialSubmitBt").click(function(event){
        $dialog.dialog('open');
        $('#testimonialForm').submit();
        return false;
    });
    $("#contactUsSubmitBt").click(function(event){
        $dialog.dialog('open');
        $('#contactUsForm').submit();
        return false;
    });
});
