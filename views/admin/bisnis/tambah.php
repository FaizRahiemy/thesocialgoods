<?php $bisnis = $viewModel[0];
    if(@$_POST['submit']){
        $id = $bisnis->getAI();
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
            $in = $bisnis->tambahBisnis("NULL, '".$thumbnail."', '".$judul."', '".$alias."', '".$jenis."', '".$harga."', '".$text."', 0, 0, 0, '".$date."', '".$date."', '".$metakey."', '".$metadesc."', 0, ''");
            header("Location: ".$this->baseUrl."bisnis/edit/".$id."-".$alias);
            die();
            $_SESSION['flash'] = "Anda berhasil menambah bisnis!";
        }else{
            $errors[] = "Judul dan bisnis tidak boleh kosong.";
        }
    }
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl."bisnis");
        die();
    }
?>
<div id="content">
    <div id="content-title">
       <?php echo '<form action="" method="post">
       <input type="text" id="inputText" name="judul"/ value="" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="content-info">
       <?php echo 'ID : '.$bisnis->getAI().' <br> Alias : <input type="text" id="inputText" name="alias"/ value="" style="font-size:14px;margin:0px;width:50%;"><br> Jenis : <input type="text" id="inputText" name="jenis"/ value="" style="font-size:14px;margin:0px;width:50%;"> <br> Harga : Rp. <input type="text" id="inputText" name="harga"/ value="'.number_format(0, 0, '.', ',').'" style="font-size:14px;margin:0px;width:50%;"> <br> Thumbnail : <input type="text" id="inputText" name="thumbnail"/ value="" style="font-size:14px;margin:0px;width:50%;">' ?>
    </div>
    <div id="content-body">
        <div id="content-info">
           Isi Bisnis : 
        </div>
        <?php 
            echo '<textarea name="text"></textarea>';
        ?>
        <div id="content-info"> 
        <?php echo'
        <span style="width:50%;">Metakey :</span><input type="text" id="inputText" name="metakey"/ value="" style="font-size:14px;margin:0px;width:50%;"><br>
         <span style="width:400px;">Metadesc :</span><input type="text" id="inputText" name="metadesc"/ value="" style="font-size:14px;margin:0px;width:50%;">' ?>
        </div>
        <br><input type="submit" name="submit" id="inputSubmit" value="Tambah Bisnis" /></form>
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