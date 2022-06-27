<?php
if (!defined("INC_FILE_LOADED")) {
    die("...");
}
include(ROOT_PATH . 'assets/tpl/_t002.php');

/**
 * Leer las imágenes del directorio ROOT_PATH.'/resources/images/'
 * Listarlas ordenadas por el indice 01,02,03 etc que contiene en el nombre zzz_01.ext
 * Imprimir las imágenes usando el template HTML listando la información si está disponible (img, nombre archivo, ancho, alto, tipo mime, tamaño, artista/autor)
 **/

$info = array();
$img = array();
$merge= array();
$p = 0;
$folder  = "./resources/images/";
if ($trade = opendir($folder)) {
    while (false !== ($file = readdir($trade))) {
        $url=$folder.$file;
        if (preg_match("/gif/i", $file) || preg_match("/jpg/i", $file) || preg_match("/png/i", $file)){
          $img[]="<img class='rounded-circle shadow-1-strong me-3' src='$url' alt='avatar' width='80' height='80'/>";
          $archivo = exif_read_data($url, 'COMPUTED');
            foreach ($archivo as $key => $value) { $info[$key][$p] = $value; }
        }
    $p++;
    }
    closedir($trade);
}
array_filter($info);
foreach ($info['FileName'] as $keyName => $name) { $FileName[]=$name; }
foreach ($info['FileName'] as $keyName => $name) { $FileNameId[]=substr($name, -6); }
foreach ($info["COMPUTED"] as $keyCom) { $FileWidth[]=$keyCom["Width"]; $FileHeight[]=$keyCom["Height"];}
foreach ($info['MimeType'] as $keyType => $type) { $FileType[]=$type;}
foreach ($info['FileSize'] as $keySize => $size) { $FileSize[]=$size;}
foreach ($info['Artist'] as $keyAuth => $author) { $FileAuth[]=$author;}

for ($i = 0; $i < count($img); $i++) {
    $merge[] = [$FileNameId[$i], $img[$i], $FileName[$i], $FileWidth[$i], $FileHeight[$i], $FileType[$i], $FileSize[$i], $FileAuth[$i]];
}
asort($merge);
?>

<div class="card">
    <div class="card-body">
        <table id="tab" class="table">
            <thead>
            <tr>
                <th scope="col" style="width:100px">Thumb</th>
                <th scope="col">Name</th>
                <th scope="col">Width</th>
                <th scope="col">Height</th>
                <th scope="col">Type</th>
                <th scope="col">Size</th>
                <th scope="col">Artist/author</th>
            </tr>
            </thead>
            <tbody>
            <!-- START ROW INFO SNIPPET -->

            <?php
                foreach($merge as $line){
                    echo "<tr>";
                    foreach($line as $dato){
                    echo "<td>$dato</td>";
                    }
                    echo "</tr>";
                }
            ?>
            
            <!-- END ROW INFO SNIPPET -->

            </tbody>
        </table>
    </div>
</div>
<script>$(document).ready(function (){ $("#tab td:nth-child(1)").hide(); }); </script>