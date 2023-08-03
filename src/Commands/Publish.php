<?php

namespace Webup\LaravelHeliumCore\Commands;

use Illuminate\Foundation\Console\VendorPublishCommand;
use Symfony\Component\Finder\SplFileInfo;
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
            $this->info('Feature '.$choice.' published');
        }

        return self::SUCCESS;
    }

    /**
     * @return string[]
     */
    public function getAllFiles(string $path)
    {
        return array_map(function (SplFileInfo $file) {
            $file->getPathname();
        }, $this->files->allFiles($path));
    }

    public function publish(string $content, string $to)
    {
        if ((! $this->option('existing') && (! $this->files->exists($to) || $this->option('force')))
            || ($this->option('existing') && $this->files->exists($to))) {
            $this->createParentDirectory(dirname($to));

            $this->files->put($to, $content);

            $this->comment("Writing to $to.");
        } else {
            if ($this->option('existing')) {
                $this->components->twoColumnDetail(sprintf(
                    'File [%s] does not exist',
                    str_replace(base_path().'/', '', $to),
                ), '<fg=yellow;options=bold>SKIPPED</>');
            } else {
                $this->components->twoColumnDetail(sprintf(
                    'File [%s] already exists',
                    str_replace(base_path().'/', '', realpath($to)),
                ), '<fg=yellow;options=bold>SKIPPED</>');
            }
        }
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
