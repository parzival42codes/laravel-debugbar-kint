<div class="modal fade" id="modal{{ $idModal }}" tabindex="-1" aria-labelledby="{{ $idModal }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? 'Vardump' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="laravel-debugbar-vardumper" style="flex-direction: column;">
                    <div class="laravel-debugbar-vardumper-localisation">
                        {!! $file !!} - {{ $line }}
                    </div>
                    <hr/>
                    <div class="laravel-debugbar-vardumper-dump">{!! $content !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
