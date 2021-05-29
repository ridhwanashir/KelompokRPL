<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-wisata&a1=data-wisata" class="btn btn-success">Data Tempat Wisata</a>
        <a href="?page=kelola-wisata&a1=tambah-wisata" class="btn btn-success">Tambah Tempat Wisata</a>
    </div>

    <div class="mb-3">
        <?php
        $wisata = new TempatWisata($conn);
        $wisata->getDataByID($_GET["id"]);

        if (isset($_GET["msg"]) && $_GET["msg"] == "success")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil</div>';
        }
        ?>
        
        <p class="fw-bold">Edit Tempat Wisata</p>

        <form method="post" action="?process=edit-wisata&id=<?php echo $wisata->id;?>">
            <div class="mb-3">
                <label for="nama_tempat" class="mb-3">Nama Tempat</label>
                <input value="<?php echo $wisata->nama_tempat;?>" required name="nama_tempat" class="form-control" id="nama_tempat" type="text">
            </div>
            <div class="mb-3">
                <label for="alamat" class="mb-3">Alamat</label>
                <input value="<?php echo $wisata->alamat;?>" required name="alamat" class="form-control" id="alamat" type="text">
            </div>
            <div class="mb-3">
                <label for="alamat" class="mb-3">Harga</label>
                <input value="<?php echo $wisata->harga;?>" required name="harga" class="form-control" id="alamat" type="text">
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>

</div>