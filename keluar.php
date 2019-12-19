<?php
if ((empty($kb))||(empty($_SESSION["poiuyt"])&&(@$_SESSION["poiuyt"]!="45b4ba675c1624a922dcc72af03b8a09")))
{die("Dilarang mengakses file ini");}
if (!empty($_GET["crud"]))
{ $dataid=@$_GET["dataid"] or die("Perintah Salah<br/><button onclick=\"bukalaman('keluar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button>");
$hasilcekdata="";
$cekdata=@mysqli_query($kb,"select * from pengeluaran");
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idkeluar"].$barisdata["tanggal"].$barisdata["jumlahkeluar"].$barisdata["keterangan"]);
	 if ($dataid==$kombinasidata)
	 {$hasilcekdata=" where idkeluar='".$barisdata["idkeluar"]."'";break;}
	else
	{$hasilcekdata="";}
	}
}
if (($dataid!="tambah")&&($hasilcekdata==""))
	{die("<div style='width:auto;margin:18% auto;text-align:center;'>"."Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('keluar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button></div>");}
switch ($_GET["crud"]) {
case 'tambah':
?>
<script>
jQuery(document).ready(function(){
jQuery("#pilihjam").val(jQuery("#jm").html());
jQuery("#pilihmenit").val(jQuery("#mn").html());
jQuery("#pilihdetik").val(jQuery("#dk").html());
})

</script>
<?php
 echo "<h3>Tambah Data Pengeluaran</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('keluar','".$dataid."','simpan'); return false;\">";
	echo "<label>Waktu Keluar</label><br/><input type=\"date\" value=\"".date("Y-m-d")."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:50%;\"/> <select id=\"pilihjam\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=24;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\">".$loop."</option>";}
	}
	echo "</select> :  <select id=\"pilihmenit\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=59;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\">".$loop."</option>";}
	}
	echo "</select> :  <select id=\"pilihdetik\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=59;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\">".$loop."</option>";}
	}
	echo "</select><br/>
<label>jumlah keluar</label><br/><input type=\"text\" value=\"\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>keterangan</label><br/><br/><textarea name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;height:45px;\">".@$barisdata["keterangan"]."</textarea><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('keluar')\"></form>";		
die();
break;
		case 'edit':
$cekdata=@mysqli_query($kb,"select * from pengeluaran ".$hasilcekdata);
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ echo "<h3>Edit Data Pengeluaran</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('keluar','".$dataid."','simpan'); return false;\">";
	$waktukeluar=explode(" ",@$barisdata["tanggal"]);
	$ambilwaktu=explode(":",$waktukeluar[1]);
	echo "<label>Waktu Keluar</label><br/><input type=\"date\" value=\"".date("Y-m-d",strtotime($waktukeluar[0]))."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:50%;\"/> <select id=\"pilihjam\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=24;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\"".(("0".$loop)===$ambilwaktu[0]?" selected":"").">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\"".($loop===intval($ambilwaktu[0])?" selected":"").">".$loop."</option>";}
	}
	echo "</select> :  <select id=\"pilihmenit\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=59;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\"".(("0".$loop)===$ambilwaktu[1]?" selected":"").">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\"".($loop===intval($ambilwaktu[1])?" selected":"").">".$loop."</option>";}
	}
	echo "</select> :  <select id=\"pilihdetik\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:auto;\">";
	for ($loop=0;$loop<=59;$loop++)
	{ if ($loop<10)
	{echo "<option value=\"0".$loop."\"".(("0".$loop)===$ambilwaktu[2]?" selected":"").">0".$loop."</option>";}
	else
	{echo "<option value=\"".$loop."\"".($loop===intval($ambilwaktu[2])?" selected":"").">".$loop."</option>";}
	}
	echo "</select><br/>
<label>jumlah keluar</label><br/><input type=\"text\" value=\"".@$barisdata["jumlahkeluar"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>keterangan</label><br/><br/><textarea name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;height:45px;\">".@$barisdata["keterangan"]."</textarea><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('keluar')\"></form>";
	}
	}
else
{echo "Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('keluar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button>";}		
die();
 break;
		case 'simpan':
	if ($dataid=="tambah")
	{$hapus=mysqli_query($kb,"insert into pengeluaran (`tanggal`, `jumlahkeluar`, `keterangan`) values ('".$_POST["datainput"][0]." ".$_POST["datainput"][1].":".$_POST["datainput"][2].":".$_POST["datainput"][3]."', 
'".$_POST["datainput"][4]."', 
'".$_POST["datainput"][5]."'); ");}
else
	{$hapus=mysqli_query($kb,"update pengeluaran set tanggal='".$_POST["datainput"][0]." ".$_POST["datainput"][1].":".$_POST["datainput"][2].":".$_POST["datainput"][3]."', 
jumlahkeluar='".$_POST["datainput"][4]."',
keterangan='".$_POST["datainput"][5]."' ".$hasilcekdata.";");}
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data Pengeluaran Berhasil di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=keluar\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button></a></div>");}
	else
	{die("Data Pengeluaran Gagal di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=keluar\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button></a></div>");}
	break;
		case 'hapus':
	$hapus=mysqli_query($kb,"delete from pengeluaran ".$hasilcekdata);
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data Pengeluaran Berhasil di hapus<br/><button onclick=\"bukalaman('keluar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button></div>");}
	else
	{die("Data Pengeluaran Berhasil di hapus<br/><button onclick=\"bukalaman('keluar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang Data Pengeluaran</button></div>");}
	break;
	
	default:
		break;
}

}
?>
<h2>Data Pengeluaran  <?php if ((empty($_POST["mencari"]))&&((empty($_POST["mencariwaktu"][0]))||(@$_POST["mencariwaktu"][0]=="all")))
{$datayangdicari="";}
else
{$datayangdicari=@$_POST["mencariwaktu"][0];} ?><div style="float:right;font-size:15px;cursor: pointer;"><input type="button" value="tambah" class="kotaktombol"onclick="bukalaman('keluar','tambah','tambah');" style="width:auto;"> <input type="button" value="cari data" class="kotaktombol" onclick="mencaridataform();" style="width:auto;"></div></h2>
<div id="formpencari" style="<?php echo ($datayangdicari===""?"display: none;":""); ?>">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimform" onsubmit="return lakukanpengiriman('keluar','mencari','cari'); return false;">
<label>Cari Data berdasarkan durasi waktu dan keterangan pengeluaran</label><br/>
Dari <select name="mencariwaktu[]" class="kotakisian" style="width:auto;">
<option value="all">Semua</option>
<?php
for ($loop=2019;$loop<=2026;$loop++)
{echo '<option value="'.$loop.'"'.($loop===intval(@$_POST["mencariwaktu"][0])?" selected":($loop===intval(date("Y"))?" selected":"")).'>'.$loop.'</option>';}
?>
</select> <select name="mencariwaktu[]" class="kotakisian" style="width:auto;">
<option value="all">Semua</option>
<?php
for ($loop=1;$loop<=12;$loop++)
{ if ($loop<10)
{echo '<option value="0'.$loop.'"'.(("0".$loop)===@$_POST["mencariwaktu"][1]?" selected":"").'>'.monthtobulan($loop).'</option>';}
else
{echo '<option value="'.$loop.'"'.($loop===intval(@$_POST["mencariwaktu"][1])?" selected":"").'>'.monthtobulan($loop).'</option>';}

}
?>
</select> <span style="padding-left: 13px;">Hingga: <select name="mencariwaktu[]" class="kotakisian" style="width:auto;">
<option value="all">Semua</option>
<?php
for ($loop=2019;$loop<=2026;$loop++)
{echo '<option value="'.$loop.'"'.($loop===intval(@$_POST["mencariwaktu"][2])?" selected":($loop===intval(date("Y"))?" selected":"")).'>'.$loop.'</option>';}
?>
</select> <select name="mencariwaktu[]" class="kotakisian" style="width:auto;">
<option value="all">Semua</option>
<?php
for ($loop=1;$loop<=12;$loop++)
{ if ($loop<10)
{echo '<option value="0'.$loop.'"'.(("0".$loop)===@$_POST["mencariwaktu"][3]?" selected":"").'>'.monthtobulan($loop).'</option>';}
else
{echo '<option value="'.$loop.'"'.($loop===intval(@$_POST["mencariwaktu"][3])?" selected":"").'>'.monthtobulan($loop).'</option>';}

}
?>
</select></span> 
<br/>
Keterangan: <input type="text" value="<?php echo @$_POST["mencari"] ?>" placeholder="Cari Data berdasarkan keterangan pengeluaran" name="mencari" id="kotakformcari" class="kotakisian" style="width:80%;"/><br/>
<input type="submit" value="cari" class="kotaktombol"> <input type="button" onclick="kosongkotakcari('kotakformcari');" value="ulangi" class="kotaktombol"> <input type="button" value="tampilkan seluruh data" class="kotaktombol" onclick="bukalaman('keluar');" style="width:auto;"> <input type="button" value="tutup pencarian" class="kotaktombol" onclick="mencaridataform();" style="width:auto;">
</form></div>
<table cellspacing="0" cellpadding="0">
<tr><th style="width:1%;">No</th><th style="width:18%;">Waktu Keluar</th><th style="width:13%;">Jumlah Keluar</th><th style="width:57.5%;">Keterangan</th><th>Aksi</th></tr>
<?php

