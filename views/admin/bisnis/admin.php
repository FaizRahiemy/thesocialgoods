<?php 
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."bisnis");
        die();
    }
?>
<div id="content">
    <div id="content-title">
        Index Bisnis
    </div>
    <div id="content-body">
        <?php if ($this->id == 1){?>
            <a href="<?php echo $this->baseUrl ?>bisnis/tambah"><div id="content-item-admin">
                <b>Tambah bisnis</b><br>
                Tulis bisnis baru
            </div></a>
        <?php }?>
        <?php foreach ($viewModel as $bisnis){
        ?>
        <a href="<?php echo $this->baseUrl.'bisnis/edit/'.$bisnis->id.'-'.$bisnis->alias ?>"><div id="content-item-admin">
            <?php echo '<b>'.$bisnis->judul.'</b><br>
            Ditulis : '.date("j F Y", strtotime($bisnis->created)).' jam '.date("G:i", strtotime($bisnis->created)).' WIB | '.$bisnis->getTotalKomentar().' Komentar | Hits : '.$bisnis->hits; ?>
        </div></a>
    <?php } ?>
    </div>
</div>
<div id="paging">
    <?php 
    $jumData = ($this->getTotalBisnis())+1;
    $jumPage = ceil($jumData/20);
    $noPage = $this->id;
        if ($noPage > 1) echo  "<a href='".$this->baseUrl."bisnis/admin/".($noPage-1)."'><</a>";
        $showPage=0;
        for($page = 1; $page <= $jumPage; $page++){
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){   
                if (($showPage == 1) && ($page != 2))  echo "..."; 
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
                if ($page == $noPage) echo "<b>".$page."</b>";
            else echo "<a href='".$this->baseUrl."bisnis/admin/".$page."'>".$page."</a>";
            $showPage = $page;
            }
        }	
        if ($noPage < $jumPage) echo "<a href='".$this->baseUrl."bisnis/admin/".($noPage+1)."'>></a>";
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