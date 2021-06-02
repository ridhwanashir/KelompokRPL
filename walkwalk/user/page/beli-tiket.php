<?php

$wisata = new TempatWisata($conn);
$wisata->getDataByID($_GET["a1"]);

?>

<script>
function calcHargaJumlahTiket()
{
    let hargaPerTiket = <?php  echo $wisata->harga?>;
    let a = $("#jumlah_tiket").val();

    $("#harga").html("Rp. "+(a*hargaPerTiket));
    $("#total_harga").val(a*hargaPerTiket);
}
</script>

<div class="bg-white p-5">
    <div class="container-sm">
        <h3 class="mb-3">Beli Tiket</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama Tempat</th>
                    <td><?php echo $wisata->nama_tempat?></td>
                </tr>
                <tr>
                    <th>Alamat Tempat</th>
                    <td><?php echo $wisata->alamat?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp. <?php echo $wisata->harga?></td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="?process=beli-tiket">
            <p>Jumlah Tiket</p>
            <input type="hidden" name="wisata_id" value="<?php echo $wisata->id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["id"] ?>">
            <input type="hidden" id="total_harga" name="total_harga" value="<?php echo $wisata->harga ?>">
            <input name="total_tiket" id="jumlah_tiket" onchange="calcHargaJumlahTiket()" onkeyup="calcHargaJumlahTiket()" class="form-control mb-3" value="1" type="number">
            <p>Total : <span class="fw-bold" id="harga">Rp. <?php echo $wisata->harga?></span> </p>
            <p>Pilih Metode Pembayaran</p>
            <select class="form-control mb-3" name="metode_pembayaran">
                <?php
                $metode = new MetodePembayaran($conn);
                $metodes = $metode->getAll();
                foreach ($metodes as $d)
                {
                    echo '<option value="'.$d->id.'">'.$d->nama.'</option>';
                }
                ?>
            </select>
            <button type="submit" class="btn bg-gradient text-white bg-success">Beli</button>
        </form>
    </div>

</div>