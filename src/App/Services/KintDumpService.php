<?php

namespace parzival42codes\LaravelKint\App\Services;

use Illuminate\Support\Facades\Log;
use Kint\Kint;
use Spatie\Backtrace\Backtrace;
use function Pest\Laravel\followingRedirects;

class KintDumpService
{
    private static array $dumpCollection = [
        'default' => [], 'debugbar' => [], 'log' => [],
    ];
    private string $dumpCollectionKey = 'default';
    private string $dumpCollectionKeyOriginal = 'default';

    public function __construct()
    {

    }

    public function dump(mixed $dump, array $context = []): KintDumpService
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

    public function render(): KintDumpService
    {
        $this->dumpCollectionKey = $this->dumpCollectionKeyOriginal;
        echo $this->output();
        return $this;
    }

    public function output(): string
    {
        return implode('', $this->outputAsArray());
    }

    public function outputAsArray(): array
    {
        $renderArray = [];

        foreach (self::$dumpCollection[$this->dumpCollectionKey] as $item) {
            $renderArray[] = $this->parseDumpView($item);
        }

        return $renderArray;
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
        $this->dumpCollectionKeyOriginal = $dumpCollectionKey;
        $this->dumpCollectionKey = $dumpCollectionKey;
        return $this;
    }

    public function debugbar(): KintDumpService
    {
        $this->dumpCollectionKey = 'debugbar';
        return $this;
    }

    public function log(): KintDumpService
    {
        $this->dumpCollectionKey = 'log';
        return $this;
    }

    //    public function logWrite(array|null $context = [], string $type = 'debug'): KintDumpService
    //    {
    //        foreach (self::$dumpCollection['log'] as $log) {
    //            Log::channel('kint')
    //                ->$type(Kint::dump($dump);
    //            ($value), $context);
    //}
    //
    //        return $this;
    //    }

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
