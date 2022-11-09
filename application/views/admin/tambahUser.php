</div>
<form class="text-primary" action="" method="post">
    <?php if (validation_errors() || $is_unique == false) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo (validation_errors()); ?>
            <?php if ($is_unique == false) : ?>
                <p>Username yang digunakan tidak tersedia.</p>
            <?php endif ?>
        </div>
    <?php endif ?>
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            User <?php echo ($this->session->flashdata('flash')) ?> ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value=<?php echo ($nama) ?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value=<?php echo ($username) ?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value=<?php echo ($password) ?>>
            <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Confirm Password">
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Level</legend>
            <div class="col-sm-10">
                <?php if ($level == 1 || $level == null) { ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level1" value="1" checked="checked">
                        <label class="form-check-label" for="gridRadios1">
                            Level 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level2" value="2">
                        <label class="form-check-label" for="gridRadios1">
                            Level 2
                        </label>
                    </div>
                <?php } elseif ($level == 2) { ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level1" value="1">
                        <label class="form-check-label" for="gridRadios1">
                            Level 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level2" value="2" checked="checked">
                        <label class="form-check-label" for="gridRadios1">
                            Level 2
                        </label>
                    </div>
                <?php } ?>

            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah User</button>
        </div>
    </div>
</form>
</main>
</div>
</div>