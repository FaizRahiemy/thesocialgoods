<?php $bisnis = $viewModel[0];
    if(@$_POST['submit']){
        $id      = $this->id;
        $thumbnail	= $_POST['thumbnail'];
        $judul	= $_POST['judul'];
        if (empty($_POST['alias'])){
            $alias	= strtolower(trim(preg_replace('/[\s-]+/', "-", preg_replace('/[^A-Za-z0-9-]+/', "-", preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $judul))))), "-"));
        }else{
            $alias	= $_POST['alias'];
        }
        $jenis	= $_POST['jenis'];
        $harga	= $_POST['harga'];
        $text	= $_POST['text'];
        $metakey	= $_POST['metakey'];
        $metadesc	= $_POST['metadesc'];
        $date	= date("Y-m-d H:i:s");
        if($judul && $text){
            $in = $bisnis->editBisnis("thumbnail = '".$thumbnail."', judul = '".$judul."', alias = '".$alias."', jenis = '".$jenis."', harga = '".$harga."', text = '".$text."', metakey = '".$metakey."', metadesc = '".$metadesc."', modified = '".$date."'");
            $_SESSION['flash'] = "Anda berhasil mengedit bisnis!";
        }else{
            $errors[] = "Judul dan bisnis tidak boleh kosong.";
        }
    }
    if(@$_POST['hapus']){
        $bisnis->deleteBisnis();
        header("Location: ".$this->baseUrl."bisnis/admin");
        die();
        $_SESSION['flash'] = "Anda berhasil menghapus bisnis!";
    }
    $bisnis = $this->getBisnis()[0];
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."bisnis/baca/".$bisnis->id."-".$bisnis->alias);
        die();
    }
?>
<div id="content">
    <div id="content-title">
       <?php echo '<form action="" method="post" onsubmit="return show_confirm();">
       <input type="text" id="inputText" name="judul"/ value="'.$bisnis->judul.'" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="content-info">
       <?php echo 'ID : '.$bisnis->id.' <br> Alias : <input type="text" id="inputText" name="alias"/ value="'.$bisnis->alias.'" style="font-size:14px;margin:0px;width:50%;"> <br> Jenis : <input type="text" id="inputText" name="jenis"/ value="'.$bisnis->jenis.'" style="font-size:14px;margin:0px;width:50%;"> <br> Harga : Rp. <input type="text" id="inputText" name="harga"/ value="'.$bisnis->harga.'" style="font-size:14px;margin:0px;width:50%;"> <br> Thumbnail : <input type="text" id="inputText" name="thumbnail"/ value="'.$bisnis->thumbnail.'" style="font-size:14px;margin:0px;width:50%;"> <br> Ditulis : '.date("j F Y", strtotime($bisnis->created)).' jam '.date("G:i", strtotime($bisnis->created)).' WIB | <a href="#komentar">'.$bisnis->getTotalKomentar().' Komentar</a>' ?>
    </div>
    <div id="content-body">
        <div id="content-info">
           Isi Bisnis : 
        </div>
        <?php 
            echo '<textarea name="text">'.$bisnis->text.'</textarea>';
        ?>
        <div id="content-info"> 
        <?php echo'
        <span style="width:50%;">Metakey :</span><input type="text" id="inputText" name="metakey"/ value="'.$bisnis->metakey.'" style="font-size:14px;margin:0px;width:50%;"><br>
         <span style="width:400px;">Metadesc :</span><input type="text" id="inputText" name="metadesc"/ value="'.$bisnis->metadesc.'" style="font-size:14px;margin:0px;width:50%;">' ?>
        </div>
        <br><input type="submit" name="submit" id="inputSubmit" value="Edit Kreasi" /> <input type="submit" name="hapus" id="inputSubmit" value="Hapus Kreasi" /></form>
    </div>
    <?php
        
    ?>
    <div id="komentar">
        <?php if ($bisnis->getTotalKomentar()[0] > 0){?>
            <div id="content-info">Komentar</div>
            <?php 
            $numItems = count($bisnis->getKomentar());
            $i = 0;
            $borderBot = ";border-bottom : 1px solid #14293D;";
            foreach ($bisnis->getKomentar() as $komentar){
                if(++$i === $numItems) {
                    $borderBot = "";
                }
                echo'
                <div id="content-body" style="padding-left:20px; padding-bottom:20px'.$borderBot.'">';
                        echo '<br><b>'.$komentar->nama.'</b> - Ditulis : '.date("j F Y", strtotime($komentar->date)).' jam '.date("G:i", strtotime($komentar->date)).' WIB
                        <br>'.$komentar->komentar;
                echo '
                </div>';
            }
        }
        ?>
    </div>
</div>

<div id="widget">
<?php
    $this->getBlogpost("ORDER BY created DESC LIMIT 5");
    $this->getKomentar("ORDER BY date DESC LIMIT 5");
?>
</div>