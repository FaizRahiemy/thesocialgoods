<div id="navcontainer">
    <a href="<?php echo $this->baseUrl ?>categories/view/men"><div class="navitem50 navitem">
        <img src="public/images/assets/thesocialgoods_BQW72wdDM44.jpg">
    </div></a>
    <a href="<?php echo $this->baseUrl ?>categories/view/men"><div class="navitem50v navitem">
        <img src="public/images/assets/thesocialgoods_BPC7QdUj0Ty.jpg">
    </div></a>
    <a href="<?php echo $this->baseUrl ?>categories/view/men"><div class="navitem25 navitem">
        <img src="public/images/assets/thesocialgoods_BQW7IugDcZ9.jpg">
    </div></a>
    <a href="<?php echo $this->baseUrl ?>categories/view/men"><div class="navitem25 navitem">
        <img src="public/images/assets/thesocialgoods_BQW7Yogj34K.jpg">
    </div></a>
</div>


<div id="newarrival">
    <div class="newarrivaltitle">New Arrivals</div>
    <div id="newarrivalcatcontainer">
        <div class="newarrivalcat"><a href="<?php echo $this->baseUrl ?>men">New</a></div>
        <div class="newarrivalcat"><a href="<?php echo $this->baseUrl ?>men">Men</a></div>
        <div class="newarrivalcat"><a href="<?php echo $this->baseUrl ?>men">Women</a></div>
        <div class="newarrivalcat"><a href="<?php echo $this->baseUrl ?>men">Brand</a></div>
        <div class="newarrivalcat"><a href="<?php echo $this->baseUrl ?>men">Living</a></div>
    </div>
    <div id="arrivalitemcontainer">
        <?php
            foreach ($viewModel as $item){
                ?>
                <div class="arrivalitem"><a href='<?php echo $this->baseUrl."items/view/".$item->id."-".$item->name ?>'>
                   <div class="arrivalitemimg">
                        <img src="<?php echo $item->img ?>">
                    </div>
                    <div class="arrivalitemtitle"><?php echo $item->name ?></div>
                    IDR <?php echo $item->price ?>
                </a></div>
                <?php
            }
        ?>
    </div>
</div>