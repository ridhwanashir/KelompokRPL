<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-metode-pembayaran&a1=data-metode" class="btn btn-success active">Data Metode</a>
        <a href="?page=kelola-metode-pembayaran&a1=tambah-metode" class="btn btn-success">Tambah Metode</a>
    </div>

    <div class="mb-3">
        <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == "success-delete")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil menghapus</div>';
        }
        if (isset($_GET["msg"]) && $_GET["msg"] == "success-edit")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil mengedit</div>';
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No Rek</th>
                    <th>Atas Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $allmetode = new MetodePembayaran($conn);
                $data = $allmetode->getAll();
                $i = 1;
                foreach ($data as $d)
                {
                    echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$d->nama.'</td>
                        <td>'.$d->no_rek.'</td>
                        <td>'.$d->atas_nama.'</td>
                        <td>
                            <a class="btn btn-warning" href="?page=kelola-metode-pembayaran&a1=edit-metode&id='.$d->id.'">Edit</a>
                            <a class="btn btn-danger" href="?process=delete-metode&id='.$d->id.'">Delete</a>
                        </td>
                    </tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>