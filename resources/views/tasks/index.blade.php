@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">My To-Do List</h1>


{{-- new task form --}}
<form action="/tasks" method="POST" class="mb-6">
    @csrf
    <input
      type="text" name="title"
      placeholder="New task…"
      class="border p-2 w-3/4"
      value="{{ old('title') }}"
    >
    <button class="bg-blue-500 text-white px-4 py-2">Add</button>
    @error('title')
      <p class="text-red-600">{{ $message }}</p>
    @enderror
  </form>


 {{-- display task --}}
<ul>
    @foreach($tasks as $task)
    <li class="flex items-center mb-2">
        <form action="/tasks/{{ $task->id }}" method="POST" class="mr-3">
            @csrf
            @method('PATCH')

            <button type="submit">
            @if($task->is_done)
              ✅
            @else
              ⬜
            @endif
          </button>
        </form>

        <span @class([
          'line-through text-gray-500' => $task->is_done,
          'font-medium'             => ! $task->is_done
        ])>
            {{ $task->title }}
        </span>
    </li>
    @endforeach
</ul>

@endsection