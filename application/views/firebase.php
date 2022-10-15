<h3 class="nav-item dropdown my-0 mr-md-auto font-weight-normal">
    <a class="btn btn-outline-primary" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        LOGIN
    </a>
    <form class="dropdown-menu p-4" action=<?php echo (base_url('CFirebase/add_data')); ?> method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</h3>