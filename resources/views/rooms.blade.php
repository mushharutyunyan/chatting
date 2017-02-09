@extends('layouts.app')

@section('content')
<h3>Rooms</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <ul class="list-group">
                @foreach($rooms as $room)
                @if(!$room['private_active'])
                <li class="list-group-item"><a href="/room/activate/{{$room->private_key}}">Room - {{$room->name}} is private click this link to activate</a></li>
                @else
                <li class="list-group-item"><a href="/room/{{$room->name}}">{{$room->name}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection