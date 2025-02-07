<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

//Store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

//Edit (форма для редактирования задания с конкретным {id})
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

//Update (обновляем конкретную вакансию)
Route::patch('/jobs/{id}', function ($id) {
   //validate
   request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

   //authorize

   //update the job
   $job = Job::findOrFail($id);

   $job->update([
        'title' => request('title'),
        'salary' => request('salary')
   ]);

   //redirect to the job page
   return redirect('/jobs/' . $job->id);
});

//Destroy (обновляем конкретную вакансию)
Route::delete('/jobs/{id}', function ($id) {
    //authorize

    //delete the Job
    Job::findOrFail($id)->delete();

    //redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});