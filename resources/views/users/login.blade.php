@extends('layout')

@section('content')
<div class="register-form-content">
    <div class="register-form-container">
        <h2>Login Form</h2>
        <form action="/login" method="post">
            @csrf
            
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
    
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
@endsection