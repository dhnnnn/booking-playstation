<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    
    <div class="container">
        <header>
            @include('admin.addons.header')
        </header>

        <main>
            <section class="widget recent-bookings">
                    <div class="">
                        <h3 class="widget-title">Barang</h3>
                        <a href="{{url('/addons/create')}}"><button>Tambah</button></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Add Ons ID</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($addons as $addon => $addons)
                            <tr>
                                <td>{{$addons->id}}</td>
                                <td>
                                    <img width="80" src="{{ asset('images/addons/' . $addons->image) }}" alt="">
                                </td>
                                <td>{{$addons->addons_title}}</td>
                                <td>
                                    <div class="stock-edit-wrapper">
                                        <span class="stock-display" id="stock-display-{{$addons->id}}">{{$addons->stock}}</span>
                                        <button class="icon-btn" onclick="enableStockEdit('{{$addons->id}}')" id="edit-btn-{{$addons->id}}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <div class="stock-edit-form" id="stock-edit-{{$addons->id}}" style="display: none;">
                                            <input type="number" class="stock-input" id="stock-input-{{$addons->id}}" value="{{$addons->stock}}" min="0">
                                            <button class="icon-btn save-btn" onclick="saveStock('{{$addons->id}}')">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button class="icon-btn cancel-btn" onclick="cancelStockEdit('{{$addons->id}}', '{{$addons->stock}}')">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>Rp. {{number_format($addons->price, 0, ',','.')}}</td>
                                <td>
                                    <a href="{{url('addons/update', $addons->id)}}"><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                                    <a href="{{url('addons/delete', $addons->id)}}"><button class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
        </main>
    </div>
    
    <x-notify::notify />
    @notifyJs




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function enableStockEdit(addonId) {
            // Hide display and show edit form
            document.getElementById('stock-display-' + addonId).style.display = 'none';
            document.getElementById('edit-btn-' + addonId).style.display = 'none';
            document.getElementById('stock-edit-' + addonId).style.display = 'flex';
            
            // Focus on input
            document.getElementById('stock-input-' + addonId).focus();
            document.getElementById('stock-input-' + addonId).select();
        }

        function cancelStockEdit(addonId, originalStock) {
            // Reset input to original value
            document.getElementById('stock-input-' + addonId).value = originalStock;
            
            // Hide edit form and show display
            document.getElementById('stock-edit-' + addonId).style.display = 'none';
            document.getElementById('stock-display-' + addonId).style.display = 'inline';
            document.getElementById('edit-btn-' + addonId).style.display = 'inline-block';
        }

        function saveStock(addonId) {
            const newStock = document.getElementById('stock-input-' + addonId).value;
            
            // Validate
            if (newStock < 0) {
                alert('Stock tidak boleh negatif');
                return;
            }

            // Send AJAX request
            $.ajax({
                url: '/addons/update-stock/' + addonId,
                method: 'POST',
                data: {
                    stock: newStock,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Reload page to show notification
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal update stock');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Terjadi kesalahan saat update stock');
                }
            });
        }

        // Allow Enter key to save
        $(document).on('keypress', '.stock-input', function(e) {
            if (e.which === 13) { // Enter key
                const addonId = this.id.replace('stock-input-', '');
                saveStock(addonId);
            }
        });

        // Allow Escape key to cancel
        $(document).on('keydown', '.stock-input', function(e) {
            if (e.which === 27) { // Escape key
                const addonId = this.id.replace('stock-input-', '');
                const originalStock = document.getElementById('stock-display-' + addonId).textContent;
                cancelStockEdit(addonId, originalStock);
            }
        });
    </script>

</body>
</html>
