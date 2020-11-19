<?php $coretan = $viewModel[0];
    if(@$_POST['submit']){
        $id      = $this->id;
        $judul	= $_POST['judul'];
        if (empty($_POST['alias'])){
            $alias	= strtolower(trim(preg_replace('/[\s-]+/', "-", preg_replace('/[^A-Za-z0-9-]+/', "-", preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $judul))))), "-"));
        }else{
            $alias	= $_POST['alias'];
        }
        $ringkasan	= $_POST['ringkasan'];
        $isicoretan	= $_POST['coretan'];
        $metakey	= $_POST['metakey'];
        $metadesc	= $_POST['metadesc'];
        $date	= date("Y-m-d H:i:s");
        if($judul && $isicoretan){
            $in = $coretan->editCoretan("judul = '".$judul."', alias = '".$alias."', ringkasan = '".$ringkasan."', text = '".$isicoretan."', metakey = '".$metakey."', metadesc = '".$metadesc."', modified = '".$date."'");
            $_SESSION['flash'] = "Anda berhasil mengedit coretan!";
        }else{
            $errors[] = "Judul dan coretan tidak boleh kosong.";
        }
    }
    if(@$_POST['hapus']){
        $coretan->deleteCoretan();
        header("Location: ".$this->baseUrl."coretan/admin");
        die();
        $_SESSION['flash'] = "Anda berhasil menghapus coretan!";
    }
    $coretan = $this->getCoretan()[0];
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."coretan/baca/".$coretan->id."-".$coretan->alias);
        die();
    }
?>
<div id="content">
    <div id="content-title">
       <?php echo '<form action="" method="post" onsubmit="return show_confirm();">
       <input type="text" id="inputText" name="judul"/ value="'.$coretan->judul.'" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="content-info">
       <?php echo 'ID : '.$coretan->id.' <br> Alias : <input type="text" id="inputText" name="alias"/ value="'.$coretan->alias.'" style="font-size:14px;margin:0px;width:50%;"><br> Ditulis : '.date("j F Y", strtotime($coretan->created)).' jam '.date("G:i", strtotime($coretan->created)).' WIB | <a href="#komentar">'.$coretan->getTotalKomentar().' Komentar</a>' ?>
    </div>
    <div id="content-body">
        <div id="content-info">
           Ringkasan : 
        </div>
        <?php 
            echo '<textarea name="ringkasan">'.$coretan->ringkasan.'</textarea>';
        ?>
        <div id="content-info">
           Isi Coretan : 
        </div>
        <?php 
            echo '<textarea name="coretan">'.$coretan->text.'</textarea>';
        ?>
        <div id="content-info"> 
        <?php echo'
        <span style="width:50%;">Metakey :</span><input type="text" id="inputText" name="metakey"/ value="'.$coretan->metakey.'" style="font-size:14px;margin:0px;width:50%;"><br>
         <span style="width:400px;">Metadesc :</span><input type="text" id="inputText" name="metadesc"/ value="'.$coretan->metadesc.'" style="font-size:14px;margin:0px;width:50%;">' ?>
        </div>
        <br><input type="submit" name="submit" id="inputSubmit" value="Edit Coretan" /> <input type="submit" name="hapus" id="inputSubmit" value="Hapus Coretan" /></form>
    </div>
    <?php
        
    ?>
    <div id="komentar">
        <?php if ($coretan->getTotalKomentar()[0] > 0){?>
            <div id="content-info">Komentar</div>
            <?php 
            $numItems = count($coretan->getKomentar());
            $i = 0;
            $borderBot = ";border-bottom : 1px solid #14293D;";
            foreach ($coretan->getKomentar() as $komentar){
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