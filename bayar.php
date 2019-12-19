<?php
if ((empty($kb))||(empty($_SESSION["poiuyt"])&&(@$_SESSION["poiuyt"]!="45b4ba675c1624a922dcc72af03b8a09")))
{die("Dilarang mengakses file ini");}
if (!empty($_GET["crud"]))
{ $dataid=@$_GET["dataid"] or die("Perintah Salah<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button>");
$hasilcekdata=$hasilcekdata2="";
$cekdata=@mysqli_query($kb,"select * from tbl_bayar");
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idbayar"].$barisdata["kd_byr"].$barisdata["nama"].$barisdata["status"].$barisdata["bulan"]);
	 if ($dataid==$kombinasidata)
	 {$hasilcekdata=" where b.idbayar='".$barisdata["idbayar"]."'";
	$hasilcekdata2=" where idbayar='".$barisdata["idbayar"]."'";break;}
	else
	{$hasilcekdata=$hasilcekdata2="";}
	}
}
if (($dataid!="tambah")&&($hasilcekdata=="")&&($hasilcekdata2==""))
	{die("<div style='width:auto;margin:18% auto;text-align:center;'>"."Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button>"."</div>");}
switch ($_GET["crud"]) {
case 'tambah':
$cetakpilihankelas='<script>
function muatulanguntukdatakelas()
{ jQuery(".isinya").load("index.php?do=tampil&page=bayar&crud=tambah&dataid=tambah&pilihkelas="+jQuery("#kelasterpilih").val());
}
</script>'.'<label>Pilih Kelas</label><br/><select  onchange="muatulanguntukdatakelas();" id="kelasterpilih" class="kotakisian" style="width:100%;"><option value="all">Seluruh Kelas</option>';
for ($loop=1;$loop<=6;$loop++)
{$cetakpilihankelas.='<option value="'.$loop.'1"'.(($loop."A")===bacakelas(@$_GET["pilihkelas"])?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."B")===bacakelas(@$_GET["pilihkelas"])?" selected":"").'>'.$loop.'B</option>';}
$cetakpilihankelas.='</select><br/>';
if (empty($_GET["pilihkelas"]))
{ die("<h3>Tambah Data Pembayaran</h3>".$cetakpilihankelas); }
else
if ((empty($_GET["pilihsiswa"]))&&(!empty($_GET["pilihkelas"])))
{
?>
<script>
function muatulanguntuktambahdata()
{ jQuery(".isinya").load("index.php?do=tampil&page=bayar&crud=tambah&dataid=tambah&pilihkelas=<?php echo @$_GET["pilihkelas"]; ?>&pilihsiswa="+jQuery("#siswaterpilih").val());
}
</script>
<?php
 echo "<h3>Tambah Data Pembayaran</h3>".$cetakpilihankelas."
<label>Pilih Siswa</label><br/><select id=\"siswaterpilih\" onchange=\"muatulanguntuktambahdata();\" class=\"kotakisian\" style=\"width:100%;\"><option value=\"\">Silahkan Pilih data siswa</option>";
$cekdata=@mysqli_query($kb,"select * from tbl_siswa".(@$_GET["pilihkelas"]==="all"?"":" where kd_byr like '".@$_GET["pilihkelas"]."%' "));
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["kd_byr"].$barisdata["nama"].$barisdata["jns_klmn"]);
	echo "<option value=\"".$kombinasidata."\">Kode Bayar: ".$barisdata["kd_byr"]." - Nama Siswa: ".$barisdata["nama"]." - Jenis: ".(strtolower($barisdata["jns_klmn"])==="p"?"Perempuan":"Laki-laki")."</option>";
	}
echo "</select><br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">Batal</button><br/>";
}
else
{die("Maaf, tidak ada data siswa yang ditemukan di database<br/><button onclick=\"bukalaman('siswa')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data siswa</button>");}
 die();
}
$hasilcekdata="";
$cekdata=@mysqli_query($kb,"select * from tbl_siswa");
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["kd_byr"].$barisdata["nama"].$barisdata["jns_klmn"]);
	 if (@$_GET["pilihsiswa"]==$kombinasidata)
	 {$hasilcekdata=" where a.kd_byr='".$barisdata["kd_byr"]."' and a.nama='".$barisdata["nama"]."' and a.jns_klmn='".$barisdata["jns_klmn"]."'";break;}
	else
	{$hasilcekdata="";}
	}
}
if (($dataid!="tambah")&&($hasilcekdata=="")&&($hasilcekdata2==""))
	{die("Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button>");}
 echo "<h3>Tambah Data Pembayaran</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('bayar','".$dataid."','simpan'); return false;\">";
