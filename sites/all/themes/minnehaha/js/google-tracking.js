var google_conversion_id = 987152522;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "";
var google_conversion_value = 10;

var conversionLabels = {
    'inquiry': "I0GzCJb1hwYQioHb1gM"
};


function trackConversion(label) {
    google_conversion_label = conversionLabels[label];

    document.write = function(text) {
        jQuery('body').append(text);
    };

    jQuery.getScript('https://www.googleadservices.com/pagead/conversion.js');
}
