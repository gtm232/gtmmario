<h1 style="color:red; text-align:center;">Halaman yg anda Cari Tidak ada, Silahkan Klik Tombol Berikut Atau Sesi Login Anda Telah Berakhir<br>

   <?php if(isset(Auth::user()->hak_akses)){ ?>	
        <a  href="https://mario.tamanrifa.com"><button style="cursor:pointer;">Kembali ke halaman awal</button></a>
  <?php }else if(!isset(Auth::user()->hak_akses)){ ?>
    
    <a  href="https://mario.tamanrifa.com/bulanan"><button style="cursor:pointer;">Kembali ke halaman awal</button></a>
    
    <?php } ?>
   
</h1>

<h5 style="text-align:center;">By : Admin Mario</h5>
