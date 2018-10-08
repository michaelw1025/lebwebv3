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

// Prepare a variable to tell when the add bid modal is open, this lets the system know to add the selected bid to My Bids
var isAddBidOpen = false;

// Setup timer functions
// This adds a zero in front of any single digit time
function zeros(i){
    if(i < 10){
        i = "0" + i;
    }
    return i;
}
var minutes, seconds, timer, totalTime;
// Set the initial electronic bidding counter time
var count = 90;
// Start timer
var counter = setInterval(timer, 1000);
// Timer function
function timer() {
    count = count - 1;
    minutes = zeros(Math.floor(count / 60));
    seconds = zeros(count % 60);
    // When the timer reaches 30 seconds alert the user
    if(count < 31){
        $('#bidding-timer-badge').removeClass('badge-warning').addClass('badge-danger');
        $('#cancel-bidding-button').removeClass('btn-warning').addClass('btn-danger');
    } 
    // When the timer reaches 0
    if(count == 0){
        // Clear the timer
        clearInterval(counter);
        // If the user is bidding reset the page
        if($('#cancel-bidding-button').length){
            jQuery('#cancel-bidding-button')[0].click();
        }
    }
    // Shows the timer on the page
    totalTime = minutes + ':' + seconds;
    $('.bidding-timer-badge').text(totalTime);
}

// Key up timer
// Set the initial value of the timer
var keyUpCount = 2;
// initialize the timer variable
var keyUpCounter ='';
// Timer function
function keyUpTimer() {
    keyUpCount = keyUpCount - 1;
    // When the timer reaches 0
    if(keyUpCount == 0){
        // Clear the keyUpTimer timer
        clearInterval(keyUpCounter);
        // If the user is bidding reset the page
        if($('#cancel-bidding-button').length){
            jQuery('#cancel-bidding-button')[0].click();
        }
        // Clear the bidderID variable
        bidderID = '';
    }
}

// Reset timer
var bidderID = '';
$(document).keyup(function(e){
    // Get the key press and append it to the bidderID variable
    bidderID = bidderID + e.key;
    // Clear the key up timer to prepare it for the next interval
    clearInterval(keyUpCounter);
    // Reset the keyUpCount variable
    keyUpCount = 2;
    // Restart the key up timer
    keyUpCounter = setInterval(keyUpTimer, 75);
    // When the bidderID has reached 9 digits
    if(bidderID.length >= 9){
        // Clear the key up timer
        clearInterval(keyUpCounter);
        // Reset the keyUpCount variable
        keyUpCount = 2;
        // If the user is not bidding
        if($('#index-with-bidder-link').length){
            // Get the bidding link and append the bidderID to it
            var link = $('#index-with-bidder-link').attr('href');
            var newLink = link + '?bidder=' + bidderID;
            $('#index-with-bidder-link').attr('href', newLink);
            bidderID = '';
            jQuery('#index-with-bidder-link')[0].click();
        }else{
            // If the user is bidding
            // Get the current user's id
            var bidderIDVerification = $('#employee-badge-verification').text();
            // Check if the scan id matches the current user's id
            // If the numbers match
            if(bidderID == bidderIDVerification) {
                // Clear the page timer
                clearInterval(counter);
                // Reset any warnings
                $('#bidding-timer-badge').removeClass('badge-danger').addClass('badge-warning');
                $('#cancel-bidding-button').removeClass('btn-danger').addClass('btn-warning');
                // Reset the page timer count
                count = 90;
                // Start the page timer
                counter = setInterval(timer, 1000);
                // Clear the bidderID variable
                bidderID = '';
                // If the add bid modal is open check to add the current bid to My Bids
                if(isAddBidOpen) {
                    checkIfBidIsInMyBids();
                }
            }else{
                // If the numbers do not match reset the page
                jQuery('#cancel-bidding-button')[0].click();
            }
        }        
    }
});

// Add bid to my bids
// When the add bid button is clicked open the add bid modal and set the isAddBidOpen variable to true
$('#add-bid').click(function(){
    $('#add-bid-modal').modal('show');
    isAddBidOpen = true;
});

