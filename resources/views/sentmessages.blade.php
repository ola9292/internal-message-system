@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sent Messages') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    {{ __('Your Outbox') }}
                </div>
                <div>
                    @if(count($messages)  > 0)
                        <ul class="list-group">
                            @foreach ($messages as $message)
                                <li class="list-group-item list-group-item-action list-group-item-primary"><b>{{ $message->userTo->email}}</b> | {{ $message->body }} {!! $message->read == 1 ? '<span class="badge bg-danger float-right">Read</span>' : ''!!}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="ms-3">
                            <p>You have no messages!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
