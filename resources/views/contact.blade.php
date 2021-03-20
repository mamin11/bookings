@extends('layouts.home')
@section('content')

<div class="container ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <form action="/contact" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="name">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="5" style="min-height: 350px"></textarea>
                </div>
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success">{{ session()->get('message') }}</div>
    @endif

</div>

@endsection