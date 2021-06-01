<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-penginapan&a1=data-penginapan" class="btn btn-success">Data Penginapan</a>
        <a href="?page=kelola-penginapan&a1=tambah-penginapan" class="btn btn-success active">Tambah Penginapan</a>
    </div>

    <div class="mb-3">
        <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == "success")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil</div>';
        }
        ?>
        
        <p class="fw-bold">Tambah Penginapan</p>

        <form method="post" action="?process=tambah-penginapan" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_tempat" class="mb-3">Nama Tempat</label>
                <input required name="nama_tempat" class="form-control" id="nama_tempat" type="text">
            </div>
            <div class="mb-3">
                <label for="alamat" class="mb-3">Alamat</label>
                <input required name="alamat" class="form-control" id="alamat" type="text">
            </div>
            <div class="mb-3">
                <label for="foto" class="mb-3">Foto</label>
                <input required name="foto" class="form-control" id="foto" type="file">
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>

</div>