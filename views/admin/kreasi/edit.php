<?php $kreasi = $viewModel[0];
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
        $platform	= $_POST['platform'];
        $text	= $_POST['text'];
        $metakey	= $_POST['metakey'];
        $metadesc	= $_POST['metadesc'];
        $date	= date("Y-m-d H:i:s");
        if($judul && $text){
            $in = $kreasi->editKreasi("thumbnail = '".$thumbnail."', judul = '".$judul."', alias = '".$alias."', jenis = '".$jenis."', platform = '".$platform."', text = '".$text."', metakey = '".$metakey."', metadesc = '".$metadesc."', modified = '".$date."'");
            $_SESSION['flash'] = "Anda berhasil mengedit kreasi!";
        }else{
            $errors[] = "Judul dan kreasi tidak boleh kosong.";
        }
    }
    if(@$_POST['hapus']){
        $kreasi->deleteKreasi();
        header("Location: ".$this->baseUrl."kreasi/admin");
        die();
        $_SESSION['flash'] = "Anda berhasil menghapus kreasi!";
    }
    $kreasi = $this->getKreasi()[0];
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."kreasi/baca/".$kreasi->id."-".$kreasi->alias);
        die();
    }
?>
<div id="content">
    <div id="content-title">
       <?php echo '<form action="" method="post" onsubmit="return show_confirm();">
       <input type="text" id="inputText" name="judul"/ value="'.$kreasi->judul.'" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="content-info">
       <?php echo 'ID : '.$kreasi->id.' <br> Alias : <input type="text" id="inputText" name="alias"/ value="'.$kreasi->alias.'" style="font-size:14px;margin:0px;width:50%;"> <br> Jenis : <input type="text" id="inputText" name="jenis"/ value="'.$kreasi->jenis.'" style="font-size:14px;margin:0px;width:50%;"> <br> Platform : <input type="text" id="inputText" name="platform"/ value="'.$kreasi->platform.'" style="font-size:14px;margin:0px;width:50%;"> <br> Thumbnail : <input type="text" id="inputText" name="thumbnail"/ value="'.$kreasi->thumbnail.'" style="font-size:14px;margin:0px;width:50%;"> <br> Ditulis : '.date("j F Y", strtotime($kreasi->created)).' jam '.date("G:i", strtotime($kreasi->created)).' WIB | <a href="#komentar">'.$kreasi->getTotalKomentar().' Komentar</a>' ?>
    </div>
    <div id="content-body">
        <div id="content-info">
           Isi Kreasi : 
        </div>
        <?php 
            echo '<textarea name="text">'.$kreasi->text.'</textarea>';
        ?>
        <div id="content-info"> 
        <?php echo'
        <span style="width:50%;">Metakey :</span><input type="text" id="inputText" name="metakey"/ value="'.$kreasi->metakey.'" style="font-size:14px;margin:0px;width:50%;"><br>
         <span style="width:400px;">Metadesc :</span><input type="text" id="inputText" name="metadesc"/ value="'.$kreasi->metadesc.'" style="font-size:14px;margin:0px;width:50%;">' ?>
        </div>
        <br><input type="submit" name="submit" id="inputSubmit" value="Edit Kreasi" /> <input type="submit" name="hapus" id="inputSubmit" value="Hapus Kreasi" /></form>
    </div>
    <?php
        
    ?>
    <div id="komentar">
        <?php if ($kreasi->getTotalKomentar()[0] > 0){?>
            <div id="content-info">Komentar</div>
            <?php 
            $numItems = count($kreasi->getKomentar());
            $i = 0;
            $borderBot = ";border-bottom : 1px solid #14293D;";
            foreach ($kreasi->getKomentar() as $komentar){
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