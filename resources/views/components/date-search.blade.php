<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" action="{{ route($route) }}">
        <div class="input-group w-auto mr-2">
            <input type="text" name="date" id="created_at" class="form-control" value="{{ request('date') }}" placeholder="Tanggal...">
            <span class="input-group-append">
                <button type="submit" class="btn btn-info">
                    <i class="fa-sharp fa-solid fa-calendar"></i>
                </button>
            </span>
        </div>
    </form>
    <a href="javascript:;" target="_blank" class="btn btn-primary" id="exportpdf">
        Export
    </a>
</div>
