<?php
echo $this->Html->css(['generalStyle']);
$this->assign('title', "My Fantastical Gallery - Home");
?>

<h1>My Fantastical Gallery</h1>
<table id="ls_img">
    <?php
    if (sizeof($images) == 1) {
        echo "<tr><td>" .$this->Html->image($images[0]['path']). "</td></tr>";
    } else {
        $i = 0;
        $j = 0;
        $size = 0;
        while ($i < 4) {
            echo "<tr>";
            while ($j < 3 && $size < sizeof($images)-1) {
                echo "<td>".$this->Html->image($images[$size]['path'],[]). "</td>";
                $size++;
                $j++;
            }
            echo "</tr>";
            $j = 0;
            $i++;
        }
    }
    ?>
</table>
<p><?php if(sizeof($images) == 1) {
    echo "Auteur: ".$images[0]['author'];
}?></p>
<p><?php if(sizeof($images) == 1) {
    echo "Description: ".$images[0]['description'];
}?></p>
<p><?php if(sizeof($images) == 1) {
    echo "Width: ".$images[0]['width'].", Height: ".$images[0]['height'];
}?></p>