$cekdata=@mysqli_query($kb,"select a.kd_byr as siswa0, a.nama as siswa1, a.jns_klmn as siswa2, a.spp as siswa3, a.dpp as siswa4, a.makan as siswa5, a.snack as siswa6, a.pomg as siswa7, a.eks_eng as siswa8, a.eks_rob as siswa9, a.eks_fut as siswa10, a.eks_arc as siswa11, a.eks_kar as siswa12, a.smt_1 as siswa13, a.smt_2 as siswa14, a.buku as siswa15, a.srgm as siswa16, a.lain as siswa17 from tbl_siswa a ".$hasilcekdata);

$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ 	echo "<div style=\"display:none;\"><label>Kode Bayar</label><br/><input type=\"text\" value=\"".@$barisdata["siswa0"]."\" readonly name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>nama siswa</label><br/><input type=\"text\" value=\"".@$barisdata["siswa1"]."\" readonly name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/></div><label>Detail Siswa:</label><br/><br/><div style=\"width:100%;\">Nama Siswa: ".@$barisdata["siswa1"]."<br/><br/>Kelas:".bacakelas(@$barisdata["siswa0"])." - No Urut absen: ".bacaabsen(@$barisdata["siswa0"])."<br/></div><br/>
<label>Bulan Pembayaran</label><br/><select name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\">";
for ($iloop=1;$iloop<=12;$iloop++)
{ $cekbulan=@mysqli_query($kb,"select a.kd_byr as siswa0, a.nama as siswa1, a.jns_klmn as siswa2, a.spp as siswa3, a.dpp as siswa4, a.makan as siswa5, a.snack as siswa6, a.pomg as siswa7, a.eks_eng as siswa8, a.eks_rob as siswa9, a.eks_fut as siswa10, a.eks_arc as siswa11, a.eks_kar as siswa12, a.smt_1 as siswa13, a.smt_2 as siswa14, a.buku as siswa15, a.srgm as siswa16, a.lain as siswa17, b.kd_byr as bayar0, b.nama as bayar1, b.status as bayar2, b.bulan as bayar3, b.spp as bayar4, b.dpp as bayar5, b.makan as bayar6, b.snack as bayar7, b.pomg as bayar8, b.eks_eng as bayar9, b.eks_rob as bayar10, b.eks_fut as bayar11, b.eks_arc as bayar12, b.eks_kar as bayar13, b.smt_1 as bayar14, b.smt_2 as bayar15, b.buku as bayar16, b.srgm as bayar17, b.lain as bayar18, b.keterangan as bayar19 from tbl_siswa a join tbl_bayar b on b.kd_byr=a.kd_byr ".$hasilcekdata." and b.bulan='".$iloop."'");
$cekbulandata=@mysqli_num_rows($cekbulan) or 0;
if ($cekbulandata>0)
{continue;}
echo "<option value=\"".$iloop."\" ".(intval(@$barisdata["bayar3"])===$iloop?"selected":"").">".ucwords(monthtobulan($iloop))."</option>";}
echo "</select><br/>
<label class=\"besar\">spp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa3"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label class=\"besar\">dpp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa4"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>makan</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa5"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>snack</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa6"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label class=\"besar\">pomg</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa7"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Ingris</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa8"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul robotic</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa9"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Futsal</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa10"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Memanah</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa11"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul karate</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa12"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keg. Semester 1</label><br/><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa13"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keg. Semester 2</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa14"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Buku</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa15"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Seragam</label><br/><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa16"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Lainnya</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa17"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"0\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keterangan</label><br/><textarea name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;height:45px;\"></textarea><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('bayar')\"></form>";
	}
	}
else
{echo "Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button>";}
die();
break;
		case 'edit':
$cekdata=@mysqli_query($kb,"select a.kd_byr as siswa0, a.nama as siswa1, a.jns_klmn as siswa2, a.spp as siswa3, a.dpp as siswa4, a.makan as siswa5, a.snack as siswa6, a.pomg as siswa7, a.eks_eng as siswa8, a.eks_rob as siswa9, a.eks_fut as siswa10, a.eks_arc as siswa11, a.eks_kar as siswa12, a.smt_1 as siswa13, a.smt_2 as siswa14, a.buku as siswa15, a.srgm as siswa16, a.lain as siswa17, b.kd_byr as bayar0, b.nama as bayar1, b.status as bayar2, b.bulan as bayar3, b.spp as bayar4, b.dpp as bayar5, b.makan as bayar6, b.snack as bayar7, b.pomg as bayar8, b.eks_eng as bayar9, b.eks_rob as bayar10, b.eks_fut as bayar11, b.eks_arc as bayar12, b.eks_kar as bayar13, b.smt_1 as bayar14, b.smt_2 as bayar15, b.buku as bayar16, b.srgm as bayar17, b.lain as bayar18, b.keterangan as bayar19 from tbl_siswa a join tbl_bayar b on b.kd_byr=a.kd_byr ".$hasilcekdata);
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ echo "<h3>Edit Data Pembayaran</h3><form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('bayar','".$dataid."','simpan'); return false;\">";
	echo "<div style=\"display:none;\"><label>Kode Bayar</label><br/><input type=\"text\" value=\"".@$barisdata["siswa0"]."\" readonly name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/><br/>
