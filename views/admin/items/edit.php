<?php $items = $viewModel[0];
    if(@$_POST['submit']){
        $target_dir = "public/images/assets/";
        $fileToUpload = $_FILES['fileToUpload']['name'];
        $target_file = $target_dir . basename($fileToUpload);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $id      = $this->id;
        $name	= $_POST['name'];
        $desc	= $_POST['desc'];
        $price	= $_POST['price'];
        if($name){
            $in = $items->editItems($name,$desc,$target_file,$price);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $_SESSION['flash'] = "Edit item success!";
        }else{
            $errors[] = "Name cannot be empty!";
        }
    }
    if(@$_POST['hapus']){
        $coretan->deleteCoretan();
        header("Location: ".$this->baseUrl."coretan/admin");
        die();
        $_SESSION['flash'] = "Anda berhasil menghapus coretan!";
    }
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl);
        die();
    }
    $items = $this->getItems("WHERE id=".$this->id)[0];
?>
<div id="newarrival">
    <div class="newarrivaltitle">
       <?php echo '<form action="" method="post" enctype= "multipart/form-data" onsubmit="return show_confirm();">
       <input type="text" id="inputText" name="name"/ value="'.$items->name.'" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="arrivalitemcontainer">
        <div class="itemimg">
            <img src="<?php echo $this->baseUrl.$items->img ?>">
        </div>
        <div id="itemdesccontainer">
        <div id="itemdesc">
            <?php echo 'ID : '.$items->id.' <br> Date : '.date("j F Y", strtotime($items->date)).' jam '.date("G:i", strtotime($items->date)).' WIB' ?>
            <?php 
                echo '<textarea name="desc">'.$items->desc.'</textarea><br>
            IDR <input type="text" id="inputText" name="price"/ value="'.$items->price.'" style="font-size:14px;margin:0px;width:50%;"><br>
            Image Image <input type="file" name="fileToUpload" id="fileToUpload">'?>
            <input type="submit" name="submit" id="inputSubmit" value="Edit Items" /> <input type="submit" name="hapus" id="inputSubmit" value="Delete Items" /></form>
        </div>
        </div>
    </div>
</div>