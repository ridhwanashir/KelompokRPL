<?php
$pembayaran = new Pembayaran($conn);
$data = $pembayaran->getAll();
?>

<div class="bg-white p-5">

    <?php
    if (isset($_GET["status"]))
    {
        switch ($_GET["status"])
        {
            case "success-terima":
                echo '<div class="alert alert-success" role="alert">Bukti pembayaran diterima</div>';
            break;

            case "success-tolak":
                echo '<div class="alert alert-danger" role="alert">Bukti pembayaran ditolak</div>';
            break;
        }
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Total Harga</th>
                <th>Foto Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $d)
            {
                $nama = "";
                
                if ($d->status != StatusPembayaran::$menunggu_approval_admin) continue;

                if ($d->tiket_id)
                {
                    $tiket = new TiketWisata($conn);
                    $tiket->getDataByID($d->tiket_id);
                    $user = new User($conn);
                    $user->getDataByID($tiket->user_id);
                    $nama = $user->name;
                }
                elseif ($d->book_id)
                {
                    $pp = new PesanPenginapan($conn);
                    $pp->getDataByID($d->book_id);
                    $user = new User($conn);
                    $user->getDataByID($pp->user_id);
                    $nama = $user->name;
                }

                echo '<tr>
                    <td>'.$nama.'</td>
                    <td>Rp. '.$d->total_harga.'</td>
                    <td><img src="user/img/foto_bukti_pembayaran/'.$d->foto_bukti.'" height="200px"></td>
                    <td>
                    <a href="?process=terima-bukti-pembayaran&a1='.$d->id.'" class="btn bg-success bg-gradient text-white">Terima</a>
                    <a href="?process=tolak-bukti-pembayaran&a1='.$d->id.'" class="btn bg-danger bg-gradient text-white">Tolak</a>
                    </td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>

</div>