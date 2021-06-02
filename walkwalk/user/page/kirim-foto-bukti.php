<?php

?>


<div class="bg-white p-5">
    <div class="container-sm">
        <h3>Kirim Foto Bukti</h3>
        <form method="post" action="?process=kirim-foto-bukti" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET["a1"] ?>">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Bukti Foto</label>
                <input required name="foto_bukti" class="form-control" type="file" id="formFile">
            </div>
            <button type="submit" class="btn bg-success bg-gradient text-white">Kirim</button>
        </form>
    </div>
</div>