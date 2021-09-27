<?php
namespace rohsyl\LaravelAdvancedQueryFilter\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CreateAdvancedQueryFilterCommand.
 *
 * @author rohs
 */
class CreateAdvancedQueryFilterCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new advanced query filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Advanced Query Filter';

    protected function getStub()
    {
        $stub = '/stubs/advanced_query_filter.stub';

        if ($this->hasArgument('model') && ! empty($this->getModelInput())) {
            $stub = '/stubs/advanced_query_filter.model.stub';
        }

        return __DIR__.$stub;
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyModelNamespace'],
            [$this->getNamespace($name), $this->getModelNamespace()],
            $stub
        );

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(
            ['DummyClass', 'DummyModel'],
            [$class, $this->getModelClassName()],
            $stub
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Extensions\Filters';
    }

    public function getModelInput()
    {
        $name = trim($this->argument('model'));
        $name = str_replace('/', '\\', $name);

        return $name;
    }

    protected function getModelNamespace()
    {
        $model = $this->getModelInput();

        return $this->rootNamespace().$this->getNamespace($model);
    }

    protected function getModelClassName()
    {
        $model = $this->getModelInput();

        return str_replace($this->getNamespace($model).'\\', '', $model);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['model', InputArgument::OPTIONAL, 'The model for this query filter'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if it already exists'],
        ];
    }
}
