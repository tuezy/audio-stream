<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Mime\Encoder\IdnAddressEncoder;

class kodingRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'koding:repository {name : Class (singular)} {--m} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    protected function model($name)
    {
        file_put_contents(app_path("Models/{$name}.php"), $this->replace($name, 'model'));
        $this->info("generate Model: ". app_path("Models/{$name}.php"));
    }

    protected function repository($name, $type = 'repository')
    {
        $pluralName = ucfirst(Str::plural($name));

        $folder = app_path("/Repository/{$pluralName}");

        if(!File::exists($folder)){
            File::makeDirectory($folder, 0777, true);
        }
        switch ($type){
            case 'repository':
                $file ="{$name}Repository";
                break;
            case 'repository-contract':
                $file = "{$name}RepositoryContract";
                break;
            case 'repository-cache':
                $file = "{$name}RepositoryCache";
                break;
        }

        $phpFile = $folder. "/{$file}.php";

        file_put_contents($phpFile, $this->replace($name, $type));

        $this->info("generate: ". $phpFile);
        return 'App\\Repository\\'.$pluralName.'\\'.$file;
    }

    protected function datatables($name)
    {
        file_put_contents(app_path("/Datatables/{$name}Tables.php"), $this->replace($name,'datatables'));

        $this->info("generate: ". app_path("/Datatables/{$name}Tables.php"));
    }

    protected function migration($name)
    {
        $name = strtolower($name);

        $time = date('Y_m_d_').time();

        $file = database_path("/migrations/{$time}_create_{$name}_tables.php");
        file_put_contents($file, $this->replace($name,'migration'));

        $this->info("generate: ". $file);
    }

    protected function controllerDashboards($name)
    {
        file_put_contents(app_path("/Http/Controllers/Dashboard/{$name}Controller.php"), $this->replace($name,'controller-dashboard'));

        File::copyDirectory(__DIR__ ."/stub/dashboard-page",resource_path('views/dashboard/pages/'.strtolower(Str::plural($name))));

        $this->info("generate: ". app_path("/Http/Controllers/Dashboard/{$name}Controller.php"));
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if(File::exists(app_path("Models/{$name}.php"))  && !$this->option('force') ){
            $this->error("Already exist. Replace with --force");
            return;
        }

        $this->model($name);

        $repositoryContract = $this->repository($name, 'repository-contract');
        $repository = $this->repository($name, 'repository');
        $repositoryCache = $this->repository($name, 'repository-cache');
        $this->datatables($name);
        $this->controllerDashboards($name);

        if($this->option('m')){
            $this->migration($name);
        }

        $repositoryMapper =
            array_merge(
                json_decode(file_get_contents(base_path('metadata.json')), true),
                [
                    $repositoryContract => $repositoryCache
                ]
            );
        file_put_contents(base_path('metadata.json'), json_encode($repositoryMapper));
    }

    protected function replace($name,$type){
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePluralUpperCase}}',
                '{{modelNameSingularUpperCase}}',
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name),
                ucfirst(Str::plural($name)),
                ucfirst($name)
            ],
            $this->getStub($type)
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(app_path("Console/Commands/stub/$type.stub"));
    }
}
