@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Message</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- {{ dd($error)}} --}}
        <form action="{{ route('store')}}" method="POST">
            @csrf
            <label for="exampleFormControlInput1" class="form-label">To:</label>
            <select class="form-select" name="user" aria-label="Default select example">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{ $user->name}} | {{ $user->email}}</option>
                @endforeach
              </select>
              @error('user')
                    <div style="color:red">{{ $message }}</div>
                @enderror
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                <input type="text" value="{{ $subject }}" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="I want pizza..">
                @error('subject')
                    <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                @error('message')
                    <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
              <button type="submit" class="btn btn-warning">Send Message</button>
        </form>
    </div>


@endsection
