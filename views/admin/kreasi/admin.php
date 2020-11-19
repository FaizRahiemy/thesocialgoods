<?php 
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."kreasi");
        die();
    }
?>
<div id="content">
    <div id="content-title">
        Index Kreasi
    </div>
    <div id="content-body">
        <?php if ($this->id == 1){?>
            <a href="<?php echo $this->baseUrl ?>kreasi/tambah"><div id="content-item-admin">
                <b>Tambah Kreasi</b><br>
                Tulis kreasi baru
            </div></a>
        <?php }?>
        <?php foreach ($viewModel as $kreasi){
        ?>
        <a href="<?php echo $this->baseUrl.'kreasi/edit/'.$kreasi->id.'-'.$kreasi->alias ?>"><div id="content-item-admin">
            <?php echo '<b>'.$kreasi->judul.'</b><br>
            Ditulis : '.date("j F Y", strtotime($kreasi->created)).' jam '.date("G:i", strtotime($kreasi->created)).' WIB | '.$kreasi->getTotalKomentar().' Komentar | Hits : '.$kreasi->hits; ?>
        </div></a>
    <?php } ?>
    </div>
</div>
<div id="paging">
    <?php 
    $jumData = ($this->getTotalKreasi())+1;
    $jumPage = ceil($jumData/20);
    $noPage = $this->id;
        if ($noPage > 1) echo  "<a href='".$this->baseUrl."kreasi/admin/".($noPage-1)."'><</a>";
        $showPage=0;
        for($page = 1; $page <= $jumPage; $page++){
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){   
                if (($showPage == 1) && ($page != 2))  echo "..."; 
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
                if ($page == $noPage) echo "<b>".$page."</b>";
            else echo "<a href='".$this->baseUrl."kreasi/admin/".$page."'>".$page."</a>";
            $showPage = $page;
            }
        }	
        if ($noPage < $jumPage) echo "<a href='".$this->baseUrl."kreasi/admin/".($noPage+1)."'>></a>";
        echo "";
    ?>
    <div id='totalPage'>
        Halaman <?php echo $noPage."/".$jumPage ?>
    </div>
</div>

<div id="widget">
<?php
    $this->getBlogpost("ORDER BY created DESC LIMIT 5");
    $this->getKomentar("ORDER BY date DESC LIMIT 5");
?>
</div>