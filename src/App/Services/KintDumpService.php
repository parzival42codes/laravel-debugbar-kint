<?php

namespace parzival42codes\LaravelKint\App\Services;

use Illuminate\Support\Facades\Log;
use Kint\Kint;
use Spatie\Backtrace\Backtrace;

class KintDumpService
{
    private static array $dumpCollection = [
        'default' => [], 'debugbar' => [], 'log' => [],
    ];

    private string $dumpCollectionKey = 'default';

    private string $dumpCollectionKeyOriginal = 'default';

    /**
     * Records the dump and, if necessary, a context as an array.
     *
     * @param  mixed  $dump
     * @param  array  $context
     * @return $this
     */
    public function dump(mixed $dump, array $context = []): self
    {
        if ($this->dumpCollectionKey === 'log') {
            Kint::$enabled_mode = Kint::MODE_TEXT;
        }

        $backtrace = Backtrace::create()
            ->offset(1)
            ->limit(1)
            ->frames();

        $file = '';
        $line = '';
        if ($backtrace[0]) {
            $file = $backtrace[0]->file;
            $line = $backtrace[0]->lineNumber;
        }

        $title = $context['_'] ?? '';
        unset($context['_']);

        Kint::$return = true;
        self::$dumpCollection[$this->dumpCollectionKey][] = [
            'content' => Kint::dump($dump), 'context' => $context, 'title' => $title, 'file' => $file, 'line' => $line,
        ];
        Kint::$return = false;

        if ($this->dumpCollectionKey === 'log') {
            Kint::$enabled_mode = true;
        }

        return $this;
    }

    /**
     * Returns the output as a string for the current dump collection.
     *
     * @return $this
     */
    public function render(): self
    {
        $this->dumpCollectionKey = $this->dumpCollectionKeyOriginal;
        echo $this->output();

        return $this;
    }

    /**
     * Returns the output as a string for the current dump collection.
     *
     * @return string
     */
    public function output(): string
    {
        return implode('', $this->outputAsArray());
    }

    /**
     * Returns the array for the current dump collection.
     *
     * @return array
     */
    public function outputAsArray(): array
    {
        $renderArray = [];

        foreach (self::$dumpCollection[$this->dumpCollectionKey] as $item) {
            $renderArray[] = $this->parseDumpView($item);
        }

        return $renderArray;
    }

    /**
     * Returns the number of entries in the array for the current dump collection
     *
     * @return int
     */
    public function getCount(): int
    {
        return count(self::$dumpCollection[$this->dumpCollectionKey] ?? []);
    }

    /**
     * Ends the script run / breaks off.
     *
     * @return void
     */
    public function die(): void
    {
        exit();
    }

    /**
     * Sets the current dump collection, any number can be created.
     *
     * @param  string  $dumpCollectionKey
     * @return $this
     */
    public function collection(string $dumpCollectionKey = 'default'): self
    {
        $this->dumpCollectionKeyOriginal = $dumpCollectionKey;
        $this->dumpCollectionKey = $dumpCollectionKey;

        return $this;
    }

    /**
     * Set the Collection to 'debugbar'
     *
     * @return $this
     */
    public function debugbar(): self
    {
        $this->dumpCollectionKey = 'debugbar';

        return $this;
    }

    /**
     * Set the Collection to 'log'
     *
     * @return $this
     */
    public function log(): self
    {
        $this->dumpCollectionKey = 'log';

        return $this;
    }

    /**
     * Writes the log
     *
     * @param  string  $type
     * @return $this
     */
    public function logWrite(string $type = 'debug'): self
    {
        foreach (self::$dumpCollection['log'] as $item) {
            Log::channel(config('kint.log'))
                ->$type($item['content'].PHP_EOL.$item['file'].' # '.$item['line'], $item['context']);
        }

        return $this;
    }

    /**
     * Dump to String Helper
     *
     * @param  array  $item
     * @return string
     */
    private function parseDumpView(array $item): string
    {
        if ($item['title'] || $item['context']) {
            return '<div>'.$item['content'].'<span style="font-size: smaller;"><details><summary>'.$item['title'].' - Context @ '.$item['file'].' # '.$item['line'].' </summary>'.var_export($item['context'],
                    true).' </details></span></div>';
        } else {
            return '<div>'.$item['content'].'<span style="font-size: smaller;">@ '.$item['file'].' # '.$item['line'].'</span></div>';
        }
    }
}
