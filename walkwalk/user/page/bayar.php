<?php
$metode = new MetodePembayaran($conn);
$metode->getDataByID($_GET["a2"]);
$pembayaran = new Pembayaran($conn);
$pembayaran->getDataByID($_GET["a3"]);

$jenis = "Penginapan";
if ($pembayaran->tiket_id)
{
    $jenis = "Tiket Wisata";
}

?>

<div class="bg-white p-5">
    <div class="container">
        <h3 class="mb-3">Detail Pembayaran</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?php echo $metode->nama ?></td>
                </tr>
                <tr>
                    <th>Rekening</th>
                    <td><?php echo $metode->no_rek ?></td>
                </tr>
                <tr>
                    <th>Atas Nama</th>
                    <td><?php echo $metode->atas_nama ?></td>
                </tr>
                <tr>
                    <th>Jenis Pembayaran</th>
                    <td><?php echo $jenis ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp. <?php echo $pembayaran->total_harga ?></td>
                </tr>
            </tbody>
        </table>
        <p>Silahkan transfer ke nomor rekening tersebut dan kirim bukti bayar dalam 24 jam</p>
        <a href="?page=kirim-bukti-pembayaran" class="btn btn-success">Kirim Bukti Pembayaran</a>;
    </div>
</div>