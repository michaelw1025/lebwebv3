<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Bid;

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
        $bid = Bid::with([
            'shift',
            'team',
            'position',
            'bidTopWage',
            'bidEducationTopWage'
        ])->findOrFail($id);
        return view('electronic-bidding.show-bid', [
            'bid' => $bid
        ]);
    }
}
