<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Models\Images;

Route::get('/home', function () { return view('home');});
Route::get('/search', function () {return view('pages.search');});
Route::controller(UserController::class)->group(function () {
    Route::get('/signup', 'show');
    Route::post('/signup', 'signup');
    Route::get('/login', function () {return view('users.login');});
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/forgetpassword', 'showforgetpassword')->name('ForgetPassword');
    // verify email and token
    Route::get('/', 'verifyemail')->name('verifyemail');
    Route::post('/verifytoken' , 'addverifyemail')->name('addverifyemail');
    Route::get('/token' , 'showemailverify')->name('show.emailverify');
    Route::post('token' , 'ckeckemailtoken')->name('check.emailtoken');
});

Route::middleware(['auth.user'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'showProfile')->name('profile');
        Route::get('/profile/edit', 'editProfile')->name('profile.edit');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::post('/profile', 'Profile')->name('profileimage.update');
        Route::get('/add-album', 'showalbum')->name('add-album');
        Route::post('/uploadalbum', 'album')->name('upload.album');
        Route::get('/websearch', 'searchoption')->name('search.option');
        Route::get('/search', 'search')->name('search');
    });

    Route::group([], function () {
        Route::resource('gallery', GalleriesController::class);
    });

    
    Route::controller(GalleryController::class)->group(function () {
    //     Route::get('/viewgallery', 'showgallery')->name('view.gallery');
    //     Route::post('/gallery', 'gallery')->name('gallery.images');
        Route::get('/add-images/{gallery_id}', 'showImageForm')->name('add-images');
        Route::POST('uploadimage', 'uploadimages')->name('uploadimages');
        Route::delete('/delete-gallery/{gallery_id}', 'deleteGallery')->name('delete.gallery');
        Route::get('/viewdummyimages', 'showdummyimages');
    });


    Route::get('/edit', function () {return view('pages/profileedit');});
    Route::get('/album', function () {return view('pages/galleryform');})->name('album');
    Route::get('/viewform', function () {return view('pages/galleryform');});
    Route::get('/useralbum/{gallery_id}', function ($id) {return view('pages/viewalbum');})->name('user.album');
    Route::get('viewimages/{gallery_id}', function ($id) {
        $images = Images::where('gallery_id', $id)->get();
        return view('pages/viewimages', compact('id', 'images'));
    })->name('view.images');

});
Route::controller(UserController::class)->group(function () {

    Route::get('/redirect/google', 'redirectToGoogle')->name('redirect.google');
    Route::get('/callback/google', 'handleGoogleCallback')->name('callback.google');
    Route::get('auth/google/login/type', 'redirectLogin')->name('google-auth-login');

});

// Route::middleware(['admin'])->group(function () {
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'admin')->name('admin');
    Route::patch('/admin/users', 'toggleStatus')->name('admin.toggle');
    Route::get('/admin/edit', '')->name('userprofile');
});
// });
Route::middleware(['admin'])->group(function () {
    Route::controller(RoleController::class)->group(function () {
        Route::resource('role', RoleController::class);

    });

  
});
Route::controller(RolePermissionController::class)->group(function () {
    Route::get('addrole', 'showaddrole')->name('add_role');
    Route::get('showrole', 'showroles')->name('show_roles');
    Route::post('addroledata', 'addrole')->name('add_role_data');
    Route::get('assignrole/{userId}', 'assignroles')->name("assign_roles");
    Route::post("adduserole", "adduserole")->name("add_userole");
});

