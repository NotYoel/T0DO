@extends('layout')

@section('content')
<div class="register-form-content">
    <div class="register-form-container">
        <h2>Task Creation Form</h2>
        <form action="/tasks/create" method="post">
            @csrf
            @method('PUT')
            
            <label for="title">Task Title:</label>
            <input type="text" name="title" id="title" placeholder="Enter a task title" autocomplete="off" value="{{old('title')}}">
            @error('title')
                <p style="color:red; margin-bottom:5px;">{{$message}}</p>
            @enderror
            
            <label for="description">Task Description:</label>
            <input type="text" name="description" id="description" placeholder="Enter a task description" autocomplete="off" value="{{old('description')}}">
            @error('description')
                <p style="color:red; margin-bottom:5px;">{{$message}}</p>
            @enderror

            <div class="edit-form-checkbox">
                <label for="active_task">Active task?</label>

                <input type="checkbox" name="active_task" id="active_task" checked>
            </div>
    
            <input type="submit" value="Create Task">
        </form>
    </div>
</div>
@endsection