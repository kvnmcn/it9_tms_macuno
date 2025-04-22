@extends('layouts.app')


@section('content')
<h1 class="mt-4 text-center">Tasks</h1>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<hr>
<div class="text-end">
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-2" role="button">Create task</a>
</div>

<div class="row ms-4 mr-4">
    <table class="table">
        <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
            <tr>
                <td>
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST"
                        class="d-flex  align-items-center">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" class="mt-0" onchange="this.form.submit();" {{ $task->is_completed ?
                        'checked' : '' }}>
                        <span class="ms-4">{{ $task->title }}</span>
                    </form>
                </td>
                <td>{{ $task->description }}</td>
                <td>
                    <span class="badge text-bg-{{ $task->is_completed ? 'success' : 'warning' }}">
                        {{ $task->is_completed ? 'Completed' : 'Pending' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id)}}">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-muted text-center py-3">
                    No tasks found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>
@endsection