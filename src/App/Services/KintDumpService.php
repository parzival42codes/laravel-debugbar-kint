<?php

namespace parzival42codes\LaravelKint\App\Services;

use Kint\Kint;

class KintDumpService
{
    private static array $dumpCollection = [];
    private string $dumpCollectionKey = 'default';

    public function __construct()
    {

    }

    public function dump(mixed $dump): KintDumpService
    {
        Kint::$return = true;
        self::$dumpCollection[$this->dumpCollectionKey][] = Kint::dump($dump);
        Kint::$return = false;

        return $this;
    }

    public function render(string|null $dumpCollectionKey = null): KintDumpService
    {
        if (! $dumpCollectionKey) {
            echo implode('', self::$dumpCollection[$this->dumpCollectionKey]);
        } else {
            echo implode('', self::$dumpCollection[$dumpCollectionKey]);
        }

        return $this;
    }

    public function output(string|null $dumpCollectionKey = null): string
    {
        return implode('', $this->outputAsArray($dumpCollectionKey));
    }

    public function outputAsArray(string|null $dumpCollectionKey = null): array
    {
        if (! $dumpCollectionKey) {
            return self::$dumpCollection[$this->dumpCollectionKey];
        } else {
            return self::$dumpCollection[$dumpCollectionKey];
        }
    }

    public function getCount(): int
    {
        return count(self::$dumpCollection[$this->dumpCollectionKey] ?? []);
    }

    public function die(): void
    {
        die();
    }

    public function collection(string|null $dumpCollectionKey = 'default'): KintDumpService
    {
        $this->dumpCollectionKey = $dumpCollectionKey;
        return $this;
    }

    public function debugbar(): KintDumpService
    {
        $this->dumpCollectionKey = 'debugbar';
        return $this;
    }

}
