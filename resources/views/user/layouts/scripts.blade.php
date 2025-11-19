<!-- jQuery -->
<script src="{{ asset('user/js/jquery-1.11.0.min.js') }}"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script src="{{ asset('user/js/plugins.js') }}"></script>
<script src="{{ asset('user/js/script.js') }}"></script>

<!-- CSRF Token Setup -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>