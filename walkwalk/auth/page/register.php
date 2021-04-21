<div class="bg-white p-5">
    <div class='text-center'>
        <h1>Register</h1>
    </div>
    <form class="container" action="?process=register" method="post">
        <div class="mb-3">
            <label for="a" class="form-label">Nama</label>
            <input required name="name" type="text" class="form-control" id="a" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="b" class="form-label">Email</label>
            <input required name="email" type="email" class="form-control" id="b" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="e" class="form-label">Alamat</label>
            <input required name="address" type="text" class="form-control" id="e" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="f" class="form-label">No HP</label>
            <input required name="phone" type="number" class="form-control" id="f" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="c" class="form-label">Password</label>
            <input required name="password" type="password" class="form-control" id="c">
        </div>
        <div class="mb-3">
            <label for="g" class="form-label">Konfirmasi Password</label>
            <input required name="cpassword" type="password" class="form-control" id="g">
        </div>
        <button type="submit" class="btn btn-success bg-gradient">Submit</button>
    </form>
</div>