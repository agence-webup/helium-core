<?php

namespace Webup\LaravelHeliumCore\Commands;

use Illuminate\Foundation\Console\VendorPublishCommand;
use Webup\LaravelHeliumCore\Features\Feature;
use Webup\LaravelHeliumCore\Features\UserFeature;

class Publish extends VendorPublishCommand
{
    public $signature = 'helium:publish
                    {--existing : Publish and overwrite only the files that have already been published}
                    {--force : Overwrite any existing files}';

    public $description = 'Publish Helium features.';

    public array $features = [
        'Users' => UserFeature::class,
    ];

    public function handle(): int
    {
        $choice = $this->choice(
            'What do you want to publish?',
            array_merge(array_keys($this->features), ['All']),
            0
        );

        $features = ($choice === 'All')
            ? $this->features
            : [$this->features[$choice]];

        foreach ($features as $feature) {
            $feature::make()->handle($this);
            $this->info('Feature ' . $choice . ' published');
        }

        return self::SUCCESS;
    }

    public function publish(string $from, string $to)
    {
        $this->publishItem($from, $to);
    }

    // private function processMenu()
    // {
    //     $this->info("Étape : Menu");


    //     $this->menuIcon = $this->askWithCompletion("Icône à utiliser pour le menu : ( https://feathericons.com/ )", FeatherIcons::ICONS, "help-circle");

    //     $generatedMenu = $this->replaceInStub(file_get_contents(__DIR__ . '/stubs/crud/config/menu.stub'));

    //     $heliumConfigPath = config_path('helium.php');
    //     $heliumConfigFile = file_get_contents($heliumConfigPath);
    //     if (strpos($heliumConfigFile, '// {{ Helium Crud Menu }}') === false) {
    //         $this->error("Le fichier " . $heliumConfigPath . " ne possède pas la ligne `// {{ Helium Crud Menu }}` qui permet au crud generator de fonctionner");
    //         $this->comment("Veuillez ajouter manuellement le menu suivant :");
    //         $this->info($generatedMenu);
    //     } else {
    //         $this->comment("Ajout du menu    protected function formatProperties() au fichier `" . $heliumConfigPath . "`");
    //         $heliumConfigFile = str_replace('// {{ Helium Crud Menu }}', $generatedMenu, $heliumConfigFile);
    //         file_put_contents($heliumConfigPath, $heliumConfigFile);
    //     }
    //     $this->comment("");
    // }

}
