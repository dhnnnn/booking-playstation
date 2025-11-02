@include('home.script')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const imgBtns = document.querySelectorAll('.img-select a');
        const imgShowcase = document.querySelector('.img-showcase');
        const imgItems = document.querySelectorAll('.img-showcase img');
        let imgId = 1;

        imgBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            imgId = btn.dataset.id;
            slideImage();
        });
        });

        function slideImage() {
            const displayWidth = imgItems[0].clientWidth;
            imgShowcase.style.transform = `translateX(${-(imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
        window.addEventListener('load', slideImage);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
