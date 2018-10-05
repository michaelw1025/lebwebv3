<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $bids = Bid::where('is_active', 1)
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
                $myBids->push(Bid::findOrFail($bidID));
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

    public function getBidder(Request $request)
    {
        $bidder = $request->bidder;
        return redirect()->route('electronic-bidding.index-with-bidder', ['bidder' => $bidder]);
    }

    public function indexWithBidder(Request $request)
    {
        $bidder = $request->bidder;
        $employee = Employee::findOrFail($bidder);
        $bids = Bid::where('is_active', 1)
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
}
