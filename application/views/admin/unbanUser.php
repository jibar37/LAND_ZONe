</div>
<div class="container-fluid ">
    <?php foreach ($data as $key => $value) { ?>
        <?php if ($key != $this->session->userdata('username')) { ?>
            <?php if ($value['status'] != "1") { ?>
                <?php if ($value['level'] != "2") { ?>
                    <div class="row">
                        <a class="col-sm-8 list-group-item list-group-item-action text-primary">
                            <span data-feather="user"></span>
                            <?php echo ($key); ?>
                        </a>
                        <a onclick="unban('?username=<?php echo ($key); ?>')" class="btn btn-success btn-lg active" style="height:100%;">
                            <span data-feather="user-check"></span>
                            UNBAN
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>
</div>
</main>