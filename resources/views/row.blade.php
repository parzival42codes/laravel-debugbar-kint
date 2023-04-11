<div class="laravel-debugbar-vardumper">
    <div class="laravel-debugbar-vardumper-link">
        <span class="btn btn-primary btn--large" data-bs-toggle="modal"
                data-id="{{ $id }}"
                data-name="{{ $name }}"
                data-bs-target="#modal{{ $modalId }}">{!! $button !!} {!! $title !!}</span>
    </div>
    <div class="laravel-debugbar-vardumper-file">{!! $file !!}</div>
    <div class="laravel-debugbar-vardumper-line">{{ $line }}</div>
    <div class="laravel-debugbar-vardumper-backtrace">
        <span class="btn btn-primary" data-bs-toggle="modal"
              data-id="{{ $id }}Backtrace"
              data-name="{{ $name }}Backtrace"
              data-bs-target="#modal{{ $modalId }}Backtrace">
            Backtrace
        </span>
    </div>
</div>
