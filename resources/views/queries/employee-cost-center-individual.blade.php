@extends('layouts.app')

@section('content')

                <!-- Title for content -->
        @component('components.content-title')
                @slot('textClass')
                text-primary
                @endslot

                @slot('fontStyle')
                        
                @endslot

                @slot('fontIcon')
                        
                @endslot

                @slot('fontSize')
                        
                @endslot
                
                @slot('title')
                Query:  Individual Cost Centers
                @endslot

                @slot('displayExport')
                d-block
                @endslot

                @slot('exportRoute')
                @if(isset($searchCostCenter))
                {{Route('export-employee-cost-center-individual', ['cost_center' => $searchCostCenter])}}
                @endif
                @endslot
        @endcomponent
                

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <!-- Page content goes here -->
        <form action="{{Route('queries.employee-cost-center-individual')}}" class="mt-2" id="search-employee-cost-center-individual-form" method="GET">
            @csrf
            <h5>Search Cost Center</h5>
            <p class="text-danger">@component('components.required-icon')@endComponent indicates a required field</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee-search-cost-center">Cost Center @component('components.required-icon')@endComponent</label>
                    <select name="cost_center" id="employee-search-cost-center" class="custom-select {{$errors->has('cost_center') ? 'is-invalid' : ''}}">
                        <option value=""></option>
                        @foreach($costCenters as $costCenter)
                        <option {{isset($searchCostCenter) ? ($searchCostCenter == $costCenter->id ? 'selected' : '') : ''}} value="{{$costCenter->id}}">{{$costCenter->number}} {{$costCenter->extension}} {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('cost_center'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('cost_center')}}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="submit-employee-anniversary-search">Search</button>
            <button type="button" class="btn btn-info reset-item-search" id="" name="search-employee-anniversary-form">Reset</button>
        </form>

        <hr></hr>
        @if(isset($searchedCostCenter))
        @include('queries.export-tables.cost-center-individual')
        @endif
            
@endsection