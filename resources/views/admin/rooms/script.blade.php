<script>
let cropper;
const photoInput = document.getElementById('photo');
const preview = document.getElementById('preview');
const cropButton = document.getElementById('cropButton');
const croppedImageInput = document.getElementById('croppedImage');

// Saat user pilih file
photoInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            cropButton.style.display = 'inline-block';

            // Hancurkan cropper lama jika ada
            if (cropper) cropper.destroy();

            // Inisialisasi cropper baru
            cropper = new Cropper(preview, {
                aspectRatio: 1, // 1:1
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
            });
        };

        reader.readAsDataURL(file);
    }
});

// Saat klik tombol crop
cropButton.addEventListener('click', () => {
    if (cropper) {
        const canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500,
        });

        // Tampilkan hasil crop di preview
        preview.src = canvas.toDataURL();
        cropper.destroy();
        cropper = null;
        preview.src = canvas.toDataURL();
        cropper.destroy();
        cropper = null;

        // Simpan base64 hasil crop ke input hidden
        croppedImageInput.value = canvas.toDataURL();
    }
});

</script>
