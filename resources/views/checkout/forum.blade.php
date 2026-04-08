@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout Pesanan</h2>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.proses') }}" method="POST">
        @csrf

        <div>
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="">-- Pilih Metode --</option>
                <option value="mandiri_va">Virtual Account Mandiri</option>
                <option value="Tunai">Tunai</option>
            </select>
        </div>

        <br>
        <button type="submit">Checkout Sekarang</button>
    </form>
</div>
@endsection
