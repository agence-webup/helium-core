<?php

namespace Webup\LaravelHeliumCore\Features;

use Webup\LaravelHeliumCore\Commands\Publish;
use Webup\LaravelHeliumCore\Facades\LaravelHeliumCore;
use Webup\LaravelHeliumCore\Features\Definitions\Controller;
use Webup\LaravelHeliumCore\Features\Definitions\Feature;
use Webup\LaravelHeliumCore\Features\Definitions\Migration;
use Webup\LaravelHeliumCore\Features\Definitions\Model;
use Webup\LaravelHeliumCore\Features\Definitions\Resource;
use Webup\LaravelHeliumCore\Features\Definitions\Route;

class UserFeature extends Feature
{
    public static function make(): self
    {
        return parent::make()
            ->default_stub_processor(LaravelHeliumCore::getDefaultStubProcessor())
            ->migrations([
                Migration::make()
                    ->stub('helium_create_users_table.php.stub')
                    ->filename('create_'.config('helium-core.features.users.table_name').'_table.php'),
                Migration::make()
                    ->stub('helium_create_default_user.php.stub')
                    ->filename('create_default_'.config('helium-core.features.users.table_name').'.php'),
            ])
            ->routes(Route::make()->stub('users.php.stub'))
            ->resources(Resource::make()->stub('users')->directory(config('helium-core.features.users.table_name')))
            ->models([
                Model::make()->stub('User.php.stub')->filename(config('helium-core.features.users.model_name').'.php'),
            ])
            ->controllers([
                // Controller::make()->filename('AuthController.php'),
                // Controller::make()->filename('ForgotPasswordController.php'),
                // Controller::make()->filename('ResetPasswordController.php'),
                Controller::make()->stub('UserController.php.stub')->filename(config('helium-core.features.users.controller_name').'.php'),
            ])
            ->epilogue([
                function (Publish $publish) {
                    $publish->confirm("Do not forget to add the provider and the guard to your config/auth.php file,\nas described in the README.md file.\nPress enter to continue.");
                },
            ]);
    }
}
