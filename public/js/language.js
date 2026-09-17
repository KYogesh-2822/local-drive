   // jQuery code to execute when the select option changes
//    $('#lang-switch').on('change', function () {
        
//     var selectedValue = $(this).find(':selected').data('val');

//     translate(selectedValue);
// });
$(".lang-switch").on('click', function(){
     
    var selectedValue = $(this).data('val');
    $('#lang-switch-ls').html('');
    if(selectedValue == 'en'){
        $('#lang-switch-ls').append('USA (English)');
    }else{
        $('#lang-switch-ls').append('USA (Arabic)');
    }
    translate(selectedValue);

});

function googleTranslateElementInit() {
// Set default language to German
new google.translate.TranslateElement({
    layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
}, 'translate__el');

// Wait for elements to be fully loaded before setting up the dropdown
setTimeout(function () {
    setupTranslationHandlers();
}, 1000);
}

function setupTranslationHandlers() {
$(document).on('click', '.translate__item', function () {
    var $translateSelect = $('.goog-te-combo'),
        db = $translateSelect.get(0),
        thisDataVal = $(this).data("value");

    translate(thisDataVal);
});
}

function translate(selectedValue) {
var $translateSelect = $('.goog-te-combo'),
    db = $translateSelect.get(0);

// Check if the Google Translate dropdown is found
if ($translateSelect.length > 0 && db) {
    $translateSelect.val(selectedValue);

    // Check if 'dispatchEvent' is available before using it
    if (db && db.dispatchEvent) {
        fireEvent(db, 'change');
    }

    $('.translate__list').toggle();
} else {
    console.error("Error: Could not find the Google translate dropdown.");
}
}

function fireEvent(element, event) {
if (document.createEventObject) {
    // dispatch for IE
    var evt = document.createEventObject();
    element.fireEvent('on' + event, evt);
} else {
    // dispatch for firefox + others
    var evt = document.createEvent("HTMLEvents");
    evt.initEvent(event, true, true);
    element.dispatchEvent(evt);
}
}
