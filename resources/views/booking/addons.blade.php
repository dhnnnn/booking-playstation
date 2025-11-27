<div class="addons-section">
    <h2 class="section-title">Tambahan (Add-ons)</h2>
    <div class="addons-grid">
        @foreach($addons as $addon)
            <div class="addon-card">
                <img src="{{ asset('images/addons/' . $addon->image) }}" alt="{{ $addon->addons_title }}" class="addon-image">
                <div class="addon-info">
                    <div class="addon-name">{{ $addon->addons_title }}</div>
                    <div class="addon-price">Rp {{ number_format($addon->price, 0, ',', '.') }}</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" type="button" onclick="changeQuantity('{{ $addon->id }}', -1)">-</button>
                        <span class="quantity-display" id="qty-{{ $addon->id }}">0</span>
                        <button class="quantity-btn" type="button" onclick="changeQuantity('{{ $addon->id }}', 1)">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
