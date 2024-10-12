<?php


use App\Models\Attcodegenerators;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttcodegeneratorsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\EdulinksController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\OtpsController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PaymentmethodsController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PointTransfersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\PostLiveViewersController;
use App\Http\Controllers\PostViewDurationsController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ReligionsController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SocialapplicationsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentPhonesController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TownshipsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersFollowerController;
use App\Http\Controllers\UserPointsController;
use App\Http\Controllers\WarehousesController;



use App\Http\Controllers\ChatsController;


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



Route::get('/register/step1',[RegisteredUserController::class,'createstep1'])->name('register.step1');
Route::post('/register/step1',[RegisteredUserController::class,'storestep1'])->name('register.storestep1');

Route::get('/register/step2',[RegisteredUserController::class,'createstep2'])->name('register.step2')->middleware('check.registeration.step:step2');
Route::post('/register/step2',[RegisteredUserController::class,'storestep2'])->name('register.storestep2');

Route::get('/register/step3',[RegisteredUserController::class,'createstep3'])->name('register.step3');
Route::post('/register/step3',[RegisteredUserController::class,'storestep3'])->name('register.storestep3')->middleware('check.registeration.step:step3');;




Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->
Route::middleware(['auth','autologout','verified'])->group(function () {

    Route::get('/dashboards', [DashboardsController::class,'index'])->name('dashboards.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('announcements',AnnouncementsController::class);
    Route::delete('/announcementsbulkdeletes',[AnnouncementsController::class,'bulkdeletes'])->name('announcements.bulkdeletes');

    Route::resource('attcodegenerators',AttcodegeneratorsController::class);
    Route::get('attcodegeneratorsstatus',[AttcodegeneratorsController::class,'typestatus']);
    Route::delete('/attcodegeneratorsbulkdeletes',[AttcodegeneratorsController::class,'bulkdeletes'])->name('attcodegenerators.bulkdeletes');


    Route::get('/carts',[CartsController::class,'index'])->name('carts.index');
    Route::post('/carts/add',[CartsController::class,'add'])->name('carts.add');
    Route::post('/carts/remove',[CartsController::class,'remove'])->name('carts.remove');
    Route::post('/carts/paybypoints',[CartsController::class,'paybypoints'])->name('carts.paybypoints');


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
    Route::get('/edulinks/download/{id}',[EdulinksController::class,'download'])->name('edulinks.download');

    Route::resource('enrolls',EnrollsController::class);
    Route::delete('/enrollsbulkdeletes',[EnrollsController::class,'bulkdeletes'])->name('enrolls.bulkdeletes');


    Route::resource('genders',GendersController::class);
    Route::delete('/gendersbulkdeletes',[GendersController::class,'bulkdeletes'])->name('genders.bulkdeletes');

    Route::resource('/leads',LeadsController::class);
    Route::post('/leads/pipeline/{id}',[LeadsController::class,'converttostudent'])->name('leads.pipeline');


    Route::resource('leaves',LeavesController::class);
    Route::get('notify/markasread',[LeavesController::class,'markasread'])->name('leaves.marksasread');
    Route::delete('/leavesbulkdeletes',[LeavesController::class,'bulkdeletes'])->name('leaves.bulkdeletes');

    Route::post('/generateotps',[OtpsController::class,'generate']);
    Route::post('/verifyopts',[OtpsController::class,'verify']);


    Route::resource('packages',PackagesController::class);
    Route::post('/packages/setpackage',[PackagesController::class,'setpackage'])->name('packages.setpackage');
    Route::delete('/packagesbulkdeletes',[PackagesController::class,'bulkdeletes'])->name('packages.bulkdeletes');


    Route::resource('paymentmethods',PaymentmethodsController::class);
    Route::get('paymentmethodsstatus',[PaymentmethodsController::class,'typestatus']);
    Route::delete('/paymentmethodsbulkdeletes',[PaymentmethodsController::class,'bulkdeletes'])->name('paymentmethods.bulkdeletes');

    Route::resource('paymenttypes',PaymenttypesController::class);
    Route::get('paymenttypesstatus',[PaymenttypesController::class,'typestatus']);
    Route::delete('/paymenttypesbulkdeletes',[PaymenttypesController::class,'bulkdeletes'])->name('paymenttypes.bulkdeletes');

    Route::resource('plans',PlansController::class);

    Route::resource('pointtransfers',PointTransfersController::class);
    Route::post('/pointtransfers/transfer',[PointTransfersController::class,'transfers'])->name('pointtransfers.transfers');



    Route::resource('posts',PostsController::class);
    Route::post('/posts/{post}/like',[PostsLikeController::class,'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike',[PostsLikeController::class,'unlike'])->name('posts.unlike');
    Route::delete('/postsbulkdeletes',[PostsController::class,'bulkdeletes'])->name('posts.bulkdeletes');

    Route::post('/postliveviewersinc/{post}',[PostLiveViewersController::class,'incrementviewer']); // here must be {post}, don't use {id} cuz it request Post model
    Route::post('/postliveviewersdec/{post}',[PostLiveViewersController::class,'decrementviewer']);


    Route::post('/trackdurations',[PostViewDurationsController::class,'trackduration']);


    Route::resource('relatives',RelativesController::class);
    Route::get('relativesstatus',[RelativesController::class,'relativestatus']);
    Route::delete('/relativesbulkdeletes',[RelativesController::class,'bulkdeletes'])->name('relatives.bulkdeletes');

    Route::resource('regions',RegionsController::class);
    Route::get('/regionsstatus',[RegionsController::class,'typestatus']);
    Route::delete('/regionsbulkdeletes',[RegionsController::class,'bulkdeletes'])->name('regions.bulkdeletes');

    Route::resource('religions',ReligionsController::class);
    Route::get('/religionsstatus',[ReligionsController::class,'typestatus']);
    Route::delete('/religionsbulkdeletes',[ReligionsController::class,'bulkdeletes'])->name('religions.bulkdeletes');


    Route::resource('roles',RolesController::class);
    Route::get('rolesstatus',[RolesController::class,'rolestatus']);

    Route::resource('socialapplications',SocialapplicationsController::class);
    Route::get('socialapplicationsstatus',[SocialapplicationsController::class,'typestatus']);
    Route::get('socialapplicationsfetchalldatas',[SocialapplicationsController::class,'fetchalldatas'])->name("socialapplications.fetchalldatas");
    Route::delete('/socialapplicationsbulkdeletes',[SocialapplicationsController::class,'bulkdeletes'])->name('socialapplications.bulkdeletes');


    Route::resource('students',StudentsController::class);
    Route::delete('/studentsbulkdeletes',[StudentsController::class,'bulkdeletes'])->name('students.bulkdeletes');
    Route::post('compose/mailbox',[StudentsController::class,'mailbox'])->name('students.mailbox');
    Route::post('/students/quicksearch',[StudentsController::class,'quicksearch'])->name(name: 'students.quicksearch');
    Route::put('/students/{id}/profilepicture',[StudentsController::class,'updateprofilepicture'])->name('students.updateprofilepicture');

    Route::get('/studentphones/delete/{id}',[StudentPhonesController::class,'destroy'])->name('studentphones.delete');


    Route::get('/subscribesexpired',[SubscriptionsController::class,'expired'])->name('subscriptions.expired');


    Route::resource('stages',StagesController::class);
    Route::get('stagesstatus',[StagesController::class,'typestatus']);
    Route::delete('/stagesbulkdeletes',[StagesController::class,'bulkdeletes'])->name('stages.bulkdeletes');

    Route::resource('statuses',StatusesController::class);
    Route::delete('/statusesbulkdeletes',[StatusesController::class,'bulkdeletes'])->name('statuses.bulkdeletes');

    Route::resource('tags',TagsController::class);
    Route::get('tagsstatus',[TagsController::class,'tagstatus']);
    Route::delete('/tagsbulkdeletes',[TagsController::class,'bulkdeletes'])->name('tags.bulkdeletes');

    Route::resource('townships',TownshipsController::class);
    Route::get('/townshipsstatus',[TownshipsController::class,'typestatus']);
    Route::delete('/townshipsbulkdeletes',[TownshipsController::class,'bulkdeletes'])->name('townships.bulkdeletes');


    Route::resource('types',TypesController::class)->except('destroy');
    Route::get('/typesstatus',[TypesController::class,'typestatus']);
    Route::get('/typesdelete',[TypesController::class,'destroy'])->name('types.delete');
    Route::delete('/typesbulkdeletes',[TypesController::class,'bulkdeletes'])->name('types.bulkdeletes');


    Route::post('/users/{user}/follow',[UsersFollowerController::class,'like'])->name('users.follow');
    Route::post('/users/{user}/unfollow',[UsersFollowerController::class,'unlike'])->name('users.unfollow');

    Route::resource('userpoints',UserPointsController::class);
    Route::post('/userpoints/verifystudent',[UserPointsController::class,'verifystudent'])->name('userpoints.verifystudent');
    Route::delete('/userpointsbulkdeletes',[UserPointsController::class,'bulkdeletes'])->name('userpoints.bulkdeletes');


    Route::resource('warehouses',WarehousesController::class);
    Route::delete('/warehousesbulkdeletes',[WarehousesController::class,'bulkdeletes'])->name('warehouses.bulkdeletes');

    



    // pusher test
    Route::get('/pushers',function(){
        return view('pusher');

    });

    // pusher test by chat box
    Route::get('/chatboxs',function(){
        return view('chatbox');
    });

    Route::post('/chatmessages',[ChatsController::class,'sendmessage']);


});

Route::middleware(['auth','validate.subscriptions'])->group(function(){
    Route::resource('attendances',AttendancesController::class);
    Route::delete('/attendancesbulkdeletes',[AttendancesController::class,'bulkdeletes'])->name('attendances.bulkdeletes');
});


require __DIR__.'/auth.php';


// php artisan optimize 
// php artisan route:clear
// php artisan route:cache
// php artisan config:clear
// php artisan config:cache

