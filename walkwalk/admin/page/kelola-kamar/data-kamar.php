<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-kamar&a1=data-kamar" class="btn btn-success active">Data Kamar</a>
        <a href="?page=kelola-kamar&a1=tambah-kamar" class="btn btn-success">Tambah Kamar</a>
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
                    <th>Nama Penginapan</th>
                    <th>Nomor Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $allkamar = new Kamar($conn);
                $data = $allkamar->getAll();
                $i = 1;
                foreach ($data as $d)
                {
                    $penginapan = new Penginapan($conn);
                    $penginapan->getDataByID($d->penginapan_id);
                    echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$penginapan->nama_tempat.'</td>
                        <td>'.$d->no_kamar.'</td>
                        <td>'.$d->harga.'</td>
                        <td>
                            <a class="btn btn-warning" href="?page=kelola-kamar&a1=edit-kamar&id='.$d->id.'">Edit</a>
                            <a class="btn btn-danger" href="?process=delete-kamar&id='.$d->id.'">Delete</a>
                        </td>
                    </tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>