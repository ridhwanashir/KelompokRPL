<?php
// penginapan.php berisi interface untuk fungsi pesan penginapan
$penginapan = new Penginapan($conn);
$penginapan->getDataByID($_GET["a1"]); // mengambil data penginapan berdasarkan ID

?>

<div class="bg-white p-5">
    <div class="container-sm">
        <h3 class="mb-3">Pesan Penginapan</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama Penginapan</th>
                    <td><?php echo $penginapan->nama_tempat?></td>
                </tr>
                <tr>
                    <th>Alamat Penginapan</th>
                    <td><?php echo $penginapan->alamat?></td>
                </tr>
            </tbody>
        </table>
        <p>Pilih Kamar</p>
        <select class="form-control mb-3"> <!-- option select form -->
            <?php
            $kamar = new Kamar($conn);
            $allkamar = $kamar->getAll(); // mengambil seluruh data kamar berdasarkan penginapannya
            foreach ($allkamar as $d) // menampilkan kamar
            {
                if ($d->penginapan_id == $penginapan->id)
                {
                    echo '<option value="'.$d->id.'">'.$d->no_kamar.' - Rp. '.$d->harga.'</option>';
                }
            }
            ?>
        </select>
        <button class="btn bg-gradient text-white bg-success">Beli</button>
    </div>

</div>