<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks for {{ $project->name }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Tasks for {{ $project->name }}</h1>

        @if ($parent_id)
            <a href="{{ route('projects.tasks.subtasks.create', ['project' => $project->id, 'task' => $parent_id]) }}"
                class="btn btn-secondary mb-3">Create Sub-Task</a>
        @else
            <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary mb-3">Create Task</a>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('projects.tasks.index', [$project, 'parent_id' => $task->id]) }}"
                                class="btn btn-secondary btn-sm">Lihat Sub-Tugas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
