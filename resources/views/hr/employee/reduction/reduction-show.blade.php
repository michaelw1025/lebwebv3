@extends('layouts.app')

@section('content')

    <article class="col-8 col-xs-9 col-sm-10 main-content-article">
        <h2 class="mt-2 text-primary"><i class="fas fa-user-tag fa-lg"></i>&nbsp Show {{$reduction->employee->first_name}} {{$reduction->employee->last_name}} Reduction</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-reduction-form" method="GET" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $reduction->employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$reduction->employee->first_name}} {{$reduction->employee->last_name}}</a>

            <div class="form-row card-deck mt-4 mb-3">
                <div class="card bg-light {{$reduction->currently_active === '1' ? 'border-success' : 'border-danger'}}">
                    <div class="card-header">Current Status</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="currently_active" id="show-reduction-currently-active" value="1" {{$reduction->currently_active == '1' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-currently-active">
                            Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="currently_active" id="show-reduction-currently-inactive" value="0" {{$reduction->currently_active == '0' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-currently-inactive">
                            Inactive
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-light ">
                    <div class="card-header">Type</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="show-reduction-type-voluntary" value="voluntary" {{$reduction->type == 'voluntary' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-type-voluntary">
                            Voluntary
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="show-reduction-type-involuntary" value="involuntary" {{$reduction->type == 'involuntary' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-type-involuntary">
                            Involuntary
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-light ">
                    <div class="card-header">Displacement</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="discplacement" id="show-reduction-displacement-layoff" value="layoff" {{$reduction->displacement == 'layoff' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-displacement-layoff">
                            Layoff
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="discplacement" id="show-reduction-displacement-bump" value="bump" {{$reduction->displacement == 'bump' ? 'checked' : ''}} disabled>
                            <label class="form-check-label" for="show-reduction-displacement-bump">
                            Bump
                            </label>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-date">Date</label>
                    <input type="text" class="form-control" id="show-reduction-date" name="date" value="{{$reduction->date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-home-cost-center">Home Cost Center</label>
                    <input type="text" class="form-control" id="show-reduction-home-cost-center" name="home_cost_center" value="{{$reduction->home_cost_center_number}} {{$reduction->home_cost_center_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-bump-to-cost-center">Bump To Cost Center</label>
                    <input type="text" class="form-control" id="show-reduction-bump-to-cost-center" name="bump_to_cost_center" value="{{$reduction->bump_to_cost_center_number}} {{$reduction->bump_to_cost_center_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-home-shift">Home Shift</label>
                    <input type="text" class="form-control" id="show-reduction-home-shift" name="home_shift" value="{{$reduction->home_shift_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-bump-to-shift">Bump To Shift</label>
                    <input type="text" class="form-control" id="show-reduction-bump-to-shift" name="bump_to_shift" value="{{$reduction->bump_to_shift_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-fiscal-week">Fiscal Week</label>
                    <input type="text" class="form-control" id="show-reduction-fiscal-week" name="fiscal_week" value="{{$reduction->fiscal_week}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-fiscal-year">Fiscal Year</label>
                    <input type="text" class="form-control" id="show-reduction-fiscal-year" name="fiscal_year" value="{{$reduction->fiscal_year}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-reduction-return-date">Expected Return Date</label>
                    <input type="text" class="form-control" id="show-reduction-return-date" name="return_date" value="{{$reduction->return_date->format('m/d/Y')}}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="show-reduction-comments">Comments</label>
                    <textarea name="comments" id="show-reduction-comments" rows="3" class="form-control" disabled>{{$reduction->comments}}</textarea>
                </div>
            </div>


            

            <a href="{{route('reductions.edit', $reduction->id)}}" class="btn btn-edit mt-4">Edit Reduction</a>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

    </article>

@endsection