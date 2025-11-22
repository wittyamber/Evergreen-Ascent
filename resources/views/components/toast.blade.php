@if (session('status') || session('error'))
    @php
        $type = session('status') ? 'success' : 'error';
        $message = session('status') ?? session('error');
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Toastify({
                text: "{{ $message }}",
                duration: 5000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "{{ $type === 'success' ? '#2F5233' : '#B91C1C' }}", // Evergreen for success, Red for error
                },
            }).showToast();
        });
    </script>
@endif