<div id="content">
<?php
    if (isset($_SESSION['username'])){
?>
        <div id="newarrival">
            <div class="newarrivaltitle"><?php echo $viewModel[0]->name ?></div>
            <div id="buttoncontainer">
                <a href="<?php echo $this->baseUrl ?>items/new"><div id="button">
                    Add New Items
                </div></a>
                <a href="<?php echo $this->baseUrl ?>items/admin"><div id="button">
                    Edit Items
                </div></a>
                <a href="<?php echo $this->baseUrl ?>logout.php"><div id="button">
                    Logout
                </div></a>
            </div>
        </div>
<?php
    }else{
        if(@$_POST['login']){
            $username   = $_POST['username'];;
            $password	= $_POST['password'];
            if(empty($username) || empty($password)){
                $errors[] = 'Username dan Password harus di isi.';
            }	
            if(count($this->getPengguna("WHERE username='".$username."'")) == 0){
                $errors[] = 'Username belum terdaftar.';
            }else{
                if(md5($password) != $this->getPengguna("WHERE username='".$username."'")[0]->password){
                    $errors[] = 'Username dan Password tidak cocok.';
                }
            }
            if(empty($errors)){
                $_SESSION['username'] = $username;
                $_SESSION['flash'] = "Anda berhasil login!";
                header("Location: admin");
                die();
            }
        }
?>
    <div id="newarrival">
        <div class="newarrivaltitle">
            Login
        </div>
        <div id="arrivalitemcontainer">
            <form name="login" action="" method="post">
                <br>Username : <br><input type="text" id="inputText" name="username" required/>
                <br>Password :<br><input type="password" id="inputText" name="password" required/>
                <br><input type="submit" name="login" id="inputSubmit" value="Login" />
            </form>
            <?php
            if (!(empty($errors))){
                echo '<div id="error"><b>Ada kesalahan saat Login:</b><ul>';
                foreach($errors as $value){
                    echo '<li>'.$value.'</li>';
                }
                echo'</ul></div>';
            }
            ?>
    </div>
<?php
    }
?>
</div>