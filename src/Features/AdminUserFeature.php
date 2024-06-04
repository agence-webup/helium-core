<?php

namespace Webup\HeliumCore\Features;

use Webup\HeliumCore\Commands\Publish;
use Webup\HeliumCore\Facades\HeliumCore;
use Webup\HeliumCore\Features\Definitions\Controller;
use Webup\HeliumCore\Features\Definitions\Feature;
use Webup\HeliumCore\Features\Definitions\Migration;
use Webup\HeliumCore\Features\Definitions\Model;
use Webup\HeliumCore\Features\Definitions\Resource;
use Webup\HeliumCore\Features\Definitions\Route;

class AdminUserFeature extends Feature
{
    public static function make(): static
    {
        return (new static)
            ->default_stub_processor(HeliumCore::getDefaultStubProcessor())
            ->migrations([
                Migration::make()
                    ->stub('helium_create_admin_users_table.php')
                    ->filename('create_admin_users_table.php'),
                Migration::make()
                    ->stub('helium_create_default_admin_user.php')
                    ->filename('create_default_admin_users.php'),
            ])
            ->routes(Route::make()->stub('admin_users.php'))
            ->resources(Resource::make()->stub('admin_users')->directory('admin_users'))
            ->models([
                Model::make()->stub('AdminUser.php')->filename('AdminUser.php'),
            ])
            ->controllers([
                Controller::make()->stub('AuthController.php')->filename('AuthController.php'),
                Controller::make()->stub('AdminUserController.php')->filename('AdminUserController.php'),
            ])
            ->epilogue([
                function (Publish $publish) {
                    $publish->confirm("Do not forget to add the provider and the guard to your config/auth.php file,\nas described in the README.md file.\nPress enter to continue.");
                },
            ]);
    }
}
