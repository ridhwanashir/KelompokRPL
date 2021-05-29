<div class="bg-white p-5">
<div class="btn-group mb-3">
        <a href="?page=kelola-kamar&a1=data-kamar" class="btn btn-success active">Data Kamar</a>
        <a href="?page=kelola-kamar&a1=tambah-kamar" class="btn btn-success">Tambah Kamar</a>
    </div>

    <div class="mb-3">
        <?php
        $kamar = new Kamar($conn);
        $kamar->getDataByID($_GET["id"]);

        if (isset($_GET["msg"]) && $_GET["msg"] == "success")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil</div>';
        }
        ?>
        
        <p class="fw-bold">Edit Penginapan</p>

        <form method="post" action="?process=edit-kamar&id=<?php echo $kamar->id;?>">
            
            <div class="mb-3">
                <select class="form-control" name="penginapan_id">
                    <?php
                    $allpenginapan = new Penginapan($conn);
                    $data = $allpenginapan->getAll();
                    foreach ($data as $d)
                    {
                        $penginapan = new Penginapan($conn);
                        $penginapan->getDataByID($d->id);
                        echo '<option value="'.$penginapan->id.'" '.(($penginapan->id == $kamar->penginapan_id) ? "selected":"").'>'.$penginapan->nama_tempat.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_kamar" class="mb-3">Nomor Kamar</label>
                <input value="<?php echo $kamar->no_kamar;?>" required name="no_kamar" class="form-control" id="no_kamar" type="number">
            </div>
            <div class="mb-3">
                <label for="harga" class="mb-3">Harga</label>
                <input value="<?php echo $kamar->harga;?>" required name="harga" class="form-control" id="harga" type="number">
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>

</div>