<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tasks.create') }}">Add new task</a>
                    <table> 
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Assign Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}"> 
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($task->completed)
                                            Completed
                                        @else
                                            Not Completed
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.assign-user', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="user_id" onchange="this.form.submit()" class="bg-gray-800 text-gray-200 border border-gray-700 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                <option value="">Unassigned</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
