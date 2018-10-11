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
// Prepare variable to tell when the remove bid modal is open, this lets the system know to remove the selected bid from My Bids
var isRemoveBidOpen = false;
// Prepare a variable to hold the bid that should be removed
var removeBidID = '';
// Prepare variable to let the system know when the submit bids modal is open
var submitBidsOpen = false;

/*------------------------------------------------------------------------------------------------------------------
Timer for electronic bidding page
------------------------------------------------------------------------------------------------------------------*/
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
    count = --count;
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

/*------------------------------------------------------------------------------------------------------------------
Timer for key up when inputing badge barcode number
------------------------------------------------------------------------------------------------------------------*/
// Set the initial value of the timer
var keyUpCount = 2;
// Initialize the timer variable
var keyUpCounter = '';
// Timer function
function keyUpTimer() {
    keyUpCount = --keyUpCount;
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

/*------------------------------------------------------------------------------------------------------------------
Timer for removing the bidder not eligible modal
------------------------------------------------------------------------------------------------------------------*/
// Set the initial value for the timer
var ineligibleCount = 15;
// Initialize the timer variable
var ineligibleCounter = '';
// Timer function
function ineligibleTimer() {
    console.log(ineligibleCount);
    ineligibleCount = --ineligibleCount;
    // When the timer reaches 0
    if(ineligibleCount == 0){
        // Clear the ineligibleCounter timer
        clearInterval(ineligibleCounter);
        // Reset the ineligibleCount variable
        ineligibleCount = 15;
        // Hide the bidder not eligible modal
        $('#bidder-not-eligible-modal').modal('hide');
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
            // Check to see if the user is eligible to bid
            // Get the check bidder link
            var link = $('.check-bidder-eligible-link').attr('href');
            // Send an ajax request to check if the users bid_eligible property is set to 1
            $.ajax({
                url: link,
                method: 'get',
                data: {
                    bidder: bidderID
                },
                // If the ajax request returns a response
                success: function(result) {
                    // If the user is eligible to bid
                    if(result.response == true){
                        // Get the bidding link and append the bidderID to it
                        var link = $('#index-with-bidder-link').attr('href');
                        var newLink = link + '?bidder=' + bidderID;
                        $('#index-with-bidder-link').attr('href', newLink);
                        bidderID = '';
                        // Clear the ineligibleCounter timer
                        clearInterval(ineligibleCounter);
                        // Reset the ineligibleCount variable
                        ineligibleCount = 15;
                        jQuery('#index-with-bidder-link')[0].click();
                    }else{
                        // If the user is not eligible to bid
                        bidderID = '';
                        $('#bidder-not-eligible-modal').modal('show');
                        ineligibleCounter = setInterval(ineligibleTimer, 1000);
                    }
                },
                // If the ajax request returns an error
                error: function() {
                    bidderID = '';
                    $('#bidder-not-eligible-modal').modal('show');
                    ineligibleCounter = setInterval(ineligibleTimer, 1000);
                },
            });
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
                if(isAddBidOpen && $('body').hasClass('modal-open')) {
                    checkIfBidIsInMyBids();
                }
                // If the remove bid modal is open remove the selected bid from My Bids
                if(isRemoveBidOpen && $('body').hasClass('modal-open')) {
                    removeBidFromMyBids();
                }
            }else{
                // If the numbers do not match reset the page
                $('#badge-numbers-do-not-match-modal').modal('show');
                setTimeout(function() {
                    jQuery('#cancel-bidding-button')[0].click();
                }, 8000);
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

$('#add-bid-modal').on('hidden.bs.modal', function () {
    isAddBidOpen = false;
});

// Check to see if the current bid can be added to My Bids
function checkIfBidIsInMyBids() {
    // Check if there are any bids in My Bids
    if($('.my-bids').length){
        // First check to see if the selected bid is already in My Bids
        // Set variable to check if bid is in My Bids
        var inMyBids = false;
        // Get the selected bid number
        var bidIDNumber = $('.bid-id-number').attr('id');
        // Check the selected bid against all bids in My Bids
        $('.my-bids').each(function() {
            if($(this).children(':input').attr('id') == bidIDNumber){
                // If the bid is in My Bids set the inMyBids variable to true
                inMyBids = true;
            }
        });
        if(inMyBids){
            // If the bid is in My Bids already
            // Close the add bid modal
            $('#add-bid-modal').modal('hide');
            // Open the add duplicate bid modal
            $('#add-duplicate-bid-modal').modal('show');
            // Reset the isAddBidOpen variable
            isAddBidOpen = false;
        }else{
            // Check to see if three bids are already in My Bids
            if($('.my-bids').length >= 3){
                // If three bids are already in My Bids
                // Close the add bid modal
                $('#add-bid-modal').modal('hide');
                // open the max number of bids modal
                $('#max-number-of-bids-modal').modal('show');
            }else{
                // If there are less than three bids in My Bids, add the current bid
                addBidToMyBids();
            }
        }
    }else{
        // If there are no bids in My Bids go ahead and add the selected bid
        addBidToMyBids();
    }
}


function addBidToMyBids() {
    var myBidsCount = $('.my-bids').length;
    // Get the bid number to add
    var bidIDNumber = $('.bid-id-number').attr('id');
    // Build the my bid div
    var newBid = buildMyBidDiv(bidIDNumber, myBidsCount);
    // Get the current view open bids link
    // var currentLink = $('#view-open-bids-link').attr('href');
    // Close the add bid modal
    $('#add-bid-modal').modal('hide');
    // Reset isAddBidOpen
    isAddBidOpen = false;
    // Remove the empty my bids label
    // if(myBidsCount == 0 || myBidsCount == null){
        $('.my-bids-empty').addClass('d-none');
        $('#submit-my-bids-div').removeClass('d-none');
    // }
    // Add the new bid to the end of my bids
    if(!$('.my-bids').length){
        $('#my-bids-container').html(newBid);
    }else{
        $('.my-bids').last().after(newBid);
    }
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

function buildMyBidDiv(bidIDNumber, myBidsCount) {
    // Get the name of the bid
    var bidName = $('.bid-name').text();
    // Get the shift of the bid
    var bidShift = $('.bid-shift').text();
    // Set this bids choice number
    var bidCoice = myBidsCount + 1;
    var newBid = '<div class="input-group my-bids" id="bid-choice-'+bidCoice+'">';
    newBid = newBid + '<div class="input-group-prepend">';
    newBid = newBid + '<span class="input-group-text move-bid-up"><i class="far fa-arrow-alt-circle-up fa-lg text-success"></i></span>';
    newBid = newBid + '<span class="input-group-text move-bid-down"><i class="far fa-arrow-alt-circle-down fa-lg text-edit"></i></span>';
    newBid = newBid + '</div>';
    newBid = newBid + '<input type="text" class="form-control" id="'+bidIDNumber+'" disabled value="'+bidName+' - '+bidShift+'">';
    newBid = newBid + '<div class="input-group-append remove-bid-button">';
    newBid = newBid + '<span class="input-group-text"><i class="fas fa-minus-circle fa-lg text-danger"></i></span>';
    newBid = newBid + '</div>';
    newBid = newBid + '</div>';
    return newBid;
}

// Remove a bid from My Bids
$(document).on('click', '.remove-bid-button', function() {
    if(submitBidsOpen){
        $('#submit-bids-modal').modal('hide');
    }
    // Get the bid name to remove
    var bidName = $(this).parent().children(':input').val();
    // Set the bid number variable to remove the bid
    removeBidID = $(this).parent().children(':input').attr('id');
    // Set the bid name in the remove bid modal
    $('#remove-bid-name').text(bidName);
    // Show the remove bid modal
    $('#remove-bid-modal').modal('show');
    // Set the isRemoveBidOpen variable to true
    isRemoveBidOpen = true;
});

function removeBidFromMyBids() {
    $('#'+removeBidID).parent().remove();
    removeBidID = '';
    $('#remove-bid-modal').modal('hide');
    isRemoveBidOpen = false;
    if(!$('.my-bids').length){
        $('.my-bids-empty').removeClass('d-none');
        $('#submit-my-bids-div').addClass('d-none');
    }else{
        // Reset the my bids div id numbers
        resetMyBidsDivID();
    }
}

$('#remove-bid-modal').on('hidden.bs.modal', function () {
    isRemoveBidOpen = false;
    removeBidID = '';
});

// Move bid up in my bids
$(document).on('click', '.move-bid-up', function() {
    // Get the selected bid's my bids id
    var selectedBidID = $(this).closest('.my-bids').attr('id');
    // Get the selected bid's choice number
    var selectedBidChoice = selectedBidID.substr(-1);
    // Check if the selected bid is already at number one
    if(selectedBidChoice != 1){
        // Get the selected my-bids div
        var myBidsDiv = $(this).closest('.my-bids');
        // Place the selected bid before the previous my bids div id
        $('#'+selectedBidID).prev('.my-bids').before(myBidsDiv);
        // Reset the my bids div id numbers
        resetMyBidsDivID();
    }
});

// Move bid down in my bids
$(document).on('click', '.move-bid-down', function() {
    // Get the selected bid's my bids id
    var selectedBidID = $(this).closest('.my-bids').attr('id');
    // Get the selected bid's choice number
    var selectedBidChoice = selectedBidID.substr(-1);
    // Get count of my bids
    var myBidsCount = $('.my-bids').length;
    // Check if the selected bid is already last
    if(selectedBidChoice != myBidsCount){
        // Get the selected my-bids div
        var myBidsDiv = $(this).closest('.my-bids');
        // Place the selected bid after the next my bids div id
        $('#'+selectedBidID).next('.my-bids').after(myBidsDiv);
        // Reset the my bids div id numbers
        resetMyBidsDivID();
    }
});

function resetMyBidsDivID() {
    // Reset the my bids div id numbers
    // Set a variable for the amount of bids in my bids
    var myBidsCount = 1;
    $('.my-bids').each(function() {
        // Set the new id to a variable
        var newMyBidsID = 'bid-choice-'+myBidsCount;
        // Set the new id
        $(this).attr('id', newMyBidsID);
        // Increment the myBidsCount variable
        myBidsCount = ++myBidsCount;
    });
}

// Submit my bids
$('#submit-my-bids-button').click(function() {
    submitBidsOpen = true;
    // Show the submit bids modal
    $('#submit-bids-modal').modal('show');
    // Replace the submit bids modal body
    // $('#submit-bids-modal-body').html($('#my-bids-container').html());
});
