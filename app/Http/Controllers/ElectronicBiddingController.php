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
        $bidderID = decrypt($id);
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

    public function showWithBidder($id, $bidder)
    {
        $bid = Bid::with([
            'shift',
            'team',
            'position',
            'bidTopWage',
            'bidEducationTopWage'
        ])->findOrFail($id);
        $employee = Employee::findOrFail($bidder);
        return view('electronic-bidding.show-bid', [
            'bid' => $bid,
            'employee' => $employee
        ]);
    }

    public function getBidder(Request $request)
    {
        $bidder = encrypt($request->bidder);
        return redirect()->route('electronic-bidding.index-with-bidder', ['bidder' => $bidder]);
    }

    public function indexWithBidder($bidder)
    {
        $employee = Employee::findOrFail(decrypt($bidder));
        $bids = Bid::where('is_active', 1)
        ->with([
            'shift',
            'team',
            'position'
        ])->get();
        return view('electronic-bidding.show-all-bids', [
            'bids' => $bids,
            'employee' => $employee
        ]);
    }
}
