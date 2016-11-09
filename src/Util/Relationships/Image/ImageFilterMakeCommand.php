<?php

namespace BW\Util\Relationships\Image;

use Illuminate\Console\GeneratorCommand;

class ImageFilterMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bw:make-imagefilter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria uma class de filtro de imagem';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Image Filter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/image-filter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters';
    }
}