$tambahan="";
if ((!empty($_GET["lakukan"]))&&($_GET["lakukan"]=="cari")&&(!empty($_POST["mencariwaktu"][0])))
{ if (!empty($_POST["mencari"]))
{$tambahan=" where ".(@$_POST["mencariwaktu"][0]==="all"?"":(@$_POST["mencariwaktu"][1]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."%' and ":(@$_POST["mencariwaktu"][2]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."%' and ":(@$_POST["mencariwaktu"][3]==="all"?"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-12-31') and ":"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-".@$_POST["mencariwaktu"][3]."-31') and "))))."keterangan like '%".@$_POST["mencari"]."%'";}
else
{$tambahan=(@$_POST["mencariwaktu"][0]==="all"?"":" where ".(@$_POST["mencariwaktu"][0]==="all"?"":(@$_POST["mencariwaktu"][1]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."%' ":(@$_POST["mencariwaktu"][2]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."%' ":(@$_POST["mencariwaktu"][3]==="all"?"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-12-31') ":"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-".@$_POST["mencariwaktu"][3]."-31') ")))));}
}
$cekdata=@mysqli_query($kb,"select * from pengeluaran".$tambahan." order by tanggal desc");
 $nomor=1;
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idkeluar"].$barisdata["tanggal"].$barisdata["jumlahkeluar"].$barisdata["keterangan"]);
	$keterangan=$barisdata["keterangan"];
	if (strlen($barisdata["keterangan"])>39)
		{$keterangan=substr($barisdata["keterangan"],0,35)." ...";}
	$waktunya=strtotime($barisdata["tanggal"]);
	echo "<tr><td style=\"width:1%;\">".$nomor."</td><td id=\"bariskode".$kombinasidata."\" style=\"width:22%;\">".date("d",$waktunya)." ".monthtobulan(date("m",$waktunya)).date(" Y - H:i:s",$waktunya)."</td><td id=\"barisjumlah".$kombinasidata."\" style=\"width:13%;\">".$barisdata["jumlahkeluar"]."</td><td style=\"width:57.5%;\" id=\"barisketerangan".$kombinasidata."\">".$keterangan."</td><td><div class=\"iconcrud crudedit\" onclick=\"bukalaman('keluar','".$kombinasidata."','edit')\"></div> <div class=\"iconcrud crudhapus\" onclick=\"hapusan('keluar','".$kombinasidata."')\"></div></td></tr>";
	$nomor++;
	};
	}
	else
		{echo "<tr><td colspan=\"5\">Tidak Ada Data Pengeluaran</td><tr>";}
?>
</table>