@if (session('success'))
    <script>
        console.log('tes');

        notif_success('{{ session('success') }}')
    </script>
@endif

@if (session('error'))
    <script>
        notif_error('{{ session('error') }}')
    </script>
@endif
