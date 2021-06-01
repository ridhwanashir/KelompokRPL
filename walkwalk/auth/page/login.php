<div class="bg-white p-5">
    <div class='text-center'>
        <h1>Login</h1>
    </div>

    <?php
    alertError("container");
    ?>

    <form class="container" action="?process=login" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" required type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
        
        <a href="?page=login-admin">Login Admin</a></div>
        <button type="submit" class="btn btn-success bg-gradient">Submit</button>
    </form>
</div>
