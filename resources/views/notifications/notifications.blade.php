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
                Notifications
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
        @inject('notifications', 'App\Services\UserNotificationService')

        <table class="table table-sm table-hover table-borderless table-striped">
            <thead class="bg-header text-light">
                <tr class="text-center">
                    <th scope="col" class="border-left border-right border-white">Type</th>
                    <th scope="col" class="border-right border-white">Message</th>
                    <th scope="col" class="border-right border-white">Date</th>
                    <th scope="col" class="border-right border-white">Mark As Read</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications->getNotifications() as $notification)
                @switch($notification->type)
                    @case('App\Notifications\UserRegistered')
                        <tr class="{{$loop->last ? 'border-bottom' : ''}} {{$notification->read_at != null ? 'table-danger text-danger' : ''}}" id="row-{{$notification->id}}">
                            <td class="clickable-row border-left border-right" data-href="{{route('users.show', ['id' => $notification->data['id']])}}">{{substr($notification->type, strrpos($notification->type, '\\')+1)}}</td>
                            <td class="clickable-row border-right" data-href="{{route('users.show', ['id' => $notification->data['id']])}}">User {{$notification->data['first']}} {{$notification->data['last']}}, {{$notification->data['email']}}, registered</td>
                            <td class="clickable-row border-right" data-href="{{route('users.show', ['id' => $notification->data['id']])}}">{{$notification->created_at->format('m/d/Y')}}</td>
                            <td class="text-center border-right">
                                <form action="" id="mark-notification-as-read-form">
                                        <input type="checkbox" class="form-check-input mark-as-read-checkbox" id="{{$notification->id}}" name="{{route('mark-notification-as-read', ['id' => $notification->id])}}" {{$notification->read_at != null ? 'checked' : ''}}>
                                </form>
                            </td class="border-right">
                        </tr>
                        @break
                    @default
                        <tr class="{{$loop->last ? 'border-bottom' : ''}}">
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                @endswitch
                @endforeach
            </tbody>
        </table>

            
@endsection