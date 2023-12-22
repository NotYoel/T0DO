@extends('layout')

@section('content')
    <div class="dashboard__container">
        <div class="dashboard__container__tasks-container">
            <h1 class="tasks-container__header">Your Tasks</h1>
            <button class="tasks-container__create-task">
                <a href="/tasks/create">
                    Create Task
                </a>
            </button>
            @if (count($tasks) == 0)
                <h2 style='text-align:center'>You currently have no tasks.</h2>
            @else
                @foreach ($tasks as $task)
                    <div class="tasks-container__task-box">
                        <div class="task-box__title">
                            <h2>
                                {{$task->title . " (ID: {$task->id})"}} 
                                <span style=<?= boolval($task->active_task) ? "background-color:#00BE00" : "background-color:red"?>>
                                    <?= boolval($task->active_task) ? "Active" : "Not Active"?>
                                </span>
                            </h2>
                            <p>{{$task->description}}</p>
                        </div>

                        <div class="task-box__btns">
                            <button>
                                <a href="/tasks/edit/{{$task->id}}">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                            </button>
                            <form action="/tasks/delete/{{$task->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection