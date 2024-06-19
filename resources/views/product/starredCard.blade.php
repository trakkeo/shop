<div class="card">
    @if($starredProduct->getPicture())
    <div class="position-relative">
        <img src="{{ $starredProduct->getPicture()->getImageUrl(360, 230) }}" alt="" class="w-100">
        <span class="position-absolute top-0 end-0 m-2" style="font-size: 3em; color: #b347b5;">★</span>
    </div>
    @else
        <img src="/empty.jpg" alt="" class="w-100">
    @endif
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('product.show', ['slug' => $starredProduct->getSlug(), 'product' => $starredProduct]) }}">{{ $starredProduct->name }}</a>
        </h5>
        <p class="card-text">{{ $starredProduct->cpu }} - {{ $starredProduct->memory }} GO - {{ $starredProduct->screen_size }}"</p>
        <div class="text-primary fw-bold" style="font-size: 1.4rem;">
            {{ number_format($starredProduct->price, thousands_separator: ' ') }} €
        </div>
    </div>
</div>
