<div class="bg-white p-5">
    <div class='text-center'>
        <h1>WalkWalk</h1>
        <p>Cari Hotel dan Wisata dengan mudah dan cepat.</p>
    </div>
</div>

<div class="bg-success bg-gradient p-5 text-white">
    <div class='text-center'>
        <h1>Cari Langsung</h1>
        <form>
            <input type="hidden" name="page" value="search">
            <input name="keyword" type="text" placeholder="Cari Wisata/Hotel" class="mt-3 fw-bold bg-light btn shadow rounded-pill p-3 w-100">
        </form>
    </div>
</div>
<div class="bg-white bg-gradient p-5">
    <h4 class="fw-bold">Rekomendasi Tempat Wisata</h4>
    <div class="row">
        <?php
        $wisatasearch = new TempatWisata($conn);
        $data = $wisatasearch->getRandom(3);
        foreach ($data as $d) {
            $wisata = new TempatWisata($conn);
            $wisata->getDataByID($d->id);
            echo '<div class="col p-3 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <img src="'."admin/img/foto_wisata/".$wisata->foto.'" width="100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">'.$wisata->nama_tempat.'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Rp. '.$wisata->harga.' </h6>
                            <p class="card-text">'.$wisata->alamat.'</p>
                        </div>
                        <div class="col-4">
                            <a href="?page=beli-tiket&a1='.$wisata->id.'" class="btn btn-success w-100">Beli Tiket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>
    <h4 class="fw-bold">Rekomendasi Penginapan</h4>
    <div class="row">
        <?php
        $penginapan = new Penginapan($conn);
        $data = $penginapan->getRandom(3);
        foreach ($data as $d) {
            $penginapan = new Penginapan($conn);
            $penginapan->getDataByID($d->id);
            echo '<div class="col p-3 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <img src="'."admin/img/foto_penginapan/".$penginapan->foto.'" width="100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">'.$penginapan->nama_tempat.'</h5>
                            <p class="card-text">'.$penginapan->alamat.'</p>
                        </div>
                        <div class="col-4">
                            <a href="?page=pesan-penginapan&a1='.$penginapan->id.'" class="btn btn-success w-100">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>
</div>