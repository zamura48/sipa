@if (session('success'))
    <script>
        notif_success('{{ session('success') }}')
    </script>
@endif

@if (session('error'))
    <script>
        notif_error('{{ session('error') }}')
    </script>
@endif
