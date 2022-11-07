<nav class="my-2 my-md-0 mr-md-3">
    <button class="btn btn-outline-success btn-sm" name="options" id="streets-v11" autocomplete="off"> STREET
    </button>
    <button type="button" class="btn btn-outline-success btn-sm" name="options" id="satellite-v9" autocomplete="off"> SATELITE
    </button>
    <button type="button" class="btn btn-outline-success btn-sm" name="options" id="outdoors-v11" autocomplete="off"> OUTDOORS
    </button>

</nav>

<div class="btn-toolbar mb-2 mb-md-0">

    <div class="btn-group mr-2">
        <button type="button" class="btn btn-outline-warning btn-sm font-weight-bold" name="options" id="tambah" autocomplete="off" data-toggle="modal" data-target="#exampleModal">
            <span data-feather="plus-square"></span>
            Tambah
        </button>
        <button type="button" class="btn btn-outline-success btn-sm font-weight-bold" name="options" id="edit" autocomplete="off">
            <span data-feather="edit"></span>
            Edit
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold" name="options" id="hapus" autocomplete="off">
            <span data-feather="trash"></span>
            Hapus
        </button>
    </div>
    <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-primary font-weight-bold" id="save">
            <span data-feather="save"></span>
            Save
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold" name="options" id="cancel" autocomplete="off">
            <span data-feather="x-square"></span>
            Cancel
        </button>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="detailPolygon">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="rth" value="Kawasan RTH" checked>
                                    <label class="form-check-label">
                                        Kawasan RTH
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="ksp" value="Kawasan Sepadan Pantai">
                                    <label class="form-check-label">
                                        Kawasan Sepadan Pantai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="kss" value="Kawasan Sepadan Sungai">
                                    <label class="form-check-label">
                                        Kawasan Sepadan Sungai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="kcb" value="Kawasan Cagar Budaya">
                                    <label class="form-check-label">
                                        Kawasan Cagar Budaya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="krab" value="Kawasan Rawan Ancaman Bencana">
                                    <label class="form-check-label">
                                        Kawasan Rawan Ancaman Bencana
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php echo ($this->input->post('jenis')) ?>

</div>
<div id="map">

    <div class="card" style="height: 100vh;">
    </div>
</div>
</main>
</div>
</div>





<script type='module'></script>
<script type="text/javascript">
    function edit1() {
        edit();
    }
</script>
<!-- document.writeln("<script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>"); -->