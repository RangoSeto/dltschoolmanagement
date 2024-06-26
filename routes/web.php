<?php

use App\Models\Attcodegenerators;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttcodegeneratorsController;
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
use App\Http\Controllers\PaymentmethodsController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SocialapplicationsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersFollowerController;
use App\Http\Controllers\WarehousesController;



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
    Route::delete('/announcementsbulkdeletes',[AnnouncementsController::class,'bulkdeletes'])->name('announcements.bulkdeletes');

    Route::resource('attcodegenerators',AttcodegeneratorsController::class);
    Route::get('attcodegeneratorsstatus',[AttcodegeneratorsController::class,'typestatus']);
    Route::delete('/attcodegeneratorsbulkdeletes',[AttcodegeneratorsController::class,'bulkdeletes'])->name('attcodegenerators.bulkdeletes');


    Route::resource('attendances',AttendancesController::class);
    Route::delete('/attendancesbulkdeletes',[AttendancesController::class,'bulkdeletes'])->name('attendances.bulkdeletes');


    Route::resource('categories',CategoriesController::class);
    Route::get('categoriesstatus',[CategoriesController::class,'categorystatus']);
    Route::delete('/categoriesbulkdeletes',[CategoriesController::class,'bulkdeletes'])->name('categories.bulkdeletes');

    Route::resource('cities',CitiesController::class);
    Route::delete('/citiesbulkdeletes',[CitiesController::class,'bulkdeletes'])->name('cities.bulkdeletes');

    Route::resource('comments',CommentsController::class);

    Route::resource('contacts',ContactsController::class);
    Route::delete('/contactsbulkdeletes',[ContactsController::class,'bulkdeletes'])->name('contacts.bulkdeletes');

    Route::resource('countries',CountriesController::class);
    Route::get('/countriesstatus',[CountriesController::class,'typestatus']);
    Route::delete('/countriesbulkdeletes',[CountriesController::class,'bulkdeletes'])->name('countries.bulkdeletes');

    Route::resource('days',DaysController::class);
    Route::get('daysstatus',[DaysController::class,'daystatus']);
    Route::delete('/daysbulkdeletes',[DaysController::class,'bulkdeletes'])->name('days.bulkdeletes');

    Route::resource('edulinks',EdulinksController::class);
    Route::delete('/edulinksbulkdeletes',[EdulinksController::class,'bulkdeletes'])->name('edulinks.bulkdeletes');

    Route::resource('enrolls',EnrollsController::class);
    Route::delete('/enrollsbulkdeletes',[EnrollsController::class,'bulkdeletes'])->name('enrolls.bulkdeletes');


    Route::resource('genders',GendersController::class);
    Route::delete('/gendersbulkdeletes',[GendersController::class,'bulkdeletes'])->name('genders.bulkdeletes');


    Route::resource('leaves',LeavesController::class);
    Route::get('notify/markasread',[LeavesController::class,'markasread'])->name('leaves.marksasread');
    Route::delete('/leavesbulkdeletes',[LeavesController::class,'bulkdeletes'])->name('leaves.bulkdeletes');


    Route::resource('paymentmethods',PaymentmethodsController::class);
    Route::get('paymentmethodsstatus',[PaymentmethodsController::class,'typestatus']);
    Route::delete('/paymentmethodsbulkdeletes',[PaymentmethodsController::class,'bulkdeletes'])->name('paymentmethods.bulkdeletes');

    Route::resource('paymenttypes',PaymenttypesController::class);
    Route::get('paymenttypesstatus',[PaymenttypesController::class,'typestatus']);
    Route::delete('/paymenttypesbulkdeletes',[PaymenttypesController::class,'bulkdeletes'])->name('paymenttypes.bulkdeletes');


    Route::resource('posts',PostsController::class);
    Route::post('posts/{post}/like',[PostsLikeController::class,'like'])->name('posts.like');
    Route::post('posts/{post}/unlike',[PostsLikeController::class,'unlike'])->name('posts.unlike');
    Route::delete('/postsbulkdeletes',[PostsController::class,'bulkdeletes'])->name('posts.bulkdeletes');


    Route::resource('relatives',RelativesController::class);
    Route::get('relativesstatus',[RelativesController::class,'relativestatus']);
    Route::delete('/relativesbulkdeletes',[RelativesController::class,'bulkdeletes'])->name('relatives.bulkdeletes');

    Route::resource('roles',RolesController::class);
    Route::get('rolesstatus',[RolesController::class,'rolestatus']);

    Route::resource('socialapplications',SocialapplicationsController::class);
    Route::get('socialapplicationsstatus',[SocialapplicationsController::class,'typestatus']);
    Route::get('socialapplicationsfetchalldatas',[SocialapplicationsController::class,'fetchalldatas'])->name("socialapplications.fetchalldatas");
    Route::delete('/socialapplicationsbulkdeletes',[SocialapplicationsController::class,'bulkdeletes'])->name('socialapplications.bulkdeletes');


    Route::resource('students',StudentsController::class);
    Route::delete('/studentsbulkdeletes',[StudentsController::class,'bulkdeletes'])->name('students.bulkdeletes');

    Route::post('compose/mailbox',[StudentsController::class,'mailbox'])->name('students.mailbox');

    Route::resource('stages',StagesController::class);
    Route::get('stagesstatus',[StagesController::class,'typestatus']);
    Route::delete('/stagesbulkdeletes',[StagesController::class,'bulkdeletes'])->name('stages.bulkdeletes');

    Route::resource('statuses',StatusesController::class);
    Route::delete('/statusesbulkdeletes',[StatusesController::class,'bulkdeletes'])->name('statuses.bulkdeletes');

    Route::resource('tags',TagsController::class);
    Route::get('tagsstatus',[TagsController::class,'tagstatus']);
    Route::delete('/tagsbulkdeletes',[TagsController::class,'bulkdeletes'])->name('tags.bulkdeletes');

    Route::resource('types',TypesController::class)->except('destroy');
    Route::get('/typesstatus',[TypesController::class,'typestatus']);
    Route::get('/typesdelete',[TypesController::class,'destroy'])->name('types.delete');
    Route::delete('/typesbulkdeletes',[TypesController::class,'bulkdeletes'])->name('types.bulkdeletes');


    Route::post('users/{user}/follow',[UsersFollowerController::class,'like'])->name('users.follow');
    Route::post('users/{user}/unfollow',[UsersFollowerController::class,'unlike'])->name('users.unfollow');

    Route::resource('warehouses',WarehousesController::class);
    Route::delete('/warehousesbulkdeletes',[WarehousesController::class,'bulkdeletes'])->name('warehouses.bulkdeletes');

    

});

require __DIR__.'/auth.php';


// php artisan optimize 
// php artisan route:clear
// php artisan route:cache
// php artisan config:clear
// php artisan config:cache

