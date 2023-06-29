Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::middleware('auth:helium')->group(function () {
    // add admin routes
    Route::get('/', fn () => 'Plop!')->name('home');
});

Route::middleware('auth:helium')
    ->prefix('users')
    ->as('user.')
    ->group(function () {
        Route::get('/', )->name('index');
        Route::get('/create', )->name('create');
        Route::post('/create', );

        Route::get('/update/{id}', )->name('update');
        Route::post('/update/{id}', );

        Route::delete('/delete/{id}', )->name('delete');
    });
