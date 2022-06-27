<?php

function getPage(){
    $t = preg_replace("/[^0-9]/", '', filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRIPPED));
    $folder = (DISPLAY_TEST_OK) ? ROOT_PATH."testsOK/" : ROOT_PATH."tests/";
    $file = ($t > 0 && file_exists($folder."t{$t}.php")) ? $folder."t{$t}.php" : ROOT_PATH."libs/inc/home.php";
    include($file);
}

function getTestItems(){
    $folder = (DISPLAY_TEST_OK) ? ROOT_PATH."testsOK/" : ROOT_PATH."tests/";
    $items = scandir($folder);
    $testItems = [];
    if(!empty($items)){
        foreach($items as $item){
            if(is_dir(ROOT_PATH."tests/".$item)){ continue; }
            if($item === '..' || $item ==='.'){ continue;}
            $p = pathinfo($item);
            if($p['extension'] == 'php'){
                $testItems[] = [
                    'f' => str_replace(".php", "", $p['basename']),
                    'p' => preg_replace("/[^0-9]/", '', $p['basename'])
                ];
            }

        }
    }
    return $testItems;
}

function getFileSizeName($size, $precision = 2) {
    $un = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
    $i = 0;
    while (($size / 1024) > 0.9) {
        $size = $size / 1024;
        $i++;
    }
    return round($size, $precision). " ".$un[$i];
}


function test04ErrorHandle($errno, $errstr, $errfile, $errline, $errcontext=null) {
    echo '<div class="alert alert-danger" role="alert"><b>ERROR ('.$errno.'): </b>'.$errstr.' <small class="text-muted">in '.$errfile.' line '.$errline.'</small></div>';
}

function test04ExceptionHandle($ex) {
    echo '<div class="alert alert-warning" role="alert"><b>EXCEPTION: </b>'.$ex->getMessage().' <small class="text-muted">in '.$ex->getFile().' line '.$ex->getLine().'</small></div>';
}