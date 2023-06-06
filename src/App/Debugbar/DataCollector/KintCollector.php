<?php

namespace parzival42codes\LaravelKint\App\Debugbar\DataCollector;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;

class KintCollector extends DataCollector implements Renderable
{
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function collect()
    {
        $kint = kd()->debugbar();

        return [
            'nb_kint' => $kint->getCount(),
            'kint' => $kint->outputAsArray(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'kint';
    }

    /**
     * {@inheritDoc}
     */
    public function getWidgets()
    {
        return [
            $this->getName() => [
                'icon' => 'archive',
                'widget' => 'PhpDebugBar.Widgets.ListWidget',
                'map' => $this->getName().'.kint',
                'default' => '[]',
            ],
            $this->getName().':badge' => [
                'map' => $this->getName().'.nb_kint',
                'default' => 0,
            ],
        ];
    }
}
