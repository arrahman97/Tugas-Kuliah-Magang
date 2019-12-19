<?php
if ((empty($kb))||(empty($_SESSION["poiuyt"])&&(@$_SESSION["poiuyt"]!="45b4ba675c1624a922dcc72af03b8a09")))
{die("Dilarang mengakses file ini");}
if (!empty($_GET["crud"]))
{ $dataid=@$_GET["dataid"] or die("Perintah Salah<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button>");
$hasilcekdata=$untukdisimpan="";
$cekdata=@mysqli_query($kb,"select * from tbl_siswa");
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idsiswa"].$barisdata["kd_byr"].$barisdata["nama"].$barisdata["jns_klmn"]);
	 if ($dataid==$kombinasidata)
	 {$hasilcekdata=" where idsiswa='".$barisdata["idsiswa"]."'"; $untukdisimpan=" where kd_byr='".$barisdata["kd_byr"]."' and nama='".$barisdata["nama"]."'"; break;}
	else
	{$hasilcekdata=$untukdisimpan="";}
	}
}
if (($dataid!="tambah")&&($hasilcekdata==""))
	{die("<div style='width:auto;margin:18% auto;text-align:center;'>"."Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button></div>");}
switch ($_GET["crud"]) {
case 'tambah':
 echo "<h3>Tambah Data Siswa</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('siswa','".$dataid."','simpan'); return false;\">";
	echo 'Pilih kelas: <select name="datainput[]" class="kotakisian" style="width:auto;">';
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1">'.$loop.'A</option><option value="'.$loop.'2">'.$loop.'B</option>';}
echo '</select> - ';
echo "Nomor Urut Absen: <input type=\"number\" value=\"".@$barisdata["kd_byr"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:40%;\" maxlength=\"2\"/><br/>
<label>Nama Siswa</label><br/><input type=\"text\" value=\"".@$barisdata["nama"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Jenis Kelamin</label><br/><select name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"><option value=\"l\">Laki - Laki</option><option value=\"p\" ".(strtolower(@$barisdata["jns_klmn"])==="p"?"selected":"").">Perempuan</option></select><br/>
<label class=\"besar\">spp</label><br/><input type=\"text\" value=\"".@$barisdata["spp"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label class=\"besar\">dpp</label><br/><input type=\"text\" value=\"".@$barisdata["dpp"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>makan</label><br/><input type=\"text\" value=\"".@$barisdata["makan"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>snack</label><br/><input type=\"text\" value=\"".@$barisdata["snack"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label class=\"besar\">pomg</label><br/><input type=\"text\" value=\"".@$barisdata["pomg"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Ingris</label><br/><input type=\"text\" value=\"".@$barisdata["eks_eng"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul robotic</label><br/><input type=\"text\" value=\"".@$barisdata["eks_rob"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Futsal</label><br/><input type=\"text\" value=\"".@$barisdata["eks_fut"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Memanah</label><br/><input type=\"text\" value=\"".@$barisdata["eks_arc"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul karate</label><br/><input type=\"text\" value=\"".@$barisdata["eks_kar"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Keg. Semester 1</label><br/><input type=\"text\" value=\"".@$barisdata["smt_1"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Keg. Semester 2</label><br/><input type=\"text\" value=\"".@$barisdata["smt_2"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Buku</label><br/><input type=\"text\" value=\"".@$barisdata["buku"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Seragam</label><br/><input type=\"text\" value=\"".@$barisdata["srgm"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Lainnya</label><br/><input type=\"text\" value=\"".@$barisdata["lain"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('siswa')\"></form>";		
die();
break;
		case 'edit':
$cekdata=@mysqli_query($kb,"select * from tbl_siswa ".$hasilcekdata);
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ echo "<h3>Edit Data Siswa</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\"  enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('siswa','".$dataid."','simpan'); return false;\">";
	echo 'Pilih kelas: <select name="datainput[]" class="kotakisian" style="width:auto;">';
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1"'.(($loop."A")===bacakelas(@$barisdata["kd_byr"])?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."B")===bacakelas(@$barisdata["kd_byr"])?" selected":"").'>'.$loop.'B</option>';}
echo '</select> - ';
echo "Nomor Urut Absen: <input type=\"number\" value=\"".bacaabsen(@$barisdata["kd_byr"])."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:40%;\" maxlength=\"2\"/><br/><label>Nama Siswa</label><br/><input type=\"text\" value=\"".@$barisdata["nama"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Jenis Kelamin</label><br/><select name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"><option value=\"l\">Laki - Laki</option><option value=\"p\" ".(strtolower(@$barisdata["jns_klmn"])==="p"?"selected":"").">Perempuan</option></select><br/>
<label class=\"besar\">spp</label><br/><input type=\"text\" value=\"".@$barisdata["spp"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label class=\"besar\">dpp</label><br/><input type=\"text\" value=\"".@$barisdata["dpp"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>makan</label><br/><input type=\"text\" value=\"".@$barisdata["makan"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>snack</label><br/><input type=\"text\" value=\"".@$barisdata["snack"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label class=\"besar\">pomg</label><br/><input type=\"text\" value=\"".@$barisdata["pomg"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Ingris</label><br/><input type=\"text\" value=\"".@$barisdata["eks_eng"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul robotic</label><br/><input type=\"text\" value=\"".@$barisdata["eks_rob"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Futsal</label><br/><input type=\"text\" value=\"".@$barisdata["eks_fut"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul Memanah</label><br/><input type=\"text\" value=\"".@$barisdata["eks_arc"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Ekskul karate</label><br/><input type=\"text\" value=\"".@$barisdata["eks_kar"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Keg. Semester 1</label><br/><input type=\"text\" value=\"".@$barisdata["smt_1"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Keg. Semester 2</label><br/><input type=\"text\" value=\"".@$barisdata["smt_2"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Buku</label><br/><input type=\"text\" value=\"".@$barisdata["buku"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Seragam</label><br/><input type=\"text\" value=\"".@$barisdata["srgm"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>Lainnya</label><br/><input type=\"text\" value=\"".@$barisdata["lain"]."\" name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('siswa')\"></form>";
	}
	}
else
{echo "Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button>";}		
die();
 break;
		case 'simpan':
	if (intval(@$_POST["datainput"][1])<10)
	{$kodebayar=@$_POST["datainput"][0]."0".@$_POST["datainput"][1];}
	else
	{$kodebayar=@$_POST["datainput"][0].@$_POST["datainput"][1];}
	if ($dataid=="tambah")
	{$hapus=mysqli_query($kb,"insert into tbl_siswa (`kd_byr`, `nama`, `jns_klmn`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`) values ('".$kodebayar."', 
 '".$_POST["datainput"][2]."', 
'".$_POST["datainput"][3]."', 
'".$_POST["datainput"][4]."', 
'".$_POST["datainput"][5]."', 
'".$_POST["datainput"][6]."', 
'".$_POST["datainput"][7]."', 
'".$_POST["datainput"][8]."', 
'".$_POST["datainput"][9]."', 
'".$_POST["datainput"][10]."', 
'".$_POST["datainput"][11]."', 
'".$_POST["datainput"][12]."', 
'".$_POST["datainput"][13]."', 
'".$_POST["datainput"][14]."', 
'".$_POST["datainput"][15]."', 
'".$_POST["datainput"][16]."', 
'".$_POST["datainput"][17]."',
'".$_POST["datainput"][18]."'); ");}
else
	{$hapus=mysqli_query($kb,"update tbl_siswa set kd_byr='".$kodebayar."', 
nama='".$_POST["datainput"][2]."', 
jns_klmn='".$_POST["datainput"][3]."', 
spp='".$_POST["datainput"][4]."', 
dpp='".$_POST["datainput"][5]."', 
makan='".$_POST["datainput"][6]."', 
snack='".$_POST["datainput"][7]."', 
pomg='".$_POST["datainput"][8]."', 
eks_eng='".$_POST["datainput"][9]."', 
eks_rob='".$_POST["datainput"][10]."', 
eks_fut='".$_POST["datainput"][11]."', 
eks_arc='".$_POST["datainput"][12]."', 
eks_kar='".$_POST["datainput"][13]."', 
smt_1='".$_POST["datainput"][14]."', 
smt_2='".$_POST["datainput"][15]."', 
buku='".$_POST["datainput"][16]."', 
srgm='".$_POST["datainput"][17]."', 
lain='".$_POST["datainput"][18]."' ".$hasilcekdata.";");
$hapus=mysqli_query($kb,"update tbl_bayar set kd_byr='".$kodebayar."', 
nama='".$_POST["datainput"][2]."' ".$untukdisimpan.";");}
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data Siswa Berhasil di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=siswa\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button></a></div>");}
	else
	{die("Data Siswa Gagal di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=siswa\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button></a></div>");}
	break;
		case 'hapus':
	$hapus=mysqli_query($kb,"delete from tbl_siswa ".$hasilcekdata);
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data Siswa Berhasil di hapus<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button></div>");}
	else
	{die("Data Siswa Berhasil di hapus<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button></div>");}
	break;
	
	default:
		break;
}

}
?>
<h2>Data Siswa <?php if ((empty($_POST["mencari"]))&&((empty($_POST["mencarikelas"]))||(@$_POST["mencarikelas"]=="all")))
{$datayangdicari="";}
else
{$datayangdicari=@$_POST["mencarikelas"];} ?><div style="float:right;font-size:15px;cursor: pointer;"><input type="button" value="tambah" class="kotaktombol"onclick="bukalaman('siswa','tambah','tambah');" style="width:auto;"> <input type="button" value="cari data" class="kotaktombol" onclick="mencaridataform();" style="width:auto;"></div></h2>
<div id="formpencari" style="<?php echo ($datayangdicari===""?"display: none;":""); ?>">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimform" onsubmit="return lakukanpengiriman('siswa','mencari','cari'); return false;">
<label>Cari Data berdasarkan kelas dan nama siswa</label><br/>
<select name="mencarikelas" class="kotakisian" style="width:auto;">
<option value="all">Seluruh Kelas</option>
<?php
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1"'.(($loop."1")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."2")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'B</option>';}
?>
</select> 
<input type="text" value="<?php echo @$_POST["mencari"] ?>" placeholder="Cari Data berdasarkan nama siswa" name="mencari" id="kotakformcari" class="kotakisian" style="width:50%;"/><br/>
<input type="submit" value="cari" class="kotaktombol"> <input type="button" onclick="kosongkotakcari('kotakformcari');" value="ulangi" class="kotaktombol"> <input type="button" value="tampilkan seluruh data" class="kotaktombol" onclick="bukalaman('siswa');" style="width:auto;"> <input type="button" value="tutup pencarian" class="kotaktombol" onclick="mencaridataform();" style="width:auto;">
</form></div>
<table cellspacing="0" cellpadding="0">
<tr><th style="width:1%;">Kelas</th><th style="width:9%;">No Absen</th><th style="width:75%;">Nama Siswa</th><th style="width:9%;">Jenis</th><th style="width:7%;">Aksi</th></tr>
<?php
$tambahan="";
if ((!empty($_GET["lakukan"]))&&($_GET["lakukan"]=="cari")&&(!empty($_POST["mencarikelas"])))
{ if (!empty($_POST["mencari"]))
{$tambahan=" where ".(@$_POST["mencarikelas"]==="all"?"":"kd_byr like '".@$_POST["mencarikelas"]."%' and ")."nama like '%".@$_POST["mencari"]."%'";}
else
{$tambahan=(@$_POST["mencarikelas"]==="all"?"":" where kd_byr like '".@$_POST["mencarikelas"]."%' ");}
}
$cekdata=@mysqli_query($kb,"select * from tbl_siswa".$tambahan);
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idsiswa"].$barisdata["kd_byr"].$barisdata["nama"].$barisdata["jns_klmn"]);
	echo "<tr><td id=\"bariskode".$kombinasidata."\" style=\"width:1%;\">".bacakelas($barisdata["kd_byr"])."</td><td id=\"barisabsen".$kombinasidata."\" style=\"width:9%;text-align:center;\">".bacaabsen($barisdata["kd_byr"])."</td><td id=\"barisnama".$kombinasidata."\" style=\"width:7%;\">".ucwords($barisdata["nama"])."</td><td style=\"width:9%;\">".(strtolower($barisdata["jns_klmn"])==="p"?"Perempuan":"Laki-laki")."</td><td><div class=\"iconcrud crudedit\" onclick=\"bukalaman('siswa','".$kombinasidata."','edit')\"></div> <div class=\"iconcrud crudhapus\" onclick=\"hapusan('siswa','".$kombinasidata."')\"></div></td></tr>";
	};
	}
	else
		{echo "<tr><td colspan=\"5\">Tidak Ada data Siswa</td><tr>";}
?>
</table>