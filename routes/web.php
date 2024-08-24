<?php

use App\Http\Controllers\ProjectController;

use App\Http\Controllers\TaskController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('/projects', ProjectController::class);

Route::controller(TaskController::class)->group(function () {
    // Rute untuk tugas utama
    Route::get('/projects/{project}/tasks', 'index')->name('projects.tasks.index');
    Route::get('/projects/{project}/tasks/create', 'create')->name('projects.tasks.create');
    Route::post('/projects/{project}/tasks', 'store')->name('projects.tasks.store');

    // Rute untuk edit dan update tugas
    Route::get('/projects/{project}/tasks/{task}/edit', 'edit')->name('projects.tasks.edit');
    Route::put('/projects/{project}/tasks/{task}', 'update')->name('projects.tasks.update');

    // Rute untuk menghapus tugas
    Route::delete('/projects/{project}/tasks/{task}', 'destroy')->name('projects.tasks.destroy');

    // Rute untuk membuat sub-task
    Route::get('/projects/{project}/tasks/{task}/subtasks/create', 'create')->name('projects.tasks.subtasks.create');
    Route::post('/projects/{project}/tasks/{task}/subtasks', 'storeSubTask')->name('projects.tasks.store.subtask');
}); 