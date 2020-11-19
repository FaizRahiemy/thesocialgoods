<div id="content">
<?php 
    if (isset($_SESSION['username'])){
        if(@$_POST['submit']){
            $id      = $this->id;
            $keterangan	= $_POST['keterangan'];
            $jenis	= $_POST['jenis'];
            if (empty($_POST['debit'])){
                $debit	= 0;
            }else{
                $debit	= $_POST['debit'];
            }
            if (empty($_POST['kredit'])){
                $kredit	= 0;
            }else{
                $kredit	= $_POST['kredit'];
            }
            $date	= date("Y-m-d H:i:s");
            if($keterangan){
                if ($id == "baru"){
                    $in = $this->insertTransaksi("NULL, '".$keterangan."', '".$date."', ".$debit.", ".$kredit);
                    if ($jenis == "tunai"){
                        $in = $this->updateSaldo($debit + $kredit);
                    }else if ($jenis == "tabungan"){
                        $in = $this->updateSaldo($debit+$kredit);
                        $in = $this->updateTabungan($debit+$kredit);
                    }else{
                        $in = $this->updateTabungan($debit+$kredit);
                    }
                    header("Location: ".$this->baseUrl."admin/jurnal");
                    die();
                    $_SESSION['flash'] = "Anda berhasil menambah transaksi!";
                }else{
                    $in = $this->updateTransaksi("keterangan = '".$keterangan."', debit = ".$debit.", kredit = ".$kredit." WHERE id=".$id);
                    if ($jenis == "tunai"){
                        $in = $this->updateSaldo($debit + $kredit - $viewModel[0]['debit'] + $viewModel[0]['kredit']);
                    }else if ($jenis == "tabungan"){
                        $in = $this->updateSaldo($debit + $kredit - $viewModel[0]['debit'] + $viewModel[0]['kredit']);
                        $in = $this->updateTabungan($debit + $kredit - $viewModel[0]['debit'] + $viewModel[0]['kredit']);
                    }else{
                        $in = $this->updateTabungan($debit + $kredit - $viewModel[0]['debit'] + $viewModel[0]['kredit']);
                    }
                    header("Location: ".$this->baseUrl."admin/jurnal");
                    die();
                    $_SESSION['flash'] = "Anda berhasil mengedit transaksi!";
                }
            }else{
                $errors[] = "Keterangan tidak boleh kosong.";
            }
        }
        if(@$_POST['delete']){
            $id      = $this->id;
            $in = $this->updateSaldo($viewModel[0]['kredit'] - $viewModel[0]['debit']);
            $this->deleteTransaksi("WHERE id=".$id);
            header("Location: ".$this->baseUrl."admin/jurnal");
            die();
            $_SESSION['flash'] = "Anda berhasil menghapus transaksi!";
        }
        if ($this->id != "baru"){
            $transaksi = $viewModel[0];
            $tombol = "Edit";
        }else{
            $transaksi['id'] = $this->getAITransaksi();
            $transaksi['keterangan'] = "";
            $transaksi['debit'] = "";
            $transaksi['kredit'] = "";
            $tombol = "Tambah";
        }
?>
        <div id="content-title">
            <?php echo '<form action="" method="post">
            <input type="text" id="inputText" name="keterangan"/ value="'.$transaksi['keterangan'].'" style="font-size:40px;margin:0px;width:50%;" required>' ?>
        </div>
        <div id="content-info">
            ID : <?php echo $transaksi['id']; ?> | 
            <select name="jenis" id="inputText" style="font-size:16px;width:150px;">
                <option value="tunai">Tunai</option>
                <option value="tabungan">Tabungan</option>
                <option value="tuntab"> Tunai<->Tabungan</option>
            </select>
        </div>
        <div id="content-body">
            Debit : <input type="text" name="debit" id="inputText" value="<?php echo $transaksi['debit'] ?>"/>
            <br>Kredit : <input type="text" name="kredit" id="inputText" value="<?php echo $transaksi['kredit'] ?>"/>
            <br><input type="submit" name="submit" id="inputSubmit" value="<?php echo $tombol ?> Transaksi" /> 
            <?php if ($this->id != "baru"){
                echo '<input type="submit" name="delete" id="inputSubmit" value="Hapus Transaksi" />';
            }?>
            <a href="<?php echo $this->baseUrl ?>admin/jurnal" id="inputSubmit" style="margin-left:10px;color:#ECF0F1; text-decoration:none;">Jurnal</a>
        </div>
<?php
    }else{
        header("Location: ".$this->baseUrl."admin");
        die();
    }
?>
</div>

<div id="widget">
<?php
    $this->getBlogpost("ORDER BY created DESC LIMIT 5");
    $this->getKomentar("ORDER BY date DESC LIMIT 5");
?>
</div>