</div>
<div class="container-fluid ">
    <div class="list-group ">
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                User <?php echo ($this->session->flashdata('flash')) ?> di BAN.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <?php foreach ($data as $key => $value) { ?>
            <?php if ($key != $this->session->userdata('username')) { ?>
                <?php if ($value['status'] != "0") { ?>
                    <div class="row">
                        <a class="col-sm-8 list-group-item list-group-item-action text-primary">
                            <span data-feather="user"></span>
                            <?php echo ($key); ?>
                        </a>
                        <a href="?username=<?php echo ($key); ?>" class="btn btn-danger btn-lg active" style="height:100%;">
                            <span data-feather="user-x"></span>
                            BAN
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
</main>