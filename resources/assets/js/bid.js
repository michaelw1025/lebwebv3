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

});

// Clickable bid card
$('.bid-card').on('click', function()
{
    window.location = $(this).data('href');
});

// Show start bidding modal
$('#start-bidding').on('shown.bs.modal', function () {
    $('#electronic-bidding-badge-number').trigger('focus');
  });

// Check if badge number input has 9 characters
// When 9 characters are present submit the form to begin electronic bidding
$('#electronic-bidding-badge-number').keyup(function() {
    var numbers = $(this).val().length;
    if(numbers >= 9){
        var bidder = $(this).val();
        var link = $('#index-with-bidder-link').attr('href');
        var newLink = link+'?bidder='+bidder;
        $('#index-with-bidder-link').attr('href', newLink);
        jQuery('#index-with-bidder-link')[0].click();
        // $('#electronic-bidding-badge-number-submit-form').submit();
    }
});

// Check if badge number input has 9 characters
// When 9 characters are present submit the reset electronic bidding timer form
$('#reset-electronic-bidding-timer-input').keyup(function() {
    var numbers = $(this).val().length;
    if(numbers >= 9){
        $('#reset-electronic-bidding-timer').submit();
    }
});

// Start electronic bidding timer on page load
var timer = 89;
var timeIntervalID = setInterval(function () {
    minutes = parseInt(timer / 60, 10)   
    seconds = parseInt(timer % 60, 10);   
    minutes = minutes < 10 ? "0" + minutes : minutes;   
    seconds = seconds < 10 ? "0" + seconds : seconds;  
    $('.electronic-bidding-minutes').text(minutes); 
    $('.electronic-bidding-seconds').text(seconds); 
    if (--timer < 0) {
        timer = 0; 
        if (timer == 0) {
            clearInterval(timeIntervalID);
            if($('#cancel-bidding-button').length){
                jQuery('#cancel-bidding-button')[0].click();
            }
        }
    }
}, 1000);


// Capture the reset electronic bidding timer form submit to reset the timer without reloading page
$('#reset-electronic-bidding-timer').submit(function(e) {
    e.preventDefault();
    clearInterval(timeIntervalID);
    timer = 90;
    timeIntervalID = setInterval(function () {
        minutes = parseInt(timer / 60, 10)   
        seconds = parseInt(timer % 60, 10);   
        minutes = minutes < 10 ? "0" + minutes : minutes;   
        seconds = seconds < 10 ? "0" + seconds : seconds;  
        $('.electronic-bidding-minutes').text(minutes); 
        $('.electronic-bidding-seconds').text(seconds); 
        if (--timer < 0) {
            timer = 0; 
            if (timer == 0) {
                clearInterval(timeIntervalID);
                jQuery('#cancel-bidding-button')[0].click();
            }
        }
    }, 1000);
});