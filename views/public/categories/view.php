<div id="newarrival">
    <div class="newarrivaltitle"><?php echo $viewModel[0]->name ?></div>
    <div id="arrivalitemcontainer">
        <?php
            foreach ($viewModel[0]->getItems("") as $item){
                ?>
                <div class="arrivalitem"><a href='<?php echo $this->baseUrl."items/view/".$item->id."-".$item->name ?>'>
                   <div class="arrivalitemimg">
                        <img src="<?php echo $this->baseUrl.$item->img ?>">
                    </div>
                    <div class="arrivalitemtitle"><?php echo $item->name ?></div>
                    IDR <?php echo $item->price ?>
                </a></div>
                <?php
            }
        ?>
    </div>
</div>