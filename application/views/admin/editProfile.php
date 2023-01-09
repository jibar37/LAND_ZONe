</div>
<form class="text-primary" action="" method="post">
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if ($passwordSalah) : ?>
                Password Salah
            <?php endif ?>
            <?php echo (validation_errors()); ?>
        </div>
    <?php elseif ($passwordSalah) : ?>
        <div class="alert alert-danger" role="alert">
            Password Salah
        </div>
    <?php endif ?>
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Profile <?php echo ($this->session->flashdata('flash')) ?> Di Update.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo ($user["nama"]) ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value=<?php echo ($user['username']) ?> readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password Lama</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Old Password">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password Baru</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="New Password">
            <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Confirm New Password">
        </div>
    </div>
    <input type="hidden" class="form-control" id="level" name="level" placeholder="Password" value=<?php echo ($user['level']) ?>>


    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
    </div>
</form>
</main>
</div>
</div>