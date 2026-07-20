<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <style>
        body {
            background: #f8fafc;
            color: #1f2937;
            font-family: ui-sans-serif, system-ui, sans-serif;
            margin: 0;
        }

        main {
            margin: 3rem auto;
            max-width: 48rem;
            padding: 0 1rem;
        }

        section {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }

        h1,
        h2 {
            margin-top: 0;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.35rem;
        }

        input,
        textarea {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-sizing: border-box;
            display: block;
            font: inherit;
            margin-bottom: 1rem;
            padding: 0.65rem;
            width: 100%;
        }

        button {
            background: #2563eb;
            border: 0;
            border-radius: 0.375rem;
            color: #ffffff;
            cursor: pointer;
            font: inherit;
            padding: 0.65rem 1rem;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li + li {
            border-top: 1px solid #e5e7eb;
            margin-top: 1rem;
            padding-top: 1rem;
        }

        .status {
            color: #475569;
            font-size: 0.875rem;
        }

        .success {
            background: #dcfce7;
            border-radius: 0.375rem;
            color: #166534;
            padding: 0.75rem;
        }

        .error {
            color: #b91c1c;
            font-size: 0.875rem;
            margin: -0.6rem 0 1rem;
        }
    </style>
</head>
<body>
    <main>
        <h1>Task Management</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <section>
            <h2>Create a task</h2>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <label for="title">Title</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    required
                    minlength="3"
                >
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">Add task</button>
            </form>
        </section>

        <section>
            <h2>Existing tasks</h2>

            @if ($tasks->isEmpty())
                <p>No tasks have been created yet.</p>
            @else
                <ul>
                    @foreach ($tasks as $task)
                        <li>
                            <h3>{{ $task->title }}</h3>
                            @if ($task->description)
                                <p>{{ $task->description }}</p>
                            @else
                                <p>No description provided.</p>
                            @endif
                            <p class="status">Status: {{ $task->status }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </main>
</body>
</html>
