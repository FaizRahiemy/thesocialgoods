<div id="content">
<?php
    if (isset($_SESSION['username'])){
?>
        <div id="content-title">
            Jurnal
        </div>
        <div id="content-body">
            Saldo : <?php echo 'Rp. '.number_format($this->getSaldo(),3,',','.') ?> <br>
            Tabungan : <?php echo 'Rp. '.number_format($this->getTabungan(),3,',','.') ?><br>
            Dompet : <?php echo 'Rp. '.number_format(($this->getSaldo()-$this->getTabungan()),3,',','.') ?><br><br>
            <a href="<?php echo $this->baseUrl ?>admin/transaksi/baru" id="inputSubmit" style="margin:0px;text-decoration:none;color:#ECF0F1">Tambah Transaksi</a><br><br>
            <table align="center">
            <tr style="background:#14293D;color:#ECF0F1;">
                <th style="padding: 3px 4px 3px 4px;">No</th>
                <th style="padding: 3px 4px 3px 4px;">Keterangan</th>
                <th style="padding: 3px 4px 3px 4px;">Tanggal</th>
                <th style="padding: 3px 4px 3px 4px;">Debit</th>
                <th style="padding: 3px 4px 3px 4px;">Kredit</th>
                <th style="padding: 3px 4px 3px 4px;">Edit</th>
            </tr>
            <?php 
                $i = (($this->id - 1) * 25)+1; 
                foreach ($viewModel as $transaksi){
                    echo '
                    <tr">
                        <td align="center" style="padding: 3px 4px 3px 4px;">'.($i++).'</td>
                        <td style="padding: 3px 4px 3px 4px;">'.$transaksi['keterangan'].'</td>
                        <td style="padding: 3px 4px 3px 4px;">'.date("j F Y", strtotime($transaksi['tanggal'])).' jam '.date("G:i", strtotime($transaksi['tanggal'])).' WIB'.'</td>
                        <td style="padding: 3px 4px 3px 4px;">'.number_format($transaksi['debit'],3,',','.').'</td>
                        <td style="padding: 3px 4px 3px 4px;">'.number_format($transaksi['kredit'],3,',','.').'</td>
                        <td style="padding: 3px 4px 3px 4px;"><a href="'.$this->baseUrl.'admin/transaksi/'.$transaksi['id'].'">Edit</a></td>
                    </tr>';
                }
            ?>
            </table>
        </div>
<?php
    }else{
        header("Location: ".$this->baseUrl."admin");
        die();
    }
?>
</div>

<div id="paging">
    <?php 
    $jumData = count($this->getTransaksi(""));
    $jumPage = ceil($jumData/25);
    $noPage = $this->id;
        if ($noPage > 1) echo  "<a href='".$this->baseUrl."admin/jurnal/".($noPage-1)."'><</a>";
        $showPage=0;
        for($page = 1; $page <= $jumPage; $page++){
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){   
                if (($showPage == 1) && ($page != 2))  echo "..."; 
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
                if ($page == $noPage) echo "<b>".$page."</b>";
            else echo "<a href='".$this->baseUrl."admin/jurnal/".$page."'>".$page."</a>";
            $showPage = $page;
            }
        }	
        if ($noPage < $jumPage) echo "<a href='".$this->baseUrl."admin/jurnal/".($noPage+1)."'>></a>";
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