<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-wisata&a1=data-wisata" class="btn btn-success active">Data Tempat Wisata</a>
        <a href="?page=kelola-wisata&a1=tambah-wisata" class="btn btn-success">Tambah Tempat Wisata</a>
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
                    <th>Nama Tempat</th>
                    <th>Alamat</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $allwisata = new TempatWisata($conn);
                $data = $allwisata->getAll();
                $i = 1;
                foreach ($data as $d)
                {
                    echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$d->nama_tempat.'</td>
                        <td>'.$d->alamat.'</td>
                        <td>'.$d->harga.'</td>
                        <td>
                            <a class="btn btn-warning" href="?page=kelola-wisata&a1=edit-wisata&id='.$d->id.'">Edit</a>
                            <a class="btn btn-danger" href="?process=delete-wisata&id='.$d->id.'">Delete</a>
                        </td>
                    </tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>