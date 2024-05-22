<div class="card">
    @if($product->getPicture())
        <img src="{{ $product->getPicture()->getImageUrl(360, 230) }}" alt="" class="w-100">
    @else
        <img src="/empty.jpg" alt="" class="w-100">
    @endif
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('product.show', ['slug' => $product->getSlug(), 'product' => $product]) }}">{{ $product->name }}</a>
        </h5>
        <p class="card-text">{{ $product->cpu }} - {{ $product->memory }} GO - {{ $product->screen_size }}"</p>
        <div class="text-primary fw-bold" style="font-size: 1.4rem;">
            {{ number_format($product->price, thousands_separator: ' ') }} €
        </div>
    </div>
</div>
