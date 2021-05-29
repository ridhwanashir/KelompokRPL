<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-penginapan&a1=data-penginapan" class="btn btn-success active">Data Penginapan</a>
        <a href="?page=kelola-penginapan&a1=tambah-penginapan" class="btn btn-success">Tambah Penginapan</a>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $allpenginapan = new Penginapan($conn);
                $data = $allpenginapan->getAll();
                $i = 1;
                foreach ($data as $d)
                {
                    echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$d->nama_tempat.'</td>
                        <td>'.$d->alamat.'</td>
                        <td>
                            <a class="btn btn-warning" href="?page=kelola-penginapan&a1=edit-penginapan&id='.$d->id.'">Edit</a>
                            <a class="btn btn-danger" href="?process=delete-penginapan&id='.$d->id.'">Delete</a>
                        </td>
                    </tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>