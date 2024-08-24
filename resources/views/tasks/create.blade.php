<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($parent_id) ? 'Create Sub-Task' : 'Create Task' }}</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">{{ isset($parent_id) ? 'Create Sub-Task' : 'Create Task' }}</h2>
        <form action="{{ route('projects.tasks.store', $project) }}" method="POST"
            class="p-4 bg-light rounded shadow-sm">
            @csrf
            <div class="form-group mb-3">
                <label for="name">{{ isset($parent_id) ? 'Sub-Task Name' : 'Task Name' }}</label>
                <input type="text" name="name" class="form-control" required
                    placeholder="{{ isset($parent_id) ? 'Enter Sub-Task Name' : 'Enter Task Name' }}">
            </div>

            <div class="form-group mb-3">
                <label for="description">Task Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Enter Task Description"></textarea>
            </div>

            @if (isset($parent_id))
                <!-- Jika membuat sub-task, sertakan parent_id -->
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
            @else
                <!-- Jika membuat main task, parent_id tidak ada (NULL) -->
                <input type="hidden" name="parent_id" value="">
            @endif

            <button type="submit"
                class="btn btn-primary">{{ isset($parent_id) ? 'Create Sub-Task' : 'Create Task' }}</button>
            <a href="{{ route('projects.tasks.index', $project) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Tambahkan Bootstrap JS dan dependensi -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
