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
            fa-info-circle
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show Wage Title: {{ucwords($wageTitle->description)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-wage-title-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-wage-title-description">Description</label>
                    <input type="text" class="form-control" id="show-wage-title-description" name="description" value="{{ucwords($wageTitle->description)}}" disabled>
                </div>
            </div>
            <div class="form-row mt-4">
                @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                <!-- <div class="form-group col-sm-6 col-md-4 col-lg-2">
                    <label for="show-wage-title-wage-progression-{{$wageTitleWageProgression->month}}">{{$wageTitleWageProgression->month}}</label>
                    <input type="text" class="form-control" id="show-wage-title-wage-progression-{{$wageTitleWageProgression->month}}" name="wage_progression[{{$wageTitleWageProgression->id}}]" value="{{$wageTitleWageProgression->pivot->amount}}" disabled>
                </div> -->

                <!-- col-sm-6 col-md-4 col-lg-3  -->
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$wageTitleWageProgression->month}}</span>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control d-none" id="show-wage-title-wage-progression-{{$wageTitleWageProgression->pivot->wage_progression_id}}-id" name="wage_progression[{{$loop->index}}]" value="{{$wageTitleWageProgression->pivot->wage_progression_id}}" disabled>
                    <input type="text" class="form-control" id="show-wage-title-wage-progression-{{$wageTitleWageProgression->id}}-amount" name="wage_progression[{{$loop->index}}]" value="{{$wageTitleWageProgression->pivot->amount}}" disabled>
                </div>
                @endforeach
            </div>

            <a href="{{route('wageTitles.edit', $wageTitle->id)}}" class="btn btn-edit mt-4">Edit Wage Title</a>
        </form>

@endsection