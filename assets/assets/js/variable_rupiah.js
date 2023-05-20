var diskon = document.getElementById('diskon');
diskon.addEventListener('keyup', function (e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    diskon.value = formatRupiah(this.value);
});

var jumlahbayar = document.getElementById('jumlahbayar');
jumlahbayar.addEventListener('keyup', function (e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    jumlahbayar.value = formatRupiah(this.value);
});

var grandtotal = document.getElementById('grandtotal');
grandtotal.addEventListener('keyup', function (e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    grandtotal.value = formatRupiah(this.value);
});