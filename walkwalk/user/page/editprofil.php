<div class="bg-white p-5">
    <div class='text-center'>
        <h1>Edit Profil</h1>
    </div>
    <form class="container" action="?process=editprofil" method="post">
        <div class="mb-3">
            <label for="a" class="form-label">Nama</label>
            <input required value="<?php echo $user->name ?>" name="name" type="text" class="form-control" id="a" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="b" class="form-label">Email</label>
            <input required value="<?php echo $user->email ?>" name="email" type="email" class="form-control" id="b" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="e" class="form-label">Alamat</label>
            <input required value="<?php echo $user->address ?>" name="address" type="text" class="form-control" id="e" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="f" class="form-label">No HP</label>
            <input required value="<?php echo $user->phone ?>" name="phone" type="number" class="form-control" id="f" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="c" class="form-label">Password (Abaikan jika tidak ingin ganti password)</label>
            <input name="password" type="password" class="form-control" id="c">
        </div>
        <button type="submit" class="btn btn-success bg-gradient">Simpan</button>
    </form>
</div>