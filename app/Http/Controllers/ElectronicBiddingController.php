<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Bid;
use App\Employee;

class ElectronicBiddingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        $bids = Bid::where('is_posted', 1)
        ->with([
            'shift',
            'team',
            'position'
        ])->get();
        return view('electronic-bidding.show-all-bids', [
            'bids' => $bids
        ]);
    }

    public function show($id)
    {
        $bidderID = $id;
        $bid = Bid::with([
            'shift',
            'team',
            'position',
            'bidTopWage',
            'bidEducationTopWage'
        ])->findOrFail($bidderID);
        return view('electronic-bidding.show-bid', [
            'bid' => $bid
        ]);
    }

    public function showWithBidder(Request $request)
    {
        $bidID = $request->id;
        $bidderID = $request->bidder;
        $bid = Bid::with([
            'shift',
            'team',
            'position',
            'bidTopWage',
            'bidEducationTopWage'
        ])->findOrFail($bidID);
        $employee = Employee::findOrFail($bidderID);
        if($request->has('bidCount')){
            $bidCount = $request->bidCount;
            $myBids = collect();
            for($i = 1; $i <= $bidCount; $i++){
                $bidNumber = 'bid'.$i;
                $bidID = $request->$bidNumber;
                $myBids->push(Bid::with([
                    'shift',
                    'team',
                    'position',
                    'bidTopWage',
                    'bidEducationTopWage'
                ])->findOrFail($bidID));
            }
            return view('electronic-bidding.show-bid', [
                'bid' => $bid,
                'employee' => $employee,
                'myBids' => $myBids,
                'bidCount' => $bidCount
            ]);
        }
        return view('electronic-bidding.show-bid', [
            'bid' => $bid,
            'employee' => $employee
        ]);
    }

    public function indexWithBidder(Request $request)
    {
        $bidder = $request->bidder;
        $employee = Employee::findOrFail($bidder);
        $bids = Bid::where('is_posted', 1)
        ->with([
            'shift',
            'team',
            'position'
        ])->get();
        if($request->has('bidCount')){
            $bidCount = $request->bidCount;
            $myBids = collect();
            for($i = 1; $i <= $bidCount; $i++){
                $bidNumber = 'bid'.$i;
                $bidID = $request->$bidNumber;
                $myBids->push(Bid::findOrFail($bidID));
            }
            return view('electronic-bidding.show-all-bids', [
                'bids' => $bids,
                'employee' => $employee,
                'myBids' => $myBids,
                'bidCount' => $bidCount
            ]);
        }
        return view('electronic-bidding.show-all-bids', [
            'bids' => $bids,
            'employee' => $employee
        ]);
    }

    public function checkBidderEligible(Request $request)
    {
        $bidderID = $request->bidder;
        $bidder = Employee::findOrFail($bidderID);
        if($bidder->bid_eligible == 1){
            return response()->json(['response' => true]);
        }else{
            return response()->json(['response' => false]);
        }
    }

    public function submitBids(Request $request)
    {
        // Get the employee for bidding
        $employee = Employee::findOrFail($request->bidder_id);
        // Cycle through each bid
        foreach($request->bid_choice as $bid){
            $bidNumber = $bid['bid_number'];
            $bidChoice = $bid['bid_choice'];
            $bidDate = Carbon::now();

            // Check if the bidder has already bid on this job
            $exists = $employee->bidChoice->contains($bidNumber);
            if($exists){
                
            }else{
                $employee->bidChoice()->attach($bidNumber, ['choice' => $bidChoice, 'date' => $bidDate]);
            }
        }
        return $request;
    }
}
