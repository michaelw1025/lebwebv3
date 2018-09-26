@extends('layouts.app')

@section('content')

                <!-- Title for content -->
        @component('components.content-title')
                @slot('textClass')
                text-primary
                @endslot

                @slot('fontStyle')
                fas
                @endslot

                @slot('fontIcon')
                fa-receipt
                @endslot

                @slot('fontSize')
                fa-lg
                @endslot
                
                @slot('title')
                Bidding
                @endslot

                @slot('displayExport')
                d-none
                @endslot

                @slot('exportRoute')

                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <a href="{{route('bids.create')}}" class="btn btn-create mb-3">Create New Bid</a>

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead class="bg-header text-light">
                <tr>
                    <th scope="col">Posting Number</th>
                    <th scope="col">Post Date</th>
                    <th scope="col">Pull Date</th>
                    <th scope="col">Position</th>
                    <th scope="col"># Openings</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bids as $bid)
                <tr class="clickable-row {{$bid->is_active == 0 ? 'text-danger' : ''}}" data-href="{{route('bids.show', ['id' => $bid->id])}}">
                    <td>{{$bid->posting_number}}</td>
                    <td>{{$bid->post_date->format('m/d/Y')}}</td>
                    <td>{{$bid->pull_date->format('m/d/Y')}}</td>
                    <td class="d-none d-md-table-cell">{{$bid->position->description}}</td>
                    <td class="d-none d-md-table-cell">{{$bid->number_of_openings}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
            
@endsection