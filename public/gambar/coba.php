<?php
   echo $_POST['file'];
   $base64_pdf1 = str_replace(" ","",$_POST['file']);
   $base64_pdf	= substr($base64_pdf1,21);
   $base64_decode = base64_decode($base64_pdf);
   
   $pdf = fopen('test_export.png', 'w');
   fwrite($pdf, $base64_decode);
   //fwrite($pdf);
   
?>    