<label>nama siswa</label><br/><input type=\"text\" value=\"".@$barisdata["siswa1"]."\" readonly name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\"/></div><label>Detail Siswa:</label><br/><br/><div style=\"width:100%;\">Nama Siswa: ".@$barisdata["siswa1"]."<br/><br/>Kelas:".bacakelas(@$barisdata["siswa0"])." - No Urut absen: ".bacaabsen(@$barisdata["siswa0"])."<br/></div><br/>
<label>Bulan Pembayaran</label><br/><select name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;\">";
for ($iloop=1;$iloop<=12;$iloop++)
{echo "<option value=\"".$iloop."\" ".(intval(@$barisdata["bayar3"])===$iloop?"selected":"").">".ucwords(monthtobulan($iloop))."</option>";}
echo "</select><br/>
<label class=\"besar\">spp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa3"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar4"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label class=\"besar\">dpp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa4"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar5"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>makan</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa5"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar6"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>snack</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa6"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar7"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label class=\"besar\">pomg</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa7"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar8"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Ingris</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa8"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar9"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul robotic</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa9"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar10"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Futsal</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa10"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar11"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul Memanah</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa11"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar12"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Ekskul karate</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa12"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar13"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keg. Semester 1</label><br/><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa13"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar14"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keg. Semester 2</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa14"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar15"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Buku</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa15"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar16"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Seragam</label><br/><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa16"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar17"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Lainnya</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa17"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar18"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>Keterangan</label><br/><textarea name=\"datainput[]\" class=\"kotakisian\" style=\"width:100%;height:45px;\">".@$barisdata["bayar19"]."</textarea><br/>";
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('bayar')\"></form>";
	}
	}
else
{echo "Maaf, data tidak ditemukan di database<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button>";}		
die();
 break;
		case 'simpan':
$statusbayar="B";
for ($iloop=0;$iloop<=14;$iloop++)
{ if (intval($_POST["datawajib"][$iloop])<=intval($_POST["datainput"][($iloop+3)]))
{$statusbayar="L";}
else
{$statusbayar="B";break;}
}
	if ($dataid=="tambah")
	{$hapus=mysqli_query($kb,"insert into tbl_bayar (`kd_byr`, `nama`, `status`, `bulan`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`, `keterangan`) values ('".$_POST["datainput"][0]."', 
'".$_POST["datainput"][1]."',
'".$statusbayar."', 
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
{
$hapus=mysqli_query($kb,"update tbl_bayar set kd_byr='".$_POST["datainput"][0]."', 
nama='".$_POST["datainput"][1]."', 
bulan='".$_POST["datainput"][2]."', 
spp='".$_POST["datainput"][3]."', 
dpp='".$_POST["datainput"][4]."', 
makan='".$_POST["datainput"][5]."', 
snack='".$_POST["datainput"][6]."', 
pomg='".$_POST["datainput"][7]."', 
eks_eng='".$_POST["datainput"][8]."', 
eks_rob='".$_POST["datainput"][9]."', 
eks_fut='".$_POST["datainput"][10]."', 
eks_arc='".$_POST["datainput"][11]."', 
eks_kar='".$_POST["datainput"][12]."', 
smt_1='".$_POST["datainput"][13]."', 
smt_2='".$_POST["datainput"][14]."', 
buku='".$_POST["datainput"][15]."', 
srgm='".$_POST["datainput"][16]."', 
lain='".$_POST["datainput"][17]."', 
keterangan='".$_POST["datainput"][18]."', 
status='".$statusbayar."' ".$hasilcekdata2.";");}
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data pembayaran Berhasil di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=bayar\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></a></div>");}
	else
	{die("Data pembayaran Gagal di".($dataid==="tambah"?"tambahkan":"edit")."<br/><a href=\"index.php?kembalike=bayar\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></a></div>");}
	break;
		case 'hapus':
	$hapus=mysqli_query($kb,"delete from tbl_bayar ".$hasilcekdata2);
	echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data pembayaran Berhasil di hapus<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></div>");}
	else
	{die("Data pembayaran Berhasil di hapus<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></div>");}
	break;
		case 'hapus':
	$hapus=mysqli_query($kb,"delete from tbl_bayar ".$hasilcekdata2);
	echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data pembayaran Berhasil di hapus<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></div>");}
	else
	{die("Data pembayaran Berhasil di hapus<br/><button onclick=\"bukalaman('bayar')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data pembayaran</button></div>");}
	break;
	
	
	default:
		break;
}

}
?>
<h2>Data Pembayaran  <?php if ((empty($_POST["mencari"]))&&((empty($_POST["mencarikelas"]))||(@$_POST["mencarikelas"]=="all")))
{$datayangdicari="";}
else
{$datayangdicari=@$_POST["mencarikelas"];} ?><div style="float:right;font-size:15px;cursor: pointer;"><input type="button" value="tambah" class="kotaktombol"onclick="bukalaman('bayar','tambah','tambah');" style="width:auto;"> <input type="button" value="cari data" class="kotaktombol" onclick="mencaridataform();" style="width:auto;"></div></h2>
<div id="formpencari" style="<?php echo ($datayangdicari===""?"display: none;":""); ?>">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimform" onsubmit="return lakukanpengiriman('bayar','mencari','cari'); return false;">
<label>Cari Data berdasarkan kelas, nama siswa dan status pembayaran</label><br/>
<select name="mencarikelas" class="kotakisian" style="width:auto;">
<option value="all">Seluruh Kelas</option>
<?php
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1"'.(($loop."1")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."2")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'B</option>';}
?>
</select> 
<input type="text" value="<?php echo @$_POST["mencari"]; ?>" placeholder="Cari Data berdasarkan kode bayar atau nama siswa" name="mencari" id="kotakformcari" class="kotakisian" style="width:50%;"/> <select name="berdasarkan" class="kotakisian" style="width:auto;margin-left: 4px;">
<option value="all">Semua status</option><?php $pilihanganda=explode("-","Lunas-Belum");$pilihanganda2=explode("-","L-B"); for ($loop=0;$loop<count($pilihanganda);$loop++)
{echo "<option value=\"".$pilihanganda2[$loop]."\"".(@$_POST["berdasarkan"]===$pilihanganda2[$loop]?" selected":"").">".$pilihanganda[$loop]."</option>";}
?>
</select><br/>
<input type="submit" value="cari" class="kotaktombol"> <input type="button" onclick="kosongkotakcari('kotakformcari');" value="ulangi" class="kotaktombol"> <input type="button" value="tampilkan seluruh data" class="kotaktombol" onclick="bukalaman('siswa');" style="width:auto;"> <input type="button" value="tutup pencarian" class="kotaktombol" onclick="mencaridataform();" style="width:auto;">
</form></div>
<table cellspacing="0" cellpadding="0">
<tr><th style="width:1%;">Kelas</th><th style="width:9%;">No Absen</th><th>nama siswa</th><th>Bulan</th><th>Status</th><th>Aksi</th></tr>
<?php
$tambahan="";
if ((!empty($_GET["lakukan"]))&&($_GET["lakukan"]=="cari"))
{ if (!empty($_POST["mencari"]))
{$tambahan=" where ".(@$_POST["mencarikelas"]==="all"?"":"kd_byr like '".@$_POST["mencarikelas"]."%' and ")."nama like '%".@$_POST["mencari"]."%'".(@$_POST["berdasarkan"]==="all"?"":" and status='".@$_POST["berdasarkan"]."'");}
else
{$tambahan=" where idbayar!='0' ".(@$_POST["mencarikelas"]==="all"?"":"and kd_byr like '".@$_POST["mencarikelas"]."%' ").(@$_POST["berdasarkan"]==="all"?"":" and status='".@$_POST["berdasarkan"]."'");}

}
$cekdata=@mysqli_query($kb,"select * from tbl_bayar".$tambahan);
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $kombinasidata=md5($barisdata["idbayar"].$barisdata["kd_byr"].$barisdata["nama"].$barisdata["status"].$barisdata["bulan"]);
	echo "<tr><td id=\"bariskode".$kombinasidata."\" style=\"width:1%;\">".bacakelas($barisdata["kd_byr"])."</td><td id=\"barisabsen".$kombinasidata."\" style=\"width:9%;text-align:center;\">".bacaabsen($barisdata["kd_byr"])."</td><td id=\"barisnama".$kombinasidata."\">".ucwords($barisdata["nama"])."</td><td id=\"barisbulan".$kombinasidata."\">".ucwords(monthtobulan($barisdata["bulan"]))."</td><td id=\"barisstatus".$kombinasidata."\">".(strtoupper($barisdata["status"])==="L"?"Lunas":"Belum")."</td><td><div style=\"width:42px;\"><div class=\"iconcrud crudedit\" onclick=\"bukalaman('bayar','".$kombinasidata."','edit')\"></div> <div class=\"iconcrud crudhapus\" onclick=\"hapusan('bayar','".$kombinasidata."')\"></div></div></td></tr>";
	};
	}
	else
		{echo "<tr><td colspan=\"6\">Tidak Ada data pembayaran</td><tr>";}
?>
</table>