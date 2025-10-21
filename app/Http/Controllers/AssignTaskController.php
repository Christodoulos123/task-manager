<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AssignTaskController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'User assigned successfully!');
    }
}
