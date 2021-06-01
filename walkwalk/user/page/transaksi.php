<?php
$pembayaran = new Pembayaran($conn);
$userPembayaran = $pembayaran->getPembayaranByUserId($_SESSION["id"]);

?>

<div class="bg-white p-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Pembayaran</th>
                <th>Total Harga</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
                foreach ($userPembayaran as $d)
                {
                    //if ($d->status != StatusPembayaran::$pembayaran_berhasil && $d->status != StatusPembayaran::$pembayaran_ditolak) continue;
                    
                    $keterangan = "Sedang diproses";
                    if ($d->status == StatusPembayaran::$pembayaran_berhasil) $keterangan = "Pembayaran berhasil";
                    if ($d->status == StatusPembayaran::$pembayaran_ditolak) $keterangan = "Pembayaran ditolak";
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
                    <td>'.$keterangan.'</td>
                </tr>';
                }
                ?>
        </tbody>
    </table>
</div>