@extends('layout')

@section('content')
    <div class="register-form-content">
        <div class="register-form-container">
            <h2>Register Form</h2>
            <form action="/register" method="post">
                @csrf
                @method('PUT')
        
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter a username" autocomplete="off" value="{{old('username')}}">
                @error('username')
                    <p style="color:red; margin-bottom:5px;">{{$message}}</p>
                @enderror
                
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="off" value="{{old('email')}}">
                @error('email')
                    <p style="color:red; margin-bottom:5px;">{{$message}}</p>
                @enderror
                
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a password">
                @error('password')
                    <p style="color:red; margin-bottom:5px;">{{$message}}</p>
                @enderror
        
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password">
                @error('password_confirmation')
                    <p style="color:red; margin-bottom:5px;">{{$message}}</p>
                @enderror
        
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection