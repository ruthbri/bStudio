<?php
set_exception_handler("test04ExceptionHandle");
set_error_handler("test04ErrorHandle");

class Test04Helper
{

    private static function printH2Title(string $funcName, string $sample)
    {
        echo '<h3 class="mt-3"><code>' . $funcName . ':</code><br />';
        switch ($funcName) {
            case 'printOnlyNumbersFromString':
                echo 'Extraer y retornar todos los números a partir de un string dado:';
                break;
            case 'sortArrayByIndexName':
                echo 'Devolver array multidimensional ordenado por la clave "name" de cada elemento:';
                break;
            case 'getMondaysFromDateRange':
                echo 'Devolver array que contenga todos los lunes incluidos en un rango dado, formato dd/mm/AAAA:';
                break;
            case 'getIpFromCheckRobotsTxtLog':
                echo 'Devolver array con listado de ip\' únicas que hayan consultado el enlace a robots.txt en el servidor:';
                break;
            default:
                echo '---';
        }
        echo '</h3>';
        if($sample != ""){
            echo '<small>Muestra: <code>'.$sample.'</code></small><br />';
        }
    }

    private static function printAlert(string $funcName, int $totalItems, int $totalOK, string $sample='')
    {
        $ratio = ($totalOK > 0) ? $totalItems / $totalOK : 0;
        $cls = 'danger';
        if ($ratio == 1) {
            $cls = 'success';
        } else if ($ratio > 0) {
            $cls = 'warning';
        }
        echo self::printH2Title($funcName, $sample);
        echo '<div class="alert alert-' . $cls . ' mt-2" role="alert"><b> res: ' . $totalOK . ' / ' . $totalItems . '</b></div>';
        echo '<hr />';
    }

    private static function testPrintOnlyNumbersFromString()
    {
        $txt01= "Ah34xz89$%64x0015_ <%32SDFg4DSF";
        $txt02= "sz___sd%64x0015_ <%524--3Fg4DSF";
        $txt03= "000000Fdw287431";
        $total = 0;
        $resp0 = printOnlyNumbersFromString($txt01);
        $resp1 = printOnlyNumbersFromString($txt02);
        $resp2 = printOnlyNumbersFromString($txt03);
        $total += ($resp0 == "3489640015324") ? 1 : 0;
        $total += ($resp1 == "64001552434") ? 1 : 0;
        $total += ($resp2 == "000000287431") ? 1 : 0;
        self::printAlert("printOnlyNumbersFromString", 3, $total, '"'.$txt01 .'" | "' .$txt02.'" | "'.$txt03.'"');
    }

    private static function testSortArrayByIndexName()
    {
        $total = 0;
        $arr01 = [
            ['i' => 21342135, 'name' => 'Z345d', 'key' => []],
            ['i' => 6488, 'name' => 'X810', 'key' => ['n', 'm']],
            ['i' => 1500, 'name' => 'A325', 'key' => ['n', 'm']],
        ];
        $resp = sortArrayByIndexName($arr01);

        if(is_array($resp)){
            $funcScore = 0;
            $funcScore += (isset($resp[0], $resp[0]['name']) && $resp[0]['name']=='A325') ? 1 : 0;
            $funcScore += (isset($resp[1], $resp[1]['name']) && $resp[1]['name']=='X810') ? 1 : 0;
            $funcScore += (isset($resp[2], $resp[2]['name']) && $resp[2]['name']=='Z345d') ? 1 : 0;
            $total += ($funcScore > 0)? $funcScore/3 : 0;
        }
        $arr02 = [
            ['c' => "aedr", 'name' => 'h481'],
            ['c' => "tds", 'name' => 'csa98u23'],
            ['c' => false, 'name' => 'bx535'],
        ];
        $resp = sortArrayByIndexName($arr02);

        if(is_array($resp)){
            $funcScore = 0;
            $funcScore += (isset($resp[0], $resp[0]['name']) && $resp[0]['name']=='bx535') ? 1 : 0;
            $funcScore += (isset($resp[1], $resp[1]['name']) && $resp[1]['name']=='csa98u23') ? 1 : 0;
            $funcScore += (isset($resp[2], $resp[2]['name']) && $resp[2]['name']=='h481') ? 1 : 0;
            $total += ($funcScore > 0)? $funcScore/3 : 0;
        }

        $arr03 = [
            ['c' => 1, 'k'=> ['name'=>"213"], 'name' => 'mz54'],
            ['c' => 32, 'k'=> ['name'=>213], 'name' => 'mx87'],
            ['c' => 1, 'k'=> ['name'=>"213"], 'name' => 'my88'],
        ];
        $resp = sortArrayByIndexName($arr03);

        if(is_array($resp)){
            $funcScore = 0;
            $funcScore += (isset($resp[0], $resp[0]['name']) && $resp[0]['name']=='mx87') ? 1 : 0;
            $funcScore += (isset($resp[1], $resp[1]['name']) && $resp[1]['name']=='my88') ? 1 : 0;
            $funcScore += (isset($resp[2], $resp[2]['name']) && $resp[2]['name']=='mz54') ? 1 : 0;
            $total += ($funcScore > 0)? $funcScore/3 : 0;
        }


        self::printAlert("sortArrayByIndexName", 3, $total, json_encode([$arr01, $arr02, $arr03]));
    }

