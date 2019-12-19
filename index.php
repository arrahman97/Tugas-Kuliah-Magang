<?php
if (!(session_start()))
{ session_start(); }
// $c = koneksi ke server 
// $kb = koneksi ke database
// untuk mengunakan perintah php yang mysql itu mengunakan koneksi database / $kb ;
$lokasiweb = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$lokasiweb .= "://".$_SERVER['HTTP_HOST'];
$lokasiweb .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/';

$c=@mysqli_connect("localhost","root","");
$kb=@mysqli_connect("localhost","root","","dbistec");
if ((!($kb))&&(mysqli_connect_errno()=="1049"))
{mysqli_query($c,"CREATE DATABASE IF NOT EXISTS `dbistec`;");
header("location:index.php");
 }
function monthtobulan($idb="")
{ if ($idb=="")
{return "";}
$bulannya=explode("-", "Kosong-Januari-Februari-Maret-April-Mei-Juni-Juli-Agustus-September-Oktober-November-Desember");
return $bulannya[intval($idb)];
}
function bacakelas($kodenya="")
{ if ($kodenya=="")
{return "";}
return substr($kodenya,0,1).(substr($kodenya,1,1)==="1"?"A":"B");
}
function bacaabsen($kodenya="")
{ if ($kodenya=="")
{return "";}
return (intval(substr($kodenya,2,1))===0?substr($kodenya,3,1):substr($kodenya,2,2));
}
mysqli_query($kb,"CREATE TABLE IF NOT EXISTS `tbl_siswa` (
  `idsiswa` bigint(255) Not Null AUTO_INCREMENT,
  `kd_byr` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jns_klmn` varchar(1) NOT NULL,
  `spp` bigint(8) NOT NULL,
  `dpp` bigint(8) NOT NULL,
  `makan` bigint(8) NOT NULL,
  `snack` bigint(8) NOT NULL,
  `pomg` bigint(8) NOT NULL,
  `eks_eng` bigint(8) NOT NULL,
  `eks_rob` bigint(8) NOT NULL,
  `eks_fut` bigint(8) NOT NULL,
  `eks_arc` bigint(8) NOT NULL,
  `eks_kar` bigint(8) NOT NULL,
  `smt_1` bigint(8) NOT NULL,
  `smt_2` bigint(8) NOT NULL,
  `buku` bigint(8) NOT NULL,
  `srgm` bigint(8) NOT NULL,
  `lain` double NOT NULL,
  primary key (`idsiswa`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

mysqli_query($kb,"CREATE TABLE IF NOT EXISTS `tbl_bayar` (
  `idbayar` bigint(255) Not Null AUTO_INCREMENT,
  `kd_byr` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `spp` bigint(8) NOT NULL,
  `dpp` bigint(8) NOT NULL,
  `makan` bigint(8) NOT NULL,
  `snack` bigint(8) NOT NULL,
  `pomg` bigint(8) NOT NULL,
  `eks_eng` bigint(8) NOT NULL,
  `eks_rob` bigint(8) NOT NULL,
  `eks_fut` bigint(8) NOT NULL,
  `eks_arc` bigint(8) NOT NULL,
  `eks_kar` bigint(8) NOT NULL,
  `smt_1` bigint(8) NOT NULL,
  `smt_2` bigint(8) NOT NULL,
  `buku` bigint(8) NOT NULL,
  `srgm` bigint(8) NOT NULL,
  `lain` double NOT NULL,
  `keterangan` longtext NOT NULL,
  primary key (`idbayar`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

mysqli_query($kb,"CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `idkeluar` bigint(255) Not Null AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `jumlahkeluar` bigint(8) NOT NULL,
  `keterangan` longtext NOT NULL,
  primary key (`idkeluar`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

$tidakkenal="Maaf, Perintah Anda tidak dikenal";
if (!empty($_GET["do"]))
{ 
	if ($_GET["do"]=="logout")
{
$_SESSION["poiuyt"]="";
}
else
if ($_GET["do"]=="tampil")
{ if (!empty($_GET["page"]))
{ if (file_exists($_GET["page"].".php"))
{require ($_GET["page"].".php");die();}
else
{die("Maaf, ".$_GET["page"]." belum dibuat");}; }
else
{die($tidakkenal);}
}
else
{die($tidakkenal);}
}
$judulweb="Sistem Informasi Pembayaran Sekolah Dasar Islam Terpadu - ISTEC Labschool Bekasi";
?>

<html>
<head>
<title><?php echo $judulweb; ?></title>
<link rel="icon" href="logo.png">
<link rel="stylesheet" href="fadhil.css"/>
<script type="text/javascript" src="jquery-3.4.1.js"></script>
<script type="text/javascript" src="jquery.PrintArea.js"></script>
<script type="text/javascript" src="jamrud.js"></script>
</head>
<body style="background:url('guru.jpg') no-repeat; background-size:100% 100%;background-attachment:fixed;margin: 0;padding:0;">
<?php
if ((!empty($_POST["usrname"])&&($_POST["usrname"]=="admin")&&!empty($_POST["paswd"])&&(md5($_POST["paswd"])=="45b4ba675c1624a922dcc72af03b8a09"))||(!empty($_SESSION["poiuyt"])&&($_SESSION["poiuyt"]=="45b4ba675c1624a922dcc72af03b8a09")))
{ 
	$_SESSION["poiuyt"]="45b4ba675c1624a922dcc72af03b8a09";
	//echo $_SESSION["poiuyt"];
 ?>
<a href="index.php?do=logout" style="float:right;"> <input type="button" value="log out" class="kotaktombol"> </a>
<img src="logo.png" class="logotop" onclick="bukamenu();" />
<script>
<?php
if (!empty($_GET["kembalike"]))
{ ?>
jQuery(document).ready(function(){
bukalaman('<?php echo $_GET["kembalike"]; ?>');
})
<?php 
}
?>
function bukamenu() {
if (jQuery(".menusamping").css("display")=="none")
{jQuery(".menusamping").show("slow");jQuery(".logotop").hide("slow");}
else
{jQuery(".menusamping").hide("slow");jQuery(".logotop").show("slow");}
} 
function bukalaman(datanya="",iddata="",pilihcrud="") {
if (datanya=="")
{return false;}
jQuery(".kotakmenu").removeClass("kotakmenusekarang");
jQuery("."+datanya).addClass("kotakmenusekarang");
jQuery(".isinya").load("index.php?do=tampil&page="+datanya+"&crud="+pilihcrud+"&dataid="+iddata);
}
function mencaridataform()
{if (jQuery("#formpencari").css("display")=="none")
{jQuery("#formpencari").show("slow");}
else
{jQuery("#formpencari").hide("slow");}
}
function lakukanpengiriman(datanya="",iddata="",lakukanapa="") {
if ((datanya=="")||(iddata=="")||(lakukanapa==""))
{return false;}
if (lakukanapa=="simpan")
{var formData = new FormData(jQuery('#pengirimform')[0]);
    formData.append("upload_file", true);
jQuery.ajax({
            url: "index.php?do=tampil&page="+datanya+"&crud="+lakukanapa+"&dataid="+iddata,
            type: 'POST',
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function(hasilnya){
            jQuery(".isinya").html(hasilnya);
            return false;
            },
        });
}
else
{jQuery.post("index.php?do=tampil&page="+datanya+(datanya==="laporan"?"&crud=":"&lakukan=")+lakukanapa+(datanya==="laporan"?"&dataid="+iddata:""),jQuery("#pengirimform"+(datanya==="laporan"?iddata:"")).serialize(), function(hasilnya){
if (hasilnya!="")
  {jQuery("."+(datanya==="laporan"?"areapercetakan":"isinya")).html(hasilnya);}
return false;
});}

return false;
}
function hapusan(datanya="",iddata="") {
if ((datanya=="")||(iddata==""))
{return false;}
if (datanya=="siswa")
{var konfirmasi=confirm("Apakah Anda yakin untuk menghapus data "+datanya+"\nKelas: "+jQuery("#bariskode"+iddata).html()+"\nNo absen: "+jQuery("#barisabsen"+iddata).html()+"\nNama Siswa: "+jQuery("#barisnama"+iddata).html());}
else
if (datanya=="bayar")
{var konfirmasi=confirm("Apakah Anda yakin untuk menghapus data "+datanya+"\nKelas: "+jQuery("#bariskode"+iddata).html()+"\nNo absen: "+jQuery("#barisabsen"+iddata).html()+"\nNama Siswa: "+jQuery("#barisnama"+iddata).html()+"\nBulan Bayar: "+jQuery("#barisbulan"+iddata).html()+"\nStatus Pembayaran: "+jQuery("#barisstatus"+iddata).html());}
else
if (datanya=="setting")
{var konfirmasi=confirm("Apakah Anda yakin untuk menghapus seluruh data "+iddata);}
else
{var konfirmasi=confirm("Apakah Anda yakin untuk menghapus data pengeluaran\nWaktu pengeluaran: "+jQuery("#bariskode"+iddata).html()+"\nJumlah pengeluaran: "+jQuery("#barisjumlah"+iddata).html()+"\nJDengan keterangan: "+jQuery("#barisketerangan"+iddata).html());}
if (konfirmasi)
{jQuery(".isinya").load("index.php?do=tampil&page="+datanya+"&crud=hapus&dataid="+iddata);}
}
function kosongkotakcari(tujuan="")
{ if (tujuan=="")
{return false;}
jQuery("#"+tujuan).val("");
}
</script>
<div class="menusamping">
<div class="tomboltutup" onclick="bukamenu();">X</div>
<img src="logo.png" class="logo"/>
<div class="kotakgaris"></div>
<div style="text-align: center;"><?php echo date("d F Y"); ?> - <span id="jm"><?php echo date("H"); ?></span>:<span id="mn"><?php echo date("i"); ?></span>:<span id="dk"><?php echo date("s"); ?></span></div>
<div class="kotakgaris"></div>
<div class="kotakmenu siswa" onclick="bukalaman('siswa');">data siswa <img src="sudutkiri.png" class="sudut"/></div>
<div class="kotakmenu bayar" onclick="bukalaman('bayar');">pembayaran <img src="sudutkiri.png" class="sudut"/></div>
<div class="kotakmenu keluar" onclick="bukalaman('keluar');">pengeluaran <img src="sudutkiri.png" class="sudut"/></div>
<div class="kotakmenu laporan" onclick="bukalaman('laporan');">cetak laporan <img src="sudutkiri.png" class="sudut"/></div>
<div class="kotakmenu setting" onclick="bukalaman('setting');">setting <img src="sudutkiri.png" class="sudut"/></div>
</div><div style="width:100%;height: 45px;"></div>
<div class="kotakisiweb">
<div class="isinya"><?php echo "<div style='width:auto;margin:18% auto;text-align:center;'>".$judulweb."</div>"; ?></div>
</div> 
<?php	
}
else
{
?>
<div class="boxlogin">
<h2 style="margin-top: 0;">Silahkan login</h2>
<table class="kotaklogin" style="width:100%;">
<tr>
<td style="width:36%;text-align: right;"><img src="gembok.png" style="width:81%;"></td>
<td style="width:50%;padding-left: 9px;"><form action="index.php" method="post">
	<label>Username:</label><br/>
<input type="text" name="usrname" class="kotakisian" placeholder="masukkan Username Anda"><br/>
	<label>Password:</label><br/>
<input type="password" name="paswd" class="kotakisian" placeholder="masukkan password Anda"><br/>
<input type="submit" name="" class="kotaktombol" value="login"> <input class="kotaktombol" type="reset" value="ulangi">
</form>
</div>
<?php
};
?>
</body>
</html>
