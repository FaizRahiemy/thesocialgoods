<?php $coretan = $viewModel[0];
    if(@$_POST['submit']){
        $id = $coretan->getAI();
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
            $in = $coretan->tambahCoretan("NULL, '".$judul."', '".$alias."', '".$ringkasan."', '".$isicoretan."', 0, 0, 0, '".$date."', '".$date."', '".$metakey."', '".$metadesc."', 0, ''");
            header("Location: ".$this->baseUrl."coretan/edit/".$id."-".$alias);
            die();
            $_SESSION['flash'] = "Anda berhasil menambah coretan!";
        }else{
            $errors[] = "Judul dan coretan tidak boleh kosong.";
        }
    }
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."coretan");
        die();
    }
?>
<div id="content">
    <div id="content-title">
       <?php echo '<form action="" method="post">
       <input type="text" id="inputText" name="judul"/ value="" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="content-info">
       <?php echo 'ID : '.$coretan->getAI().' <br> Alias : <input type="text" id="inputText" name="alias"/ value="" style="font-size:14px;margin:0px;width:50%;">' ?>
    </div>
    <div id="content-body">
        <div id="content-info">
           Ringkasan : 
        </div>
        <?php 
            echo '<textarea name="ringkasan"></textarea>';
        ?>
        <div id="content-info">
           Isi Coretan : 
        </div>
        <?php 
            echo '<textarea name="coretan"></textarea>';
        ?>
        <div id="content-info"> 
        <?php echo'
        <span style="width:50%;">Metakey :</span><input type="text" id="inputText" name="metakey"/ value="" style="font-size:14px;margin:0px;width:50%;"><br>
         <span style="width:400px;">Metadesc :</span><input type="text" id="inputText" name="metadesc"/ value="" style="font-size:14px;margin:0px;width:50%;">' ?>
        </div>
        <br><input type="submit" name="submit" id="inputSubmit" value="Tambah Coretan" /></form>
    </div>
    <?php
        
    ?>
</div>

<div id="widget">
<?php
    $this->getBlogpost("ORDER BY created DESC LIMIT 5");
    $this->getKomentar("ORDER BY date DESC LIMIT 5");
?>
</div>