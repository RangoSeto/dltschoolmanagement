<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\EdulinksController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboards', [DashboardsController::class,'index'])->name('dashboards.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('announcements',AnnouncementsController::class);
    Route::resource('attendances',AttendancesController::class);

    Route::resource('categories',CategoriesController::class);
    Route::get('categoriesstatus',[CategoriesController::class,'categorystatus']);

    Route::resource('cities',CitiesController::class);
    Route::resource('comments',CommentsController::class);
    Route::resource('contacts',ContactsController::class);
    Route::resource('countries',CountriesController::class);

    Route::resource('days',DaysController::class);
    Route::get('daysstatus',[DaysController::class,'daystatus']);


    Route::resource('edulinks',EdulinksController::class);
    Route::resource('enrolls',EnrollsController::class);
    Route::resource('genders',GendersController::class);

    Route::resource('leaves',LeavesController::class);
    Route::get('notify/markasread',[LeavesController::class,'markasread'])->name('leaves.marksasread');

    Route::resource('posts',PostsController::class);

    Route::resource('relatives',RelativesController::class);
    Route::get('relativesstatus',[RelativesController::class,'relativestatus']);

    Route::resource('roles',RolesController::class);
    Route::get('rolesstatus',[RolesController::class,'rolestatus']);

    Route::resource('students',StudentsController::class);

    Route::resource('stages',StagesController::class);
    Route::get('stagesstatus',[StagesController::class,'typestatus']);

    Route::resource('statuses',StatusesController::class);

    Route::resource('tags',TagsController::class);
    Route::get('tagsstatus',[TagsController::class,'tagstatus']);

    Route::resource('types',TypesController::class);
    Route::get('typesstatus',[TypesController::class,'typestatus']);

});

require __DIR__.'/auth.php';
