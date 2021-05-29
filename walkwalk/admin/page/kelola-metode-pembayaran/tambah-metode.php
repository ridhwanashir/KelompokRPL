<div class="bg-white p-5">
    <div class="btn-group mb-3">
        <a href="?page=kelola-metode-pembayaran&a1=data-metode" class="btn btn-success">Data Metode</a>
        <a href="?page=kelola-metode-pembayaran&a1=tambah-metode" class="btn btn-success active">Tambah Metode</a>
    </div>

    <div class="mb-3">
        <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == "success")
        {
            echo '<div class="alert alert-success" role="alert">Berhasil</div>';
        }
        ?>
        
        <p class="fw-bold">Tambah Metode Pembayaran</p>

        <form method="post" action="?process=tambah-metode">
            <div class="mb-3">
                <label for="nama" class="mb-3">Nama</label>
                <input required name="nama" class="form-control" id="nama" type="text">
            </div>
            <div class="mb-3">
                <label for="no_rek" class="mb-3">No Rek</label>
                <input required name="no_rek" class="form-control" id="no_rek" type="text">
            </div>
            <div class="mb-3">
                <label for="atas_nama" class="mb-3">Atas Nama</label>
                <input required name="atas_nama" class="form-control" id="atas_nama" type="text">
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>

</div>