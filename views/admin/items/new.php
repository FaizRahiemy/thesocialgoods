<?php 
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
            $in = $this->addItems($name,$desc,$target_file,$price);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $_SESSION['flash'] = "Add New item success!";
        }else{
            $errors[] = "Name cannot be empty!";
        }
    }
    if (!isset($_SESSION['username'])){
        header("Location: ".$this->baseUrl);
        die();
    }
?>
<div id="newarrival">
    <div class="newarrivaltitle">
       <?php echo '<form action="" method="post" enctype= "multipart/form-data" onsubmit="return show_confirm();">
       <input type="text" id="inputText" name="name"/ value="" style="font-size:40px;margin:0px;width:50%;" required>' ?>
    </div>
    <div id="arrivalitemcontainer">
        <div class="itemimg">
            <img src="<?php echo $this->baseUrl."public/images/tambah.jpg" ?>">
        </div>
        <div id="itemdesccontainer">
        <div id="itemdesc">
            <?php 
                echo '<textarea name="desc"></textarea><br>
            IDR <input type="text" id="inputText" name="price"/ value="" style="font-size:14px;margin:0px;width:50%;"><br>
            Image <input type="file" name="fileToUpload" id="fileToUpload">'?>
            <br><input type="submit" name="submit" id="inputSubmit" value="Add New Items" /></form>
        </div>
        </div>
    </div>
</div>