<div id="widget-container">
    <div class="widget-title">Komentar Terbaru</div>
    <?php
        echo '<ul>';
        foreach($komentar as $isikomentar){
            $komencoretan = $isikomentar->coretan;
            $komenkreasi = $isikomentar->kreasi;
            $komenbisnis = $isikomentar->bisnis;
            if ($isikomentar->coretan != 0) {
                $jenisArtikel = "coretan";
                $artikel = $isikomentar->getArtikel("");
            }
            if ($isikomentar->kreasi != 0) {
                $jenisArtikel = "kreasi";
                $artikel = $isikomentar->getArtikel("");
            }
            if ($isikomentar->bisnis != 0) {
                $jenisArtikel = "bisnis";
                $artikel = $isikomentar->getArtikel("");
            }
            $isiblogpost = $artikel[0];
            echo '<li><a href="'.$this->baseUrl."".$jenisArtikel.'/baca/'.$isiblogpost->id.'-'.$isiblogpost->alias.'">'.$isiblogpost->judul .'</a>    dikomentari oleh    '.$isikomentar->nama;
            echo '<br>Ditulis : '.date("j F Y", strtotime($isikomentar->date)).' jam '.date("G:i", strtotime($isikomentar->date)).' WIB</li>';
        }
        echo '</ul>';
    ?>
</div>