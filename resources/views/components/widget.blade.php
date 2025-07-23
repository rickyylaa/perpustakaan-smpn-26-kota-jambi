<div class="col-lg-3 col-6">
    <div class="small-box bg-{{ $color }}">
        <div class="inner">
            <h4>{{ $slot }}</h4>
            <p>{{ $title }}</p>
        </div>
        <div class="icon">
            <i class="fa-sharp fa-solid {{ $icon }}" style="font-size: 4rem; color: white; top: 1.2rem;"></i>
        </div>
        <a href="{{ $link }}" class="small-box-footer">
            Info Lebih Lanjut <i class="fa-sharp fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
