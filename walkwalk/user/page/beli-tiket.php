<?php
// beli-tiket.php berisi interface untuk fungsi beli tiket
$wisata = new TempatWisata($conn);
$wisata->getDataByID($_GET["a1"]); // mengambil data tempat wisata dari ID dan menyimpannya ke variabel $wisata

?>

<div class="bg-white p-5">
    <div class="container-sm">
        <h3 class="mb-3">Beli Tiket</h3>
        <table class="table table-bordered">
            <tbody>
            <!-- menampilkan masing-masing data -->
                <tr>
                    <th>Nama Tempat</th>
                    <td><?php echo $wisata->nama_tempat?></td>
                </tr>
                <tr>
                    <th>Alamat Tempat</th>
                    <td><?php echo $wisata->alamat?></td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp. <?php echo $wisata->harga?></td>
                </tr>
            </tbody>
        </table>
        <p>Jumlah Tiket</p>
        <input class="form-control mb-3" value="1" type="number"> <!-- jumlah tiket -->
        <p>Total : <span class="fw-bold">Rp. 0</span> </p>
        <button class="btn bg-gradient text-white bg-success">Beli</button> <!-- tombol submit form -->
    </div>

</div>