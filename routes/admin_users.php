        Route::middleware('guest:admin')
            ->group(function () {
                Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
                Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
                Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
            });

        Route::middleware('auth:admin')
            ->prefix('admin_user')
            ->as('admin_user.')
            ->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('index');

                Route::get('/create', [App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('create');
                Route::post('/store', [App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('store');

                Route::get('/edit/{id}', [App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('update');

                Route::delete('/destroy/{id}', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('destroy');
            });
