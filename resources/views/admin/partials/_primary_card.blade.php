<div class="col-xl-3 col-md-6 mb-4">
    @if(isset($clickable) && $clickable)
        <a href="{{ route($route) }}" class="text-decoration-none">
    @endif
        <div class="card border-left-{{ $color }} shadow h-100 py-2 {{ isset($clickable) && $clickable ? 'clickable' : '' }}">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">
                            {{ $title }}
                        </div>
                        <div class="counter h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="{{ $icon }} text-{{ $color }}"></i>
                    </div>
                </div>
            </div>
        </div>
    @if(isset($clickable) && $clickable)
        </a>
    @endif
</div> 