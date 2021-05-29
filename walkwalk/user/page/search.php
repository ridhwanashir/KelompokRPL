<?php
// search.php adalah interface untuk fungsi pencarian
if (!isset($_GET["keyword"])) {
    jsRedirect("app?page=home");
    exit;
}

$keyword = $_GET["keyword"]; // mengambil data keyword
?>

<div class="bg-white p-5">
    <form>
        <input type="hidden" name="page" value="search">
        <input name="keyword" value="<?php echo (isset($_GET["keyword"])) ? $_GET["keyword"]:"" ?>" type="text" placeholder="Cari Wisata/Hotel" class="mb-5 form-control mt-3 fw-bold shadow rounded-pill p-3 w-100">
    </form>
    <h3>Wisata</h3>
    <div class="row">
        <?php
        $wisatasearch = new TempatWisata($conn);
        $data = $wisatasearch->searchAlamat($keyword); // mencari alamat tempat wisata dari keyword 
        while ($d = $data->fetch_assoc()) {  // menampilkan data tempat wisata jika ditemukan
            $wisata = new TempatWisata($conn);
            $wisata->getDataByID($d["id"]);
            echo '<div class="col p-3 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
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
    <h3>Hotel</h3>
    <div class="row">
        <?php
        $penginapan = new Penginapan($conn);
        $data = $penginapan->searchAlamat($keyword); // mencari alamat penginapan dari keyword 
        while ($d = $data->fetch_assoc()) {  // menampilkan data penginapan jika ditemukan
            $penginapan = new Penginapan($conn);
            $penginapan->getDataByID($d["id"]);
            echo '<div class="col p-3 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
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