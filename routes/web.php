<?php

$this->post('CKeditor/upload_image', 'Admin\CKeditorController@upload')->name('upload');

$this->get('/', function () {
    $categories = App\Category::orderBy('id', 'asc')->get();
    return view('guest.home', compact('categories'));
})->name('home');

$this->get('/sapekAdventure', function(){
    return view('guest.product');
})->name('user.product');

Route::resource('product', 'User\ProductController');
$this->get('category/{category}', 'User\ProductController@category')->name('category.show');

Route::resource('blog', 'User\BlogController');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// REgister Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.regis');
$this->post('register', 'Auth\RegisterController@register')->name('auth.regis');


// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('category', 'Admin\CategoryController');
    Route::post('category_mass_destroy', ['uses' => 'Admin\CategoryController@massDestroy', 'as' => 'category.mass_destroy']);
    Route::resource('celoteh', 'Admin\CelotehController');
    Route::post('product_mass_destroy', ['uses' => 'Admin\CelotehController@massDestroy', 'as' => 'celoteh.mass_destroy']);
    Route::resource('image', 'Admin\ImageController');

    Route::resource('tags', 'Admin\TagController');
    Route::post('tags_mass_destroy', ['uses' => 'Admin\TagController@massDestroy', 'as' => 'tags.mass_destroy']);

    Route::resource('blog', 'Admin\BlogController');
    Route::post('blog_mass_destroy', ['uses' => 'Admin\BlogController@massDestroy', 'as' => 'blog.mass_destroy']);

    Route::resource('list', 'Admin\PriceOffController');
    Route::post('tags_mass_destroy', ['uses' => 'Admin\PriceOffController@massDestroy', 'as' => 'list.mass_destroy']);

    Route::resource('comment', 'Admin\CommentController');

    Route::post('admin/replyComment', 'Admin\replyCommentController@replyThreadComment')->name('replyComment.store');
    $this->post('store/comments', 'Admin\CommentController@newComment')->name('store.comment');

});

Route::get('/addToCart/{id}', 'User\CartController@addToCart')->name('addToCart');
Route::get('/cart', 'User\CartController@cartIndex')->name('cartIndex');
Route::match(['put', 'patch'], '/cart/{cart}','User\CartController@updateCart')->name('updateCart');
Route::delete('/cart{id}','User\CartController@deleteCart')->name('deleteCart');