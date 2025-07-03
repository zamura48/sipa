<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran</title>
</head>

<body>
    <form action="{{ '/midtrans/callback' }}" method="POST" id="form-success">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
        <input type="hidden" name="bank" id="bank">
        <input type="hidden" name="pdf" id="pdf">
        <input type="hidden" name="payment_type" id="payment_type">
        <input type="hidden" name="transaction_id" id="transaction_id">
        <input type="hidden" name="va_number" id="va_number">
        <input type="hidden" name="transaction_status" id="transaction_status">
    </form>
    <script src="<?= asset('assets/lib/sb_admin') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                $("#bank").val(result['va_numbers'][0]['bank']);
                $("#va_number").val(result['va_numbers'][0]['va_number']);
                $("#pdf").val(result.pdf_url);
                $("#payment_type").val(result.payment_type);
                $("#transaction_id").val(result.transaction_id);
                $("#transaction_status").val(result.transaction_status);

                $("#form-success").submit();

                alert("Pembayaran berhasil!");
                // kirim data ke backend jika perlu
            },
            onPending: function(result) {
                console.log('pending', result);

                $("#bank").val(result['va_numbers'][0]['bank']);
                $("#va_number").val(result['va_numbers'][0]['va_number']);
                $("#pdf").val(result.pdf_url);
                $("#payment_type").val(result.payment_type);
                $("#transaction_id").val(result.transaction_id);
                $("#transaction_status").val(result.transaction_status);

                alert("Menunggu pembayaran...");
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
            },
            onClose: function() {
                alert('Kamu menutup jendela pembayaran!');
                window.location.href = '{{ route('walmur.tagihan.index') }}';
                // Aksi lain jika perlu: redirect, tampilkan pesan, dll.
            }
        });
    </script>
</body>

</html>
