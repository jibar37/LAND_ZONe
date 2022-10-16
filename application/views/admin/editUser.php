</div>
<div class="container-fluid ">
    <div class="list-group ">
        <?php foreach ($data as $key => $value) { ?>
            <?php if ($key != $this->session->userdata('username')) { ?>
                <?php if ($value['level'] != "2") { ?>
                    <a href="?username=<?php echo ($key); ?>" class="list-group-item list-group-item-action text-primary">
                        <span data-feather="user"></span>
                        <?php echo ($key); ?>
                    </a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
</main>