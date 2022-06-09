@extends('layouts.app')
@section('content')
<div class="container-xxl">
    <h2>{{$user->name}}</h2>
    @foreach ($gifts as $gift)
    <div class="row">
        <div class="col border">
            <h4>Gift name: {{$gift->name}}</h4>
        </div>
        <div class="col">
            <form action="{{route('gifts.destroy', $gift->id)}}" method="post">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn bg-danger">delete</button>
            </form>
        </div>

    </div>
    @endforeach
</div>
@endsection