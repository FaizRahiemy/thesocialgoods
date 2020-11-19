<div id="widget-container">
    <div class="widget-title">Coretan Terbaru</div>
    <ul>
    <?php
        foreach ($blogpost as $isiblogpost){
            echo '<li><a href="'.$this->baseUrl.'coretan/baca/'.$isiblogpost->id.'-'.$isiblogpost->alias.'">'.$isiblogpost->judul.'</a>';
            echo '<br>Ditulis : '.date("j F Y", strtotime($isiblogpost->created)).' jam '.date("G:i", strtotime($isiblogpost->created)).' WIB</li>';
        }
    ?>
    </ul>
</div>