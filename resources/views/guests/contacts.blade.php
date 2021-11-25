@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <div class="card-header text-danger">
                <h1>Contact Us</h1>
            </div>
            <div class="card-body">

                <form action="{{route('guests.contacts.send')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="text-danger" for="name">Name</label>
                        <input class="form-control form-control-lg" type="text" 
                        placeholder="Name" id="name" name="name" value="{{ old('name') }}">
                    </div>
    
                    <div class="form-group">
                        <label class="text-danger" for="email_address">Email</label>
                        <input class="form-control form-control-lg" type="text" 
                        placeholder="Email address" id="email_address" name="email_address" value="{{ old('email_address') }}">
                    </div>

                    <div class="form-group">
                        <label class="text-danger" for="message">Message</label>
                        <textarea  class="form-control" type="textarea" placeholder="Your message" id="message" name="message" >{{old('message') }} </textarea>
                    </div>

                    <button type="submit" class="btn btn-danger">Send</button>
                    <button type="reset" class="btn btn-secondary">Delete</button>

                </form>
                
            </div>
        </div>
    </div>
@endsection