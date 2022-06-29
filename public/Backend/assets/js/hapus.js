function konfirmasiHapusKonten(event) {
    jawab = true;
    jawab = confirm("Yakin ingin menghapus? Data akan hilang permanen!");
    if (jawab) {
        // alert('Lanjut.')
        return true;
    } else {
        event.preventDefault();
        return false;
    }
}
