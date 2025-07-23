<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" action="{{ $route }}">
        <div class="input-group w-auto mr-2">
            <input type="text" name="cari" class="form-control" placeholder="Cari..." value="{{ old('cari', request('cari')) }}">
            <span class="input-group-append">
                <button type="submit" class="btn btn-info">
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </button>
            </span>
        </div>
    </form>
    {{ $slot }}
</div>
