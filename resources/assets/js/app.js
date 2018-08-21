
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });


$(document).ready(function()
{
    // Attach datepicker
    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+10",
        showAnim: "slideDown"
    });

    // Check if review item is checked at load needed to load old data
    checkReviewOnLoad();
    // Check if reduction displacement is set to bump and require appropriate fields
    checkDisplacementRadioOnLoad();
    // Check for correct wage progression table on load
    checkWageProgressionTable() ;

});


// Check if review item is checked at load needed to load old data
function checkReviewOnLoad()
{
    $('.employee-review-checkbox-div').each(function() {
        var value = $(this).find('input[type=hidden]').val();
        if(value == 'checked') {
            $(this).find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).find('input[type=checkbox]').prop('checked', false);
        }
        
    });
}
// Check if review checkbox has changed and change the corresponding hidden input needed to load old data
$('.employee-review-checkbox').change(function() 
{
    var state = $(this).prop('checked');
    if(state == true) {
        $(this).next('.employee-review-checkbox-hidden').val('checked');
    } else {
        $(this).next('.employee-review-checkbox-hidden').val('unchecked');
    }
});

// Change color of card border when status or rehire is changed
$('.boolean-radio-button').change(function() 
{
    var name = $(this).attr('name');
    var radios = $('input[name="'+name+'"]');
    var checked = radios.filter(function(){
        return $(this).prop('checked');
    });
    if(checked.val() == '1') {
        $('.card-'+name).removeClass('border-danger').addClass('border-success');
    } else {
        $('.card-'+name).removeClass('border-success').addClass('border-danger');
    }
})






// Check if reduction displacement is set to bump and require appropriate fields
function checkDisplacementRadioOnLoad()
{
    var name = $('.displacement-radio-button').attr('name');
    var radios = $('input[name="'+name+'"]');
    var checked = radios.filter(function() {
        return $(this).prop('checked');
    });
    if(checked.val() == 'bump') {
        $('.required-with-bump-displacement').each(function() {
            $(this).children('i').removeClass('d-none');
        });
    } else {
        $('.required-with-bump-displacement').each(function() {
            $(this).children('i').addClass('d-none');
        });
    }
}
$('.displacement-radio-button').change(function() {
    checkDisplacementRadioOnLoad()
});









// Go to link when clickable row is clicked
$('.clickable-row').on('click', function()
{
    window.location = $(this).data('href');
});








// Confirm deleting item
$('.delete-item').on('click', function(e)
{
    var item = $(this).attr('name');
    if(!confirm(' Please confirm deleting this '+item+'.  This cannot be reversed.')){
        e.preventDefault();
    }else{

    }
});




// Check if typed character is a number
$('.is-number').on('keypress', function(event)
{
    var character = String.fromCharCode(event.which);
    if(!isInteger(character)){
        return false;
    }
});










// ----------------SSN validation----------------
// trap keypress - only allow numbers
$('.ssn-format').on('keypress', function(event)
{
    // trap keypress
    var character = String.fromCharCode(event.which);
    if(!isInteger(character)){
        return false;
    }
});

// checks that an input string is an integer, with an optional +/- sign character
function isInteger (s) 
{
    if(s === '-') return true;
   var isInteger_re     = /^\s*(\+|-)?\d+\s*$/;
   return String(s).search (isInteger_re) != -1
}

// format SSN
$('.ssn-format').on('keyup', function()
{
   var val = this.value.replace(/\D/g, '');
   var newVal = '';
    if(val.length > 4) {
        this.value = val;
    }
    if((val.length > 3) && (val.length < 6)) {
        newVal += val.substr(0, 3) + '-';
        val = val.substr(3);
    }
    if (val.length > 5) {
        newVal += val.substr(0, 3) + '-';
        newVal += val.substr(3, 2) + '-';
        val = val.substr(5);
    }
    newVal += val;
    this.value = newVal;
});









// --------------------Search employees-------------------
$('#submit-employee-search').on('click', function()
{
    var name = $('#employee-search-last-name').val().toLowerCase();
    var ssn = $('#employee-search-ssn').val();
    var birthDate = $('#employee-search-birth-date').val();
    var hireDate = $('#employee-search-hire-date').val();
    if(name != '') {
        $('.employee-row').each(function(){
            if(name == $(this).find('.employee-name').text().toLowerCase()) {

            } else {
                $(this).addClass('d-none');
            }
        });
    } else if (ssn != '') {
        $('.employee-row').each(function(){
            if(ssn == $(this).find('.employee-ssn').text()) {

            } else {
                $(this).addClass('d-none');
            }
        });
    } else if (birthDate != '') {
        $('.employee-row').each(function(){
            if(birthDate == $(this).find('.employee-birth-date').text()) {

            } else {
                $(this).addClass('d-none');
            }
        });
    } else if (hireDate != '') {
        $('.employee-row').each(function(){
            if(hireDate == $(this).find('.employee-hire-date').text()) {

            } else {
                $(this).addClass('d-none');
            }
        });
    } else {

    }
});

// Clear search employee form
$('#reset-employee-search').on('click', function()
{
    $('#search-employee-form').find(':input').each(function() {
        $(this).val('');
    });
    $('.employee-row').removeClass('d-none');
});


// Show file name when file selected for upload
$('.custom-file-input').on('change', function()
{
    let fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
});



// Format phone numbers
// trap keypress - only allow numbers
$('.phone-number-format').on('keypress', function(event)
{
    // trap keypress
    var character = String.fromCharCode(event.which);
    if(!isInteger(character)){
        return false;
    }
});

// format phone number
$('.phone-number-format').on('keyup', function()
{
   var val = this.value.replace(/\D/g, '');
   var newVal = '';
    if(val.length > 4) {
        this.value = val;
    }
    if((val.length > 3) && (val.length < 6)) {
        newVal += val.substr(0, 3) + '-';
        val = val.substr(3);
    }
    if (val.length > 6) {
        newVal += val.substr(0, 3) + '-';
        newVal += val.substr(3, 3) + '-';
        val = val.substr(6);
    }
    newVal += val;
    var iteration = $(this).attr('id')+'-primary';
    $('#'+iteration).val(newVal);
    this.value = newVal;
});




// Change wage progression table based on wage title chosen
$('.choose-wage-title').on('change', function() {
    var selected = $(this).find(':selected').text().toLowerCase();
    $('.wage-progression-row').addClass('d-none');
    $('.'+selected).removeClass('d-none');
});

// Check for correct wage progression table on load
function checkWageProgressionTable() 
{
    var selected = $('.choose-wage-title').find(':selected').text().toLowerCase();
    $('.wage-progression-row').addClass('d-none');
    $('.'+selected).removeClass('d-none');
}

// Clear all wage progression events
$('.clear-progression-events').on('click', function() {
    if(!confirm(' Please confirm clearing the wage progression event dates.')){
        
    }else{
        $('.progression-event').each(function() {
            $(this).val('');
        });
    }
});

// Toggle columns to view
$('.toggle-column').on('click', function() {
    var column = $(this).attr('id');
    $(this).toggleClass('btn-header');
    $('.'+column).toggleClass('d-none');
});