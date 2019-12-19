<?php
if ((empty($kb))||(empty($_SESSION["poiuyt"])&&(@$_SESSION["poiuyt"]!="45b4ba675c1624a922dcc72af03b8a09")))
{die("Dilarang mengakses file ini");}
if (!empty($_GET["crud"]))
{ $dataid=@$_GET["dataid"] or die("Perintah Salahx<br/><button onclick=\"window.close();\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">tutup</button>");

switch ($_GET["crud"]) {
case 'lapor':
$judullaporan="";
?>
<style>
@media print{ .kotakisian2 {margin:4px 0 9px 0px;width:auto !important;height:30px;padding:5px;background: #fff;color:#000;border:0;}
p:last-child {border-bottom:0px !important;}
.cetakankotak {border-bottom:1px solid #000;margin:0 auto 18px auto;padding-bottom:13px;width:96%;}
.cetakankotaklast {border:0;}
@page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 0mm auto auto auto;  /* this affects the margin in the printer settings */
        }
}

</style>
<?php
if ((!empty($_POST["bentukcetakan"]))&&($_POST["bentukcetakan"]=="landscape"))
{ ?>
<style>
@media print{ 
.tableuntukdicetak {width: 100%;}
.tableuntukdicetak th,.tableuntukdicetak td  {vertical-align: top;text-align: center;padding:4px;border-left:1px solid #000;color:#000;background: #fff;border-top: 1px solid #000;}
label {text-transform: capitalize;}
.tableuntukdicetak th:last-child,.tableuntukdicetak td:last-child  {border-right: 1px solid #000;}
.tableuntukdicetak tr:last-child td {border-bottom: 1px solid #000; }
	@page {size: landscape; -webkit-transform: rotate(-90deg); -moz-transform:rotate(-90deg);
filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3); } }
</style>
<?php
} 
if ($dataid=="siswa")
	{if (!empty($_POST["mencari"]))
{$tambahan="tbl_siswa where ".(@$_POST["mencarikelas"]==="all"?"":"kd_byr like '".@$_POST["mencarikelas"]."%' and ")."nama like '%".@$_POST["mencari"]."%'";}
else
{$tambahan="tbl_siswa".(@$_POST["mencarikelas"]==="all"?"":" where kd_byr like '".@$_POST["mencarikelas"]."%' ");}
$tambahan.=" order by kd_byr asc";
$judullaporan="Data Siswa";
}
	else
	if ($dataid=="bayar")
	{ $totalwajibseluruhnhya=$totalyangdibayarseluruhnya=$totalwajibperorang=$totalyangdibayarperorang=$totalwajibbulanan=$totalyangdibayarperbulan=0;$detectbulan="";
$kueriutama="select a.kd_byr as siswa0, a.nama as siswa1, a.jns_klmn as siswa2, a.spp as siswa3, a.dpp as siswa4, a.makan as siswa5, a.snack as siswa6, a.pomg as siswa7, a.eks_eng as siswa8, a.eks_rob as siswa9, a.eks_fut as siswa10, a.eks_arc as siswa11, a.eks_kar as siswa12, a.smt_1 as siswa13, a.smt_2 as siswa14, a.buku as siswa15, a.srgm as siswa16, a.lain as siswa17, b.kd_byr as bayar0, b.nama as bayar1, b.status as bayar2, b.bulan as bayar3, b.spp as bayar4, b.dpp as bayar5, b.makan as bayar6, b.snack as bayar7, b.pomg as bayar8, b.eks_eng as bayar9, b.eks_rob as bayar10, b.eks_fut as bayar11, b.eks_arc as bayar12, b.eks_kar as bayar13, b.smt_1 as bayar14, b.smt_2 as bayar15, b.buku as bayar16, b.srgm as bayar17, b.lain as bayar18, b.keterangan as bayar19 from tbl_siswa a join tbl_bayar b on b.kd_byr=a.kd_byr where b.idbayar!='0' ";
$loopbayar=0;$kuerikhusus=(@$_POST["berdasarkan"]==="all"?"":" and b.status='".@$_POST["berdasarkan"]."'");

		if (!empty($_POST["mencari"]))
{$tambahan=" and ".(@$_POST["mencarikelas"]==="all"?"":"b.kd_byr like '".@$_POST["mencarikelas"]."%' and ")."b.nama like '%".@$_POST["mencari"]."%'".$kuerikhusus;}
else
{$tambahan=(@$_POST["mencarikelas"]==="all"?"":"and b.kd_byr like '".@$_POST["mencarikelas"]."%' ").$kuerikhusus;}
$tambahan.=" order by b.kd_byr asc, b.nama asc, b.bulan desc"; $adayangganda="";
$judullaporan="Data Pembayaran";
$cekdata=@mysqli_query($kb,$kueriutama.$tambahan);
}
	else
	{ if (!empty($_POST["mencari"]))
{$tambahan="pengeluaran where ".(@$_POST["mencariwaktu"][0]==="all"?"":(@$_POST["mencariwaktu"][1]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."%' and ":(@$_POST["mencariwaktu"][2]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."%' and ":(@$_POST["mencariwaktu"][3]==="all"?"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-12-31') and ":"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-".@$_POST["mencariwaktu"][3]."-31') and "))))."keterangan like '%".@$_POST["mencari"]."%'";}
else
{$tambahan="pengeluaran ".(@$_POST["mencariwaktu"][0]==="all"?"":" where ".(@$_POST["mencariwaktu"][0]==="all"?"":(@$_POST["mencariwaktu"][1]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."%' ":(@$_POST["mencariwaktu"][2]==="all"?"tanggal like '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."%' ":(@$_POST["mencariwaktu"][3]==="all"?"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-12-31') ":"(tanggal between '".@$_POST["mencariwaktu"][0]."-".@$_POST["mencariwaktu"][1]."-01' and '".@$_POST["mencariwaktu"][2]."-".@$_POST["mencariwaktu"][3]."-31') ")))));}
	$tambahan.=" order by tanggal desc";
$judullaporan="Data Pengeluaran";

	}
echo "<br/><div style='text-align:center;width:100%;margin-bottom:36px;' id='cetakkops'><img src=\"".$lokasiweb."kop.jpg\" style='width:94%;'/></div>";
if ($dataid!="bayar")
{$cekdata=@mysqli_query($kb,"select * from ".$tambahan);}
$nomor=0;
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
	{while($barisdata=mysqli_fetch_array($cekdata))
	{ $nomor++; 
if ($dataid=="siswa")
	{

if ((!empty($_POST["bentukcetakan"]))&&($_POST["bentukcetakan"]=="landscape"))
{echo "<div class='cetakankotak".($nomor===$cekjumlahdata?" cetakankotaklast":"")."'>
<label>Kelas: ".bacakelas($barisdata["kd_byr"])." - Nomor Urut Absen: ".bacaabsen($barisdata["kd_byr"])."</label><br/><br/>
<label style='text-transform:capitalize;float:right;'>Jenis: ".(strtolower($barisdata["jns_klmn"])==="p"?"Perempuan":"Laki-laki")."</label><label>Nama Siswa: ".ucwords(@$barisdata["nama"])."</label><br/><br/>
<table class=\"tableuntukdicetak\" cellspacing='0' cellpadding='0'>
<tr><th>SPP</th><th>DPP</th><th>makan</th><th>snack</th><th>POMG</th><th>Ekskul Ingris</th><th>Ekskul robotic</th><th>Ekskul Futsal</th><th>Ekskul Memanah</th><th>Ekskul karate</th><th>Keg. Semester 1</th><th>Keg. Semester 2</th><th>Buku</th><th>Seragam</th><th>Lainnya</th></tr>
<tr>
<td>".@$barisdata["spp"]."</td>
<td>".@$barisdata["dpp"]."</td>
<td>".@$barisdata["makan"]."</td>
<td>".@$barisdata["snack"]."</td>
<td>".@$barisdata["pomg"]."</td>
<td>".@$barisdata["eks_eng"]."</td>
<td>".@$barisdata["eks_rob"]."</td>
<td>".@$barisdata["eks_fut"]."</td>
<td>".@$barisdata["eks_arc"]."</td>
<td>".@$barisdata["eks_kar"]."</td>
<td>".@$barisdata["smt_1"]."</td>
<td>".@$barisdata["smt_2"]."</td>
<td>".@$barisdata["buku"]."</td>
<td>".@$barisdata["srgm"]."</td>
<td>".@$barisdata["lain"]."</td></tr></table></div>";
}
else
{echo "<div class='cetakankotak".($nomor===$cekjumlahdata?" cetakankotaklast":"")."'>
<label>Kelas: ".bacakelas($barisdata["kd_byr"])." - Nomor Urut Absen: ".bacaabsen($barisdata["kd_byr"])."<br/><br/>
<label>Nama Siswa: ".ucwords(@$barisdata["nama"])."</label><br/><br/>
<label>Jenis: ".(strtolower($barisdata["jns_klmn"])==="p"?"Perempuan":"Laki-laki")."</label><br/><br/>
<label style='text-transform:uppercase;' class=\"besar\">spp: ".@$barisdata["spp"]."</label><br/><br/>
<label style='text-transform:uppercase;' class=\"besar\">dpp: ".@$barisdata["dpp"]."</label><br/><br/>
<label>makan: ".@$barisdata["makan"]."</label><br/><br/>
<label>snack: ".@$barisdata["snack"]."</label><br/><br/>
<label style='text-transform:uppercase;' class=\"besar\">pomg: ".@$barisdata["pomg"]."</label><br/><br/>
<label>Ekskul Ingris: ".@$barisdata["eks_eng"]."</label><br/><br/>
<label>Ekskul robotic: ".@$barisdata["eks_rob"]."</label><br/><br/>
<label>Ekskul Futsal: ".@$barisdata["eks_fut"]."</label><br/><br/>
<label>Ekskul Memanah: ".@$barisdata["eks_arc"]."</label><br/><br/>
<label>Ekskul karate: ".@$barisdata["eks_kar"]."</label><br/><br/>
<label>Keg. Semester 1: ".@$barisdata["smt_1"]."</label><br/><br/>
<label>Keg. Semester 2: ".@$barisdata["smt_2"]."</label><br/><br/>
<label>Buku: ".@$barisdata["buku"]."</label><br/><br/>
<label>Seragam: ".@$barisdata["srgm"]."</label><br/><br/>
<label>Lainnya: ".@$barisdata["lain"]."</label><br/><br/></div>";
}
}
	else
	if ($dataid=="bayar")
	{ if ($adayangganda!=@$barisdata["bayar1"])
	{$adayangganda=@$barisdata["bayar1"]; $totalwajibperorang=$totalyangdibayarperorang=$totalwajibbulanan=$totalyangdibayarperbulan=0;$detectbulan="";
	$loopbayar=0;
	echo "<p style='border-bottom:1px solid #000;margin-bottom:4px;padding-bottom:7px;'>
<label>Kelas: ".bacakelas($barisdata["bayar0"])." - Nomor Urut Absen: ".bacaabsen($barisdata["bayar0"])."<br/><br/>
<label style='text-transform:capitalize;float:right;'>Jenis: ".(strtolower($barisdata["siswa2"])==="p"?"Perempuan":"Laki-laki")."</label><label>Nama Siswa: ".ucwords(@$barisdata["bayar1"])."</label><br/></p>";} 
echo "<p style='border-bottom:1px solid #000;margin-bottom:12px;padding-bottom:18px;'><label style='text-transform:capitalize;float:right;'>Status: ".(strtolower($barisdata["bayar2"])==="l"?"Lunas":"Belum Lunas")."</label><label>Pembayaran: ".ucwords(monthtobulan($barisdata["bayar3"]))."</label><br/></p><label style='text-transform:uppercase;' class=\"besar\">spp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa3"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar4"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label style='text-transform:uppercase;' class=\"besar\">dpp</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa4"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar5"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>makan</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa5"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar6"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label>snack</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa6"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar7"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
<label style='text-transform:uppercase;' class=\"besar\">pomg</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".@$barisdata["siswa7"]."\" name=\"datawajib[]\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".@$barisdata["bayar8"]."\" name=\"datainput[]\" class=\"kotakisian2\"/></div><br/>
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
<label>Keterangan</label><br/><div style=\"width:100%;min-height:25px;height:auto;padding-bottom:5px;margin:9px 0 11px 0;background: #fff;color:#000;padding-top:9px;border-top:1px solid #aaa;\">".@$barisdata["bayar19"]."</div>";
$loopbayar++;
$cektotalpersiswa=@mysqli_query($kb,$kueriutama.$kuerikhusus." and b.kd_byr='".@$barisdata["bayar0"]."' and b.nama='".@$barisdata["bayar1"]."'");
$cekjumlahdatapersiswa=@mysqli_num_rows($cektotalpersiswa) or 0;
if ($detectbulan!=@$barisdata["bayar3"])
	{$totalwajibbulanan=$totalyangdibayarperbulan=0;
	$totalwajibbulanan=intval(@$barisdata["siswa4"])+intval(@$barisdata["siswa5"])+intval(@$barisdata["siswa6"])+intval(@$barisdata["siswa7"])+intval(@$barisdata["siswa8"])+intval(@$barisdata["siswa9"])+intval(@$barisdata["siswa10"])+intval(@$barisdata["siswa11"])+intval(@$barisdata["siswa12"])+intval(@$barisdata["siswa13"])+intval(@$barisdata["siswa14"])+intval(@$barisdata["siswa15"])+intval(@$barisdata["siswa16"])+intval(@$barisdata["siswa17"])+intval(@$barisdata["siswa3"]);
	$totalyangdibayarperbulan=intval(@$barisdata["bayar4"])+intval(@$barisdata["bayar5"])+intval(@$barisdata["bayar6"])+intval(@$barisdata["bayar7"])+intval(@$barisdata["bayar8"])+intval(@$barisdata["bayar9"])+intval(@$barisdata["bayar10"])+intval(@$barisdata["bayar11"])+intval(@$barisdata["bayar12"])+intval(@$barisdata["bayar13"])+intval(@$barisdata["bayar14"])+intval(@$barisdata["bayar15"])+intval(@$barisdata["bayar16"])+intval(@$barisdata["bayar17"])+intval(@$barisdata["bayar18"]);
	$totalwajibperorang+=$totalwajibbulanan;
	$totalyangdibayarperorang+=$totalyangdibayarperbulan;
	$detectbulan=@$barisdata["bayar3"];
	echo "<br/><div style=\"width:100%;height:auto;padding-bottom:5px;".($loopbayar===$cekjumlahdatapersiswa?"margin:0px 0 4px 0;":"margin:0px 0 18px 0;border-bottom:1px solid #000;")."background: #fff;color:#000;padding-top:9px;\">
<label>Total Pembayaran untuk Bulan: ".ucwords(monthtobulan($barisdata["bayar3"]))."</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".$totalwajibbulanan."\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".$totalyangdibayarperbulan."\" class=\"kotakisian2\"/></div></div><br/>";
}
	$totalwajibseluruhnhya+=$totalyangdibayarperorang;
	$totalyangdibayarseluruhnya+=$totalyangdibayarperorang;

if ($loopbayar==$cekjumlahdatapersiswa)
{	echo "<br/><div style=\"width:100%;height:auto;padding-bottom:5px;margin:-40px 0 18px 0;background: #fff;color:#000;padding-top:9px;border-bottom:1px solid #000;\">
<label>Total Pembayaran dari siswa: ".ucwords(@$barisdata["bayar1"])."</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".$totalwajibperorang."\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".$totalyangdibayarperorang."\" class=\"kotakisian2\"/></div></div><br/>";
}
	}
	else
	{ $waktunya=strtotime($barisdata["tanggal"]);
echo "<p style='margin-bottom:12px;padding-bottom:18px;border-bottom:1px solid #000;'><label>Waktu Pengeluaran: ".date("d",$waktunya)." ".monthtobulan(date("m",$waktunya)).date(" Y - H:i:s",$waktunya)." &nbsp;-&nbsp; Jumlah Pengeluaran: ".$barisdata["jumlahkeluar"]."</label><br/><br/><label>Keterangan: ".$barisdata["keterangan"]."</label><br/></div>";

	}
}
if ($dataid=="bayar")
	{	echo "<br/><div style=\"width:100%;height:auto;padding-bottom:5px;margin:-40px 0 18px 0;background: #fff;color:#000;padding-top:9px;border-bottom:1px solid #000;\">
<label>Total Keseluruhan Pembayaran</label><br/><div style=\"margin:4px 0 3px 0;padding-top:4px;border-top:1px solid #aaa;\">Wajib Bayar: <input type=\"text\" readonly value=\"".$totalwajibseluruhnhya."\" class=\"kotakisian2\" style=\"margin-right:3px;\"/>&nbsp; - dibayar: <input type=\"text\" value=\"".$totalyangdibayarseluruhnya."\" class=\"kotakisian2\"/></div></div><br/>";
}


$waktunya=strtotime(date("d F Y"));
echo "<div style='float:right;text-align:center;width:auto;padding-top:4px;'>Bekasi, ".date("d",$waktunya)." ".monthtobulan(date("m",$waktunya)).date(" Y",$waktunya)."&nbsp;-&nbsp; <span id='pilihjam'></span>:<span id='pilihmenit'></span>:<span id='pilihdetik'></span><p style='margin-top:6px;'>Bendahara</p><br/><br/><p style='padding-top:36px;'>Asy Syaffa Dwi.K</p></div>";
?>
<script>
jQuery(document).ready(function(){
jQuery("#cetakkops").html(jQuery("#kotakkops").html());
jQuery("#pilihjam").html(jQuery("#jm").html());
jQuery("#pilihmenit").html(jQuery("#mn").html());
jQuery("#pilihdetik").html(jQuery("#dk").html());

	jQuery('.areapercetakan').printArea();
})
</script>
<?php
}
else
{ ?>
<script>
jQuery(document).ready(function(){
	alert("Tidak Ada <?php echo $judullaporan; ?> yang bisa di cetak");
})
</script>
<?php 
}
die();
break;

	default:
		break;
}

}
?>
<h2>Data laporan</h2>
<style>
.kotaklaporan {display: none;margin-top: 7px;padding-top: 13px;border-top: 1px solid #000;}
</style>
<script>
function tampilkanform(datanya="")
{jQuery(".kotaklaporan").hide();
jQuery(".areapercetakan").html();
jQuery("#formlapor"+datanya).show();
}
</script>
<div class="areapercetakan" style="display: none;"></div>
<?php
$judulbackup="";
$cekdata=@mysqli_query($kb,"select * from tbl_siswa");
$cekdatasiswa=@mysqli_num_rows($cekdata) or 0;
$cekdata=@mysqli_query($kb,"select * from tbl_bayar");
$cekdatabayar=@mysqli_num_rows($cekdata) or 0;
$cekdata=@mysqli_query($kb,"select * from pengeluaran");
$cekdatakeluar=@mysqli_num_rows($cekdata) or 0;
?>
<div>
<?php
if (($cekdatasiswa>0)||($cekdatabayar>0)||($cekdatakeluar))
{ if ($cekdatasiswa>0) { ?>
<button class="kotaktombol" style="width:auto;" onclick="tampilkanform('siswa');">Cetak Data Siswa</button> <?php }; if ($cekdatabayar>0) { ?><button class="kotaktombol" style="width:auto;" onclick="tampilkanform('bayar');">Cetak Data Pembayaran</button> <?php }; if ($cekdatakeluar>0) { ?><button class="kotaktombol" style="width:auto;" onclick="tampilkanform('keluar');">Cetak Data Pengeluaran</button> <?php };
}
else
{echo "Tidak ada satupun data yang tersimpan di database";}
?>
</div>
<div id="formlaporsiswa" class="kotaklaporan" style="display: none;">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimformsiswa" onsubmit="return lakukanpengiriman('laporan','siswa','lapor'); return false;">
<label>Cetak Laporan berdasarkan kelas dan nama siswa</label><br/>
<select name="mencarikelas" class="kotakisian" style="width:auto;">
<option value="all">Seluruh Kelas</option>
<?php
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1"'.(($loop."1")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."2")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'B</option>';}
?>
</select> 
<input type="text" value="<?php echo @$_POST["mencari"] ?>" placeholder="Cetak Laporan berdasarkan nama siswa" name="mencari" id="kotakformcari1" class="kotakisian" style="width:50%;"/><br/>
<select name="bentukcetakan" class="kotakisian" style="width:auto;"><option value="potrait">Format Cetak: Potrait</option><option value="landscape">Format Cetak: Landscape</option> </select>
<input type="submit" value="cetak" class="kotaktombol" style="margin-left: 18px;"> <input type="button" onclick="kosongkotakcari('kotakformcari1');" value="ulangi" class="kotaktombol"> 
</form></div>
<div id="formlaporbayar" class="kotaklaporan" style="display: none;">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimformbayar" onsubmit="return lakukanpengiriman('laporan','bayar','lapor'); return false;">
<label>Cetak Laporan berdasarkan kelas, nama siswa dan status pembayaran</label><br/>
<select name="mencarikelas" class="kotakisian" style="width:auto;">
<option value="all">Seluruh Kelas</option>
<?php
for ($loop=1;$loop<=6;$loop++)
{echo '<option value="'.$loop.'1"'.(($loop."1")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'A</option><option value="'.$loop.'2"'.(($loop."2")===@$_POST["mencarikelas"]?" selected":"").'>'.$loop.'B</option>';}
?>
</select> 
<input type="text" value="<?php echo @$_POST["mencari"]; ?>" placeholder="Cetak Laporan berdasarkan kode bayar atau nama siswa" name="mencari" id="kotakformcari2" class="kotakisian" style="width:50%;"/> <select name="berdasarkan" class="kotakisian" style="width:auto;margin-left: 4px;">
<option value="all">Semua status</option><?php $pilihanganda=explode("-","Lunas-Belum");$pilihanganda2=explode("-","L-B"); for ($loop=0;$loop<count($pilihanganda);$loop++)
{echo "<option value=\"".$pilihanganda2[$loop]."\"".(@$_POST["berdasarkan"]===$pilihanganda2[$loop]?" selected":"").">".$pilihanganda[$loop]."</option>";}
?>
</select><br/>
<input type="submit" value="cetak" class="kotaktombol"> <input type="button" onclick="kosongkotakcari('kotakformcari2');" value="ulangi" class="kotaktombol"> 
</form></div>
<div id="formlaporkeluar" class="kotaklaporan" style="display: none;">
<form style="width:96%;margin:0 auto;" method="post" enctype="multipart/form-data" id="pengirimformkeluar" onsubmit="return lakukanpengiriman('laporan','keluar','lapor'); return false;">
<label>Cetak Laporan berdasarkan durasi waktu dan keterangan pengeluaran</label><br/>
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
{echo '<option value="'.$loop.'"'.($loop===@$_POST["mencariwaktu"][1]?" selected":"").'>'.monthtobulan($loop).'</option>';}

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
{echo '<option value="'.$loop.'"'.($loop===@$_POST["mencariwaktu"][3]?" selected":"").'>'.monthtobulan($loop).'</option>';}

}
?>
</select></span> 
<br/>
Keterangan: <input type="text" value="<?php echo @$_POST["mencari"] ?>" placeholder="Cetak Laporan berdasarkan keterangan pengeluaran" name="mencari3" id="kotakformcari" class="kotakisian" style="width:80%;"/><br/>
<input type="submit" value="cetak" class="kotaktombol"> <input type="button" onclick="kosongkotakcari('kotakformcari3');" value="ulangi" class="kotaktombol"> 
</form></div>
<div style='text-align:center;width:100%;margin-bottom:36px;display: none;' id="kotakkops"><img src="<?php echo $lokasiweb; ?>kop.jpg" style='width:94%;'/></div>