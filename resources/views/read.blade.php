@extends('layouts.app')

@section('content')
<div class="container-sm">
    From: {{ $message->userFrom->name }}
    <br>
    Email: {{ $message->userFrom->email }}
    <br>
    Subject: {{ $message->subject }}
    <hr>
    Message:
    <br><br>
    {{$message->body }}
    <hr>
    <a href="{{ route('create', [$message->userFrom->id, $message->subject]) }}" class="btn btn-primary">Reply</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('delete', $message->id) }}" class="btn btn-danger float-right">Delete</a>
    </div>
</div>

@endsection
