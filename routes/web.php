<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Job Categories
    Route::delete('job-categories/destroy', 'JobCategoriesController@massDestroy')->name('job-categories.massDestroy');
    Route::post('job-categories/parse-csv-import', 'JobCategoriesController@parseCsvImport')->name('job-categories.parseCsvImport');
    Route::post('job-categories/process-csv-import', 'JobCategoriesController@processCsvImport')->name('job-categories.processCsvImport');
    Route::resource('job-categories', 'JobCategoriesController');

    // Skills
    Route::delete('skills/destroy', 'SkillsController@massDestroy')->name('skills.massDestroy');
    Route::post('skills/parse-csv-import', 'SkillsController@parseCsvImport')->name('skills.parseCsvImport');
    Route::post('skills/process-csv-import', 'SkillsController@processCsvImport')->name('skills.processCsvImport');
    Route::resource('skills', 'SkillsController');

    // Request Resume
    Route::delete('request-resumes/destroy', 'RequestResumeController@massDestroy')->name('request-resumes.massDestroy');
    Route::resource('request-resumes', 'RequestResumeController');

    // My Resume
    Route::delete('my-resumes/destroy', 'MyResumeController@massDestroy')->name('my-resumes.massDestroy');
    Route::post('my-resumes/media', 'MyResumeController@storeMedia')->name('my-resumes.storeMedia');
    Route::post('my-resumes/ckmedia', 'MyResumeController@storeCKEditorImages')->name('my-resumes.storeCKEditorImages');
    Route::resource('my-resumes', 'MyResumeController');

    // My Skills
    Route::delete('my-skills/destroy', 'MySkillsController@massDestroy')->name('my-skills.massDestroy');
    Route::resource('my-skills', 'MySkillsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Job Categories
    Route::delete('job-categories/destroy', 'JobCategoriesController@massDestroy')->name('job-categories.massDestroy');
    Route::resource('job-categories', 'JobCategoriesController');

    // Skills
    Route::delete('skills/destroy', 'SkillsController@massDestroy')->name('skills.massDestroy');
    Route::resource('skills', 'SkillsController');

    // Request Resume
    Route::delete('request-resumes/destroy', 'RequestResumeController@massDestroy')->name('request-resumes.massDestroy');
    Route::resource('request-resumes', 'RequestResumeController');

    // My Resume
    Route::delete('my-resumes/destroy', 'MyResumeController@massDestroy')->name('my-resumes.massDestroy');
    Route::post('my-resumes/media', 'MyResumeController@storeMedia')->name('my-resumes.storeMedia');
    Route::post('my-resumes/ckmedia', 'MyResumeController@storeCKEditorImages')->name('my-resumes.storeCKEditorImages');
    Route::resource('my-resumes', 'MyResumeController');

    // My Skills
    Route::delete('my-skills/destroy', 'MySkillsController@massDestroy')->name('my-skills.massDestroy');
    Route::resource('my-skills', 'MySkillsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
