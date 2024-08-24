<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project, Request $request)
{
    $parentId = $request->input('parent_id');

    if ($parentId) {
        $tasks = Task::where('parent_id', $parentId)->get();
    } else {
        $tasks = Task::where('project_id', $project->id)->whereNull('parent_id')->get();
    }

    return view('tasks.index', [
        'project' => $project,
        'tasks' => $tasks,
        'parent_id' => $parentId
    ]);
}


    public function create(Project $project, $task=null)
    {
        return view('tasks.create', [
            'project' => $project,
            'parent_id' => $task
        ]);

    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:tasks,id',
        ]);

        $task = new Task($request->all());
        $task->project_id = $projectId;
        $task->save();

        return redirect()->route('projects.tasks.index', $projectId)->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task deleted successfully.');
    }
}
