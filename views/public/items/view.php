<div id="newarrival">
    <div class="newarrivaltitle"><?php echo $viewModel[0]->name ?></div>
    <div id="arrivalitemcontainer">
        <div class="itemimg">
            <img src="<?php echo $this->baseUrl.$viewModel[0]->img ?>">
        </div>
        <div id="itemdesccontainer">
        <div id="itemdesc">
            <?php echo $viewModel[0]->desc ?><br><br>
            IDR <?php echo $viewModel[0]->price ?>
            <br>
        </div>
        </div>
    </div>
</div>