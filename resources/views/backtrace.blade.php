<div class="modal fade" id="modal{{ $idModal }}Backtrace" tabindex="-1" aria-labelledby="{{ $idModal }}Backtrace" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Backtrace</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body laravel-debugbar-modal-backtrace">
                <table class="table">
                    <tr>
                        <th>
                            Class
                        </th>
                        <th>
                            Method
                        </th>
                        <th>
                            File
                        </th>
                        <th>
                            Line
                        </th>
                    </tr>
                    {!! $table !!}}
                </table>
            </div>
        </div>
    </div>
</div>


