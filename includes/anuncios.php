
<div class = "anuncio">
    <?php
    $banner['1'] ="<img class =\"imganuncio\" src=\"img/Anuncio1.jpg\">";
    $banner['2'] ="<img class =\"imganuncio\" src=\"img/GTA.jpg\">";
    $banner['3'] ="<img class =\"imganuncio\" src=\"img/Anuncio1.jpg\">";
    $banner['4'] ="<img class =\"imganuncio\" src=\"img/GTA.jpg\">";

    $randomisa = rand(1,4);
    print $banner[$randomisa]; 
    // <img class ="imganuncio" src="img/anu.jpg" alt="">   
    ?>
</div>


