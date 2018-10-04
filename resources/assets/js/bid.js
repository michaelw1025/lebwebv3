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

var isAddBidOpen = false;

// Clickable bid card
$('.bid-card').on('click', function()
{
    window.location = $(this).data('href');
});




// Setup timer functions
function zeros(i){
    if(i < 10){
        i = "0" + i;
    }
    return i;
}
var minutes, seconds, timer, totalTime;
var count = 90;
// Start timer
var counter = setInterval(timer, 1000);
// Timer function
function timer() {
    count = count - 1;
    minutes = zeros(Math.floor(count / 60));
    seconds = zeros(count % 60);
    if(count < 31){
        $('#bidding-timer-badge').removeClass('badge-warning').addClass('badge-danger');
        $('#cancel-bidding-button').removeClass('btn-warning').addClass('btn-danger');
    }
    if(count == 0){
        clearInterval(counter);
        if($('#cancel-bidding-button').length){
            jQuery('#cancel-bidding-button')[0].click();
        }
    }
    totalTime = minutes + ':' + seconds;
    $('.bidding-timer-badge').text(totalTime);
}

// Reset timer
var bidderID = '';
$(document).keyup(function(e){
    bidderID = bidderID + e.key;
    if(bidderID.length >= 9){
        if($('#index-with-bidder-link').length){
            var link = $('#index-with-bidder-link').attr('href');
            var newLink = link + '?bidder=' + bidderID;
            $('#index-with-bidder-link').attr('href', newLink);
            bidderID = '';
            jQuery('#index-with-bidder-link')[0].click();
        }else{
            var bidderIDVerification = $('#employee-badge-verification').text();
            if(bidderID == bidderIDVerification) {
                clearInterval(counter);
                $('#bidding-timer-badge').removeClass('badge-danger').addClass('badge-warning');
                $('#cancel-bidding-button').removeClass('btn-danger').addClass('btn-warning');
                count = 90;
                counter = setInterval(timer, 1000);
                bidderID = '';
                if(isAddBidOpen) {
                    addBidToMyBids();
                }
            }else{
                jQuery('#cancel-bidding-button')[0].click();
            }
        }        
    }
});

// Add bid to my bids
$('#add-bid').click(function(){
    $('#exampleModal').modal('show');
    isAddBidOpen = true;

    // var newBid = '<div class="input-group my-bids">';
    // newBid = newBid + '<div class="input-group-prepend">';
    // newBid = newBid + '<span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>';
    // newBid = newBid + '<span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>';
    // newBid = newBid + '</div>';
    // newBid = newBid + '<input type="text" class="form-control" disabled value="18-100 Specialist Welding - Nights">';
    // newBid = newBid + '<div class="input-group-append">';
    // newBid = newBid + '<span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>';
    // newBid = newBid + '</div>';
    // newBid = newBid + '</div>';
    // console.log(newBid);
});

function addBidToMyBids() {
    var bidIDNumber = $('.bid-id-number').text();
    var myBidsCount = $('.my-bids').length;
    var currentLink = $('#view-open-bids-link').attr('href');
    var updatedLink = currentLink + '&bid=' + bidIDNumber;
    $('#view-open-bids-link').attr('href', updatedLink);
    console.log(myBidsCount);
}

$('#exampleModal').on('shown.bs.modal', function () {
    $('#add-bid-input').trigger('focus')
  })