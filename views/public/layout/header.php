<div id="header">
    <a href="<?php echo $this->baseUrl ?>"><img alt="The Social Goods" src="<?php echo $this->baseUrl ?>public/images/logo_header.png" align="center";/></a>
    
    <div id="menucontainer">
        <?php
            foreach($this->getCategories("") as $cat){
                if ($cat->show == 1){
                ?>
                <div id="menuitem" class="blackmenu">
                    <a href="<?php echo $this->baseUrl."categories/view/".$cat->name ?>"><?php echo $cat->name ?></a>
                </div>
                <?php
                }
            }
        ?>
        <div id="menuitem" class="redmenu">
            <a href="<?php echo $this->baseUrl ?>categories/view/sale">SALE</a>
        </div>
        
        <div id="menuitem" class="blackmenu">
            <a href="<?php echo $this->baseUrl ?>categories/view/features">Features</a>
        </div>
        
    </div>
</div>