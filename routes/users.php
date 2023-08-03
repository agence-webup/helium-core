Route::get('/login', 'App\Http\Controllers\Helium\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Helium\AuthController@login');
Route::get('/logout', 'App\Http\Controllers\Helium\AuthController@logout')->name('logout');

Route::middleware('auth:helium')
->prefix('users')
->as('user.')
->group(function () {
Route::get('/', [App\Http\Controllers\Helium\UserController::class, 'index'])->name('index');
Route::get('/{id}', [App\Http\Controllers\Helium\UserController::class, 'show'])->name('show');

Route::get('/create', [App\Http\Controllers\Helium\UserController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\Helium\UserController::class, 'store'])->name('store');

Route::get('/edit/{id}', [App\Http\Controllers\Helium\UserController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\Helium\UserController::class, 'update'])->name('update');

Route::delete('/destroy/{id}', [App\Http\Controllers\Helium\UserController::class, 'destroy'])->name('destroy');
});
