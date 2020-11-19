<div id="footer">
    <div id="footerleft">
        The Social Goods Creating Goods For Good Social Life.<br>
        Text/WA: +62 822 40024010<br>
        LINE: @thesocialgoods<br>
        <div class="center" id="sosmed">
            <a href="http://www.instagram.com/thesocialgoods" target="_blank">g</a>
        </div>
    </div>
    <div id="footerleft">
        
    </div>
    <div id="footerleft">
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
    <br><br><br>
    <div id="copyright">
        <?php echo date("Y") ?> - The Social Goods<br>
        Site by <a href="http://www.faiz.rahie.my.id" target="_blank">MOVElution Lab.</a>
    </div>
</div>