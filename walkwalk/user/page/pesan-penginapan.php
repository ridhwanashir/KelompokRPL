<?php

$penginapan = new Penginapan($conn);
$penginapan->getDataByID($_GET["a1"]);

?>

<script>
<?php
$isCurrentHargaVarBuilded = false;
$kamar = new Kamar($conn);
$allkamar = $kamar->getAll();
$varbuilder = "let kamar = {";
foreach ($allkamar as $d)
{
    if ($d->penginapan_id == $penginapan->id)
    {
        $varbuilder .= "$d->id:$d->harga,";
        if ($isCurrentHargaVarBuilded) continue;
        echo "let hargaKamar = $d->harga\n";
        echo "let currentHarga = $d->harga\n";
        $hargaKamarPertama = $d->harga;
        $isCurrentHargaVarBuilded = true;
    }
}
$varbuilder .= "}";
echo $varbuilder;
?>

function calcHargaPerHari()
{
    currentHarga = hargaKamar*$("#durasi").val();
    console.log(currentHarga);
    $("#harga").html("Rp. "+(currentHarga))
    $("#total_harga").val(currentHarga)
}

function pilihKamar()
{
    hargaKamar = kamar[$("#pilih_kamar").val()];
    calcHargaPerHari();
}
</script>

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
        <form method="post" action="?process=pesan-penginapan">
            <p>Pilih Kamar</p>
            <input type="hidden" id="total_harga" name="total_harga" value="<?php echo $hargaKamarPertama; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["id"] ?>">
            <select onchange="pilihKamar()" name="kamar_id" id="pilih_kamar" class="form-control mb-3">
                <?php
                $kamar = new Kamar($conn);
                $allkamar = $kamar->getAll();
                foreach ($allkamar as $d)
                {
                    if ($d->penginapan_id == $penginapan->id)
                    {
                        echo '<option value="'.$d->id.'">'.$d->no_kamar.' - Rp. '.$d->harga.'</option>';
                    }
                }
                ?>
            </select>
            <p>Durasi (Hari)</p>
            <input id="durasi" name="durasi" onkeyup="calcHargaPerHari()" class="form-control mb-3" value="1" type="number">
            <p>Total Harga : <span class="fw-bold" id="harga">Rp. <?php echo $hargaKamarPertama; ?></span></p><p>Pilih Metode Pembayaran</p>
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
            <button class="btn bg-gradient text-white bg-success">Beli</button>
        </form>
    </div>

</div>