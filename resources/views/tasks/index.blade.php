<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* resources/css/app.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

form {
    margin-bottom: 20px;
}

input[type="text"] {
    width: calc(100% - 22px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-right: 10px;
    box-sizing: border-box;
}

button {
    margin-top: 10px;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    color: #fff;
    background-color: #007bff;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
    color: #fff;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    background-color: #fff;
    border-radius: 4px;
    margin-bottom: 10px;
}

.checkbox {
    margin-right: 10px;
}

.delete-button {
    color: #dc3545;
    cursor: pointer;
    background-color: transparent;
    border: none;
    transition: color 0.3s;
}

.delete-button:hover {
    color: #a71d2a;
}

.completed {
    text-decoration: line-through;
    color: #999;
}

.edit-form {
    display: flex;
    align-items: center;
}

.edit-form input[type="text"] {
    margin-right: 10px;
    width: auto;
    flex-grow: 1;
    box-sizing: border-box;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>

        <form action="/tasks" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Add a new task">
            <button type="submit">Add Task</button>
        </form>

        <ul>
            @foreach($tasks as $task)
            <li>
                <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <label>
                        <input type="checkbox" name="completed" class="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        <span class="{{ $task->completed ? 'completed' : '' }}">{{ $task->title }}</span>
                    </label>
                </form>
                <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>

                <!-- Formulir Edit Task -->
                <form action="/tasks/{{ $task->id }}" method="POST" class="edit-form" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="title" value="{{ $task->title }}" placeholder="Edit task">
                    <button type="submit">Update</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
