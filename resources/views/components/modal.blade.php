<div class="modal fade" id="{{ $target }}" tabindex="-1" aria-labelledby="{{ $target }}Label" data-backdrop="static" data-keyboard="true" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $target }}Label">{{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
