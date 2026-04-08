<h2>Pinjam Alat</h2>

<p><?= $alat['nama_alat']; ?></p>

<form action="/pinjam/simpan" method="post">
    <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">

    <input type="text" name="nama" placeholder="Nama Peminjam"><br>
    <input type="number" name="jumlah" placeholder="Jumlah"><br>

    <button type="submit">Pinjam</button>
</form>