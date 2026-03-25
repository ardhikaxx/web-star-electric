<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-house me-1"></i>
                Home
            </a>
        </li>
        @if(isset($links))
            @foreach($links as $link)
                @if(isset($link['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active">{{ $link['label'] }}</li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>