// Check to see if the current bid can be added to My Bids
function checkIfBidIsInMyBids() {
    if($('.my-bids').length){
        // Set false variable to set to true if bid is in my bids
        var inMyBids = false;
        // Get the bid number to add
        var bidIDNumber = $('.bid-id-number').attr('id');
        $('.my-bids').each(function() {
            // If the current bid is in My Bids set the inMyBids variable to true
            if($(this).children(':input').attr('id') == bidIDNumber){
                inMyBids = true;
            }
        });
        if(inMyBids) {
            // Close the add bid modal
            $('#add-bid-modal').modal('hide');
            // Open the add duplicate bid modal
            $('#add-duplicate-bid-modal').modal('show');
            isAddBidOpen = false;
        }else{
            addBidToMyBids();
        }
    }else{
        addBidToMyBids();
    }

}


function addBidToMyBids() {
    var myBidsCount = $('.my-bids').length;
    // Get the bid number to add
    var bidIDNumber = $('.bid-id-number').attr('id');
    // Build the my bid div
    var newBid = buildMyBidDiv(bidIDNumber);
    // Get the current view open bids link
    var currentLink = $('#view-open-bids-link').attr('href');
    // Close the add bid modal
    $('#add-bid-modal').modal('hide');
    // Reset isAddBidOpen
    isAddBidOpen = false;
    // Remove the empty my bids label
    if(myBidsCount == 0 || myBidsCount == null){
        $('.my-bids-empty').remove();
    }
    // Add the new bid to my bids
    $('#my-bids-header').last().after(newBid);
}

$('.bid-card').click(function() {
    // Get the current show bid link
    var currentLink = $(this).children('.show-bid-link').attr('href');
    // Set bidIDNumber to 0
    // var bidIDNumber = 0;
    // Create new link
    var updatedLink = createNewLink(currentLink);
    // Replace the show bid link
    $(this).children('.show-bid-link').attr('href', updatedLink);
    // Click the link
    jQuery(this).children('.show-bid-link')[0].click();
});

$('#view-open-bids-link').click(function() {
    // Get the current view open bids link
    var currentLink = $('#view-open-bids-link').attr('href');
    // Set bidIDNumber to 0
    // var bidIDNumber = 0;
    // Create new link
    var updatedLink = createNewLink(currentLink);
    // Replace the view open bids link
    $('#view-open-bids-link').attr('href', updatedLink);
    // Click the link
    jQuery(this)[0].click();
});

function createNewLink(currentLink) {
    var myBidsCount = $('.my-bids').length;
    if(myBidsCount > 0){
        // Set an array to hold the id's of the bids in my bids
        var myBidArray = [];
        // For each bid in my bids get the bid number
        $('.my-bids').each(function() {
            myBidArray.push($(this).children(':input').attr('id'));
        });
        // Add the myBidArray count to the link
        var updatedLink = currentLink + '&bidCount=' + myBidArray.length;
        // Add each item in the myBidArray to the link
        for(let i = 0; i < myBidArray.length; i++){
            updatedLink = updatedLink + '&bid' + (i+1) + '=' + myBidArray[i];
        }
        return updatedLink;
    }else{
        return currentLink;
    }
}

function buildMyBidDiv(bidIDNumber) {
    // Get the name of the bid
    var bidName = $('.bid-name').text();
    // Get the shift of the bid
    var bidShift = $('.bid-shift').text();
    var newBid = '<div class="input-group my-bids">';
    newBid = newBid + '<div class="input-group-prepend">';
    newBid = newBid + '<span class="input-group-text"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>';
    newBid = newBid + '<span class="input-group-text"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>';
    newBid = newBid + '</div>';
    newBid = newBid + '<input type="text" class="form-control" id="'+bidIDNumber+'" disabled value="'+bidName+' - '+bidShift+'">';
    newBid = newBid + '<div class="input-group-append">';
    newBid = newBid + '<span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>';
    newBid = newBid + '</div>';
    newBid = newBid + '</div>';
    return newBid;
}
