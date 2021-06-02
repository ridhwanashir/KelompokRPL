<?php
$pembayaran = new Pembayaran($conn);
$userPembayaran = $pembayaran->getPembayaranByUserId($_SESSION["id"]);

?>

<div class="bg-white p-5">
    <div class="container-sm">
        <?php
        if (isset($_GET["status"]))
        {
            switch ($_GET["status"])
            {
                case "success-kirim":
                    echo '<div class="alert alert-success" role="alert">Berhasil mengirim foto bukti</div>';
                break;
            }
        }
        ?>

        <h3 class="mb-3">Kirim Bukti Pembayaran</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($userPembayaran as $d)
                {
                    if ($d->status != StatusPembayaran::$foto_belum_dikirim) continue;
                    $nama = "";
                    if ($d->tiket_id)
                    {
                        $tiket = new TiketWisata($conn);
                        $tiket->getDataByID($d->tiket_id);
                        $wisata = new TempatWisata($conn);
                        $wisata->getDataByID($tiket->wisata_id);
                        $nama = $wisata->nama_tempat;
                    }
                    elseif ($d->book_id)
                    {
                        $pespeng = new PesanPenginapan($conn);
                        $pespeng->getDataByID($d->book_id);
                        $kamar = new Kamar($conn);
                        $kamar->getDataByID($pespeng->kamar_id);
                        $penginapan = new Penginapan($conn);
                        $penginapan->getDataByID($kamar->penginapan_id);
                        $nama = $penginapan->nama_tempat;
                    }

                    echo '<tr>
                    <td>'.$nama.'</td>
                    <td>'.((isset($d->tiket_id)) ? "Tiket Wisata":"Penginapan").'</td>
                    <td>Rp. '.$d->total_harga.'</td>
                    <td>
                        <a href="?page=kirim-foto-bukti&a1='.$d->id.'" class="btn bg-success bg-gradient text-white">Kirim Foto</a>
                        <a href="?process=batal-pembayaran&a1='.$d->id.'" class="btn bg-danger bg-gradient text-white">Batal</a>
                    </td>
                </tr>';
                }
                ?>
                
            </tbody>
        </table>
    </div>
</div>