<?php
if (!defined("INC_FILE_LOADED")) {
    die("...");
}
include(ROOT_PATH . 'assets/tpl/_t001.php');

/**
 *  Archivo ROOT_PATH.'/resources/comments.json'
 *  Leer el archivo e imprimirlo en pantalla usando el template HTML, intentando que el script consuma la menor memoria posible
 *  Por cada comentario imprimir los datos en línea en lugar de {{name}} {{email}} {{id}} y {{body}}
 **/

?>
<section style="background-color: #f7f6f6;">
    <div class="container my-5 py-5 text-dark">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <!-- start COMMENT BOX -->
                <div class="card mb-3">
                    <div class="card-body" id="cardUs">
             
                    </div>
                </div>
                <!-- end COMMENT BOX -->
            </div>
        </div>
    </div>
</section>
<script>
   
   $(document).ready(function (){

        $.getJSON('./resources/comments.json', function(data){

            for(var i = 0; i < 20; i++) {
                //$("#nameUs").html(data[i]['name']); 
                $("#cardUs").append("<div class='card-body' id='cardUs'><div class='d-flex flex-start'><img class='rounded-circle shadow-1-strong me-3' src='assets/images/default.jpg' alt='avatar' width='40' height='40'/><div class='w-100'><div class='d-flex justify-content-between align-items-center mb-3'><h6 class='text-primary fw-bold mb-0'>"+data[i]['name']+"<span class='text-dark ms-2'>"+data[i]['email']+"</span></h6><p class='mb-0'>"+data[i]['id']+"</p></div></div></div><div class='d-flex justify-content-between align-items-center'><p class='small mb-0' style='color: #aaa;'>"+data[i]['body']+"</p></div></div>");
                }

            });
      });            

</script>
