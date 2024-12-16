<?php

namespace App\Aplicacao\Console;

use App\Aplicacao\Support\CommandsHelper;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


/**
 * Tutorial: https://medium.com/@ariadoos/laravel-custom-file-stubs-ed32f046ea81
 */

class ClassGenerator extends Command
{
    /**
     * The nome and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:class {--tipo=} {--nome=} {--schema=} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'IST - Create a new Business|Repository|Trait|Interface class';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;


    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $tipo = $this->option('tipo');
        $nome = $this->option('nome');
        $schema = $this->option('schema');
        $model = $this->option('model');

        if ( !isset($tipo) || !isset($nome) || !isset($schema) || !isset($model)) {
            $this->error('Informe todos os parametros.');
            return;
        }


        $params = CommandsHelper::getStubsParametros($tipo, $nome, $schema, $model);

        $path = $params['CLASSE_ARQUIVO'];
        $stub = $params['STUB'];

        $this->criarDiretorios($params['NAMESPACE']);

        $contents = $this->getSourceFile($stub, $params);
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("Arquivo : {$path} criado.");
        } else {
            $this->info("Arquivo : {$path} já existe.");
        }
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile($stubPath, $stubVariables)
    {
        return $this->getStubContents($stubPath, $stubVariables);
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $replace = str_replace(['app/','/'],['App\\','\\'],$replace);
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function criarDiretorios($path)
    {
        $diretorios = explode('/',$path);
        $diretorio = '';
        foreach($diretorios as $pasta) {
            $diretorio .= $pasta.'/';
            if (!$this->files->isDirectory($diretorio)) {
                $this->files->makeDirectory($diretorio, 0777, true, true);
            }
        }

        return $diretorio;
    }
}
