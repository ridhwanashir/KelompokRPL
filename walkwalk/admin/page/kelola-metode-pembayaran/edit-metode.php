<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-metode-pembayaran&a1=data-metode" class="btn btn-success active">Data Metode</a>
        <a href="?page=kelola-metode-pembayaran&a1=tambah-metode" class="btn btn-success">Tambah Metode</a>
    </div>

    <div class="mb-3">
        <?php
        $metode = new MetodePembayaran($conn);
        $metode->getDataByID($_GET["id"]);

        if (isset($_GET["msg"]) && $_GET["msg"] == "success")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil</div>';
        }
        ?>
        
        <p class="fw-bold">Edit Penginapan</p>

        <form method="post" action="?process=edit-metode&id=<?php echo $metode->id;?>">
            <div class="mb-3">
                <label for="nama" class="mb-3">Nama</label>
                <input value="<?php echo $metode->nama;?>" required name="nama" class="form-control" id="nama" type="text">
            </div>
            <div class="mb-3">
                <label for="no_rek" class="mb-3">No Rekening</label>
                <input value="<?php echo $metode->no_rek;?>" required name="no_rek" class="form-control" id="no_rek" type="text">
            </div>
            <div class="mb-3">
                <label for="atas_nama" class="mb-3">Atas Nama</label>
                <input value="<?php echo $metode->atas_nama;?>" required name="atas_nama" class="form-control" id="atas_nama" type="text">
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>

</div>