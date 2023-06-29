<?php

namespace Webup\LaravelHeliumCore\Features;

use Webup\LaravelHeliumCore\Commands\Publish;
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
            ->migrations([
                Migration::make()->filename('create_helium_users_table.php'),
                Migration::make()->filename('create_helium_default_user.php'),
            ])
            ->routes(Route::make()->filename('users.php'))
            ->resources(
                Resource::make()
                    ->pages('users')
            )
            ->models([
                Model::make()->filename('HeliumUser.php'),
            ])
            ->controllers([
                Controller::make()->filename('AuthController.php'),
                Controller::make()->filename('ForgotPasswordController.php'),
                Controller::make()->filename('ResetPasswordController.php'),
                // Controller::make()->filename('UserController.php'),
            ])
            ->additionalSteps([
                function (Publish $publish) {
                    $publish->confirm('
                        Do not forget to add the provider and the guard to your config/auth.php file,
                        as described in the README.md file. Press enter to continue.
                    ');
                },
            ]);
    }
}
