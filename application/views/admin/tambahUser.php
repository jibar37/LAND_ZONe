</div>
<form class="text-primary">
    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Level</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="level" id="level1" value="1" checked>
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
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="level" id="level3" value="3">
                    <label class="form-check-label" for="gridRadios1">
                        Level 3
                    </label>
                </div>
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