    private static function testGetMondaysFromDateRange(){
        $total=0;
        $dtFrom01 = '05/01/2010';
        $dtTo01 = '08/03/2010';
        $resp = getMondaysFromDateRange($dtFrom01, $dtTo01);
        if(!is_array($resp)) { $resp =  []; }
        $respOK = ['11/01/2010', '18/01/2010', '25/01/2010', '01/02/2010', '08/02/2010', '15/02/2010', '22/02/2010','01/03/2010','08/03/2010'];
        sort($resp);
        sort($respOK);
        if ($resp===$respOK) {  $total++; }

        $dtFrom02 = '10/02/2022';
        $dtTo02 = '27/02/2022';
        $resp = getMondaysFromDateRange($dtFrom02, $dtTo02);
        if(!is_array($resp)) { $resp =  []; }
        $respOK = ['14/02/2022', '21/02/2022'];
        sort($resp);
        sort($respOK);
        if ($resp===$respOK) {  $total++; }

        $dtFrom03 = '16/03/2022';
        $dtTo03 = '22/06/2022';
        $resp = getMondaysFromDateRange($dtFrom03, $dtTo03);
        if(!is_array($resp)) { $resp =  []; }
        $respOK = ['21/03/2022', '28/03/2022', '04/04/2022', '11/04/2022', '18/04/2022', '25/04/2022','02/05/2022','09/05/2022','16/05/2022','23/05/2022','30/05/2022','06/06/2022','13/06/2022','20/06/2022'];
        sort($resp);
        sort($respOK);
        if ($resp===$respOK) {  $total++; }

        self::printAlert("getMondaysFromDateRange", 3, $total, "$dtFrom01-$dtTo01 | $dtFrom02-$dtTo02 | $dtFrom03-$dtTo03");

    }

    private static function testGetIpFromCheckRobotsTxtLog(){
        $total=0;
        $path01 = ROOT_PATH.'resources/logs/apache.log';
        $resp = getIpFromCheckRobotsTxtLog($path01);
        if(!is_array($resp)){ $resp= [];}
        $respOK = ['66.249.67.197','66.249.67.209','66.249.67.213','66.249.67.232','66.249.68.229','66.249.67.242','119.63.196.115','66.249.68.241','66.249.67.198','66.249.67.228','66.249.67.229','66.249.68.246','66.249.72.13','206.183.1.74','66.249.68.230','66.249.67.148','66.249.68.180','38.99.82.233','38.99.82.234','66.249.72.99','38.99.82.230','38.99.82.232','66.249.72.170','66.249.72.79','38.99.82.231','38.99.82.239','66.249.67.132','38.99.82.238','66.249.67.134','220.181.108.179','123.125.71.19','220.181.108.175','38.99.82.205','38.99.82.237','38.99.82.208','38.99.82.207','38.99.82.209','38.99.82.210','38.99.82.206','38.99.82.244','38.99.82.243','220.181.108.180','220.181.108.176','119.63.196.38','119.63.196.48','66.249.72.217','119.63.196.110','173.224.112.96','174.133.5.250','216.145.17.190','64.246.165.190','69.58.178.59','119.63.196.18','66.249.71.231','119.63.196.80','119.63.196.113','66.249.72.182','66.249.72.225','66.249.68.248','66.249.67.153','66.249.67.166','66.249.71.147','66.249.71.240','64.246.165.170','64.246.165.150','66.249.67.170','66.249.71.150','66.249.71.137','119.63.196.75','66.249.67.248','207.46.13.51','66.249.67.129','157.55.17.103','119.63.196.77','64.246.165.160','119.63.196.10','64.246.165.140','66.249.68.193','85.118.242.195','91.205.96.13','66.249.71.234','66.249.71.211','38.99.82.227','38.99.82.229','38.99.82.226','38.99.82.228','38.99.82.253','38.99.82.248','38.99.82.245','38.99.82.247','66.249.72.33','69.58.178.57','66.249.72.54','69.58.178.58','119.63.196.105','119.63.196.55','85.17.29.107','65.52.109.200','180.76.5.111','64.246.187.42','95.108.157.252','195.221.21.227','67.195.115.213','67.195.112.233','119.63.196.19','119.63.196.103','93.158.147.8','180.76.5.159','119.63.196.108','119.63.196.56','220.181.108.167','119.63.196.9','66.249.71.251','66.249.68.201','220.181.108.170','180.76.5.96','212.113.37.106','119.63.196.82','66.249.67.165','66.249.67.208','180.76.5.20','66.249.71.214'];
        sort($resp);
        sort($respOK);
        if ($resp===$respOK) {  $total++; }

        $path02 = ROOT_PATH.'resources/logs/apache2.log';
        $resp = getIpFromCheckRobotsTxtLog($path02);
        if(!is_array($resp)){ $resp= [];}
        $respOK = ['93.158.147.8','207.46.13.51','180.76.5.159','66.249.72.33','66.249.72.54','95.108.157.252','119.63.196.108','119.63.196.56','220.181.108.167'];
        sort($resp);
        sort($respOK);
        if ($resp===$respOK) {  $total++; }

        self::printAlert("getIpFromCheckRobotsTxtLog", 2, $total, "$path01 | $path02");
    }

    public static function runFunctionStack()
    {
        self::testPrintOnlyNumbersFromString();
        self::testSortArrayByIndexName();
        self::testGetMondaysFromDateRange();
        self::testGetIpFromCheckRobotsTxtLog();


    }

}