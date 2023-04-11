<?php

namespace parzival42codes\LaravelDebugbarKint\App\Debugbar\DataCollector;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;
use parzival42codes\LaravelDebugbarKint\App\Services\KintService;

class KintCollector extends DataCollector implements Renderable
{
    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function collect()
    {
        $kint = KintService::getKint();

        return [
            'nb_kint' => count($kint),
            'kint' => $kint,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'kint';
    }

    /**
     * @inheritDoc
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
