<?php
if ((empty($kb))||(empty($_SESSION["poiuyt"])&&(@$_SESSION["poiuyt"]!="45b4ba675c1624a922dcc72af03b8a09")))
{die("Dilarang mengakses file ini");}
if (!empty($_GET["crud"]))
{ $dataid=@$_GET["dataid"] or die("Perintah Salah<br/><button onclick=\"window.close();\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">tutup</button>");

switch ($_GET["crud"]) {
case 'backupdo':
$judulbackup="";
$cekdata=@mysqli_query($kb,"select * from ".($dataid==="siswa"?"tbl_siswa":($dataid==="bayar"?"tbl_bayar":"pengeluaran")));
$cekjumlahdata=@mysqli_num_rows($cekdata) or 0;
if ($cekjumlahdata>0)
{ 	if ($dataid=="siswa")
	{$buatdata="CREATE TABLE IF NOT EXISTS `tbl_siswa` ( `idsiswa` bigint(255) Not Null AUTO_INCREMENT, `kd_byr` int(4) NOT NULL, `nama` varchar(50) NOT NULL, `jns_klmn` varchar(1) NOT NULL, `spp` bigint(8) NOT NULL, `dpp` bigint(8) NOT NULL, `makan` bigint(8) NOT NULL, `snack` bigint(8) NOT NULL, `pomg` bigint(8) NOT NULL, `eks_eng` bigint(8) NOT NULL, `eks_rob` bigint(8) NOT NULL, `eks_fut` bigint(8) NOT NULL, `eks_arc` bigint(8) NOT NULL, `eks_kar` bigint(8) NOT NULL, `smt_1` bigint(8) NOT NULL, `smt_2` bigint(8) NOT NULL, `buku` bigint(8) NOT NULL, `srgm` bigint(8) NOT NULL, `lain` double NOT NULL, primary key (`idsiswa`) ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1; INSERT INTO `tbl_siswa` (`kd_byr`, `nama`, `jns_klmn`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`) VALUES ";
	$judulbackup="data siswa - ".date("d F Y").".sql";}
	else
	if ($dataid=="bayar")
	{$buatdata="CREATE TABLE IF NOT EXISTS `tbl_bayar` ( `idbayar` bigint(255) Not Null AUTO_INCREMENT, `kd_byr` int(4) NOT NULL, `nama` varchar(50) NOT NULL, `status` varchar(1) NOT NULL, `bulan` varchar(2) NOT NULL, `spp` bigint(8) NOT NULL, `dpp` bigint(8) NOT NULL, `makan` bigint(8) NOT NULL, `snack` bigint(8) NOT NULL, `pomg` bigint(8) NOT NULL, `eks_eng` bigint(8) NOT NULL, `eks_rob` bigint(8) NOT NULL, `eks_fut` bigint(8) NOT NULL, `eks_arc` bigint(8) NOT NULL, `eks_kar` bigint(8) NOT NULL, `smt_1` bigint(8) NOT NULL, `smt_2` bigint(8) NOT NULL, `buku` bigint(8) NOT NULL, `srgm` bigint(8) NOT NULL, `lain` double NOT NULL, `keterangan` longtext NOT NULL, primary key (`idbayar`) ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1; INSERT INTO `tbl_bayar` (`kd_byr`, `nama`, `status`, `bulan`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`, `keterangan`) VALUES ";
	$judulbackup="data pembayaran - ".date("d F Y").".sql";}
	else
	{$buatdata="CREATE TABLE IF NOT EXISTS `pengeluaran` ( `idkeluar` bigint(255) Not Null AUTO_INCREMENT, `tanggal` datetime NOT NULL, `jumlahkeluar` bigint(8) NOT NULL, `keterangan` longtext NOT NULL, primary key (`idkeluar`) ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1; INSERT INTO `pengeluaran` (`tanggal`, `jumlahkeluar`, `keterangan`) VALUES ";
	$judulbackup="data pengeluaran - ".date("d F Y").".sql";}
while($barisdata=mysqli_fetch_array($cekdata))
	{
	if ($dataid=="siswa")
	{	$buatdata.="('".@$barisdata['kd_byr']."', '".@$barisdata['nama']."', '".@$barisdata['jns_klmn']."', '".@$barisdata['spp']."', '".@$barisdata['dpp']."', '".@$barisdata['makan']."', '".@$barisdata['snack']."', '".@$barisdata['pomg']."', '".@$barisdata['eks_eng']."', '".@$barisdata['eks_rob']."', '".@$barisdata['eks_fut']."', '".@$barisdata['eks_arc']."', '".@$barisdata['eks_kar']."', '".@$barisdata['smt_1']."', '".@$barisdata['smt_2']."', '".@$barisdata['buku']."', '".@$barisdata['srgm']."', '".@$barisdata['lain']."'),";}
	else
	if ($dataid=="bayar")
	{$buatdata.="('".@$barisdata['kd_byr']."', '".@$barisdata['nama']."', '".@$barisdata['status']."', '".@$barisdata['bulan']."', '".@$barisdata['spp']."', '".@$barisdata['dpp']."', '".@$barisdata['makan']."', '".@$barisdata['snack']."', '".@$barisdata['pomg']."', '".@$barisdata['eks_eng']."', '".@$barisdata['eks_rob']."', '".@$barisdata['eks_fut']."', '".@$barisdata['eks_arc']."', '".@$barisdata['eks_kar']."', '".@$barisdata['smt_1']."', '".@$barisdata['smt_2']."', '".@$barisdata['buku']."', '".@$barisdata['srgm']."', '".@$barisdata['lain']."','".@$barisdata['keterangan']."'),";}
	else
	{$buatdata.="('".@$barisdata['tanggal']."', '".@$barisdata['jumlahkeluar']."','".@$barisdata['keterangan']."'),";}
	}
$buatdata=substr(@$buatdata,0,-1).";";
header('Pragma: anytextexeptno-cache', true);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"backup ".$judulbackup."\"");
echo $buatdata;
}
else
{echo "Maaf, data tidak ditemukan di database<br/><button onclick=\"window.close();\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">tutup</button>";}
die();
break;
	case 'restoreform':
		if ($dataid=="siswa")
	{echo "<h3>Restore Data Siswa</h3>";}
	else
	if ($dataid=="bayar")
	{echo "<h3>Restore Data Pembayaran</h3>";}
	else
	{echo "<h3>Restore Data Pengeluaran</h3>";}
		echo "<form style=\"width:96%;margin:0 auto;\" method=\"post\" enctype=\"multipart/form-data\" id=\"pengirimform\" onsubmit=\"return lakukanpengiriman('setting','".$dataid."','simpan'); return false;\">";
	echo "<label>Pilih File Backup Anda</label><br/><br/>".'<input type="file" id="uploadfile" required placeholder="Pilih File Backup Anda" name="pilihannya" value="" file-accept=".sql, .SQL,.txt" accept=".sql, .SQL" >';
	echo "<input type=\"submit\" value=\"simpan\" class=\"kotaktombol\"> <input type=\"reset\" value=\"ulangi\" class=\"kotaktombol\"> <input type=\"button\" value=\"batal\" class=\"kotaktombol\" onclick=\"bukalaman('setting')\"></form>";
die();
 break;
	case 'simpan':
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
if (empty($_FILES["pilihannya"]))
	{ die($_GET["dataid"]."Silahkan Pilih File Backupan Anda yg berformat .sql<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");	}
 if (strtolower(substr($_FILES["pilihannya"]["name"],-4))!=".sql")
	{ die("Silahkan Pilih File Backupan Anda yg berformat .sql<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");	}
	$namafilenya=$_FILES["pilihannya"]["tmp_name"];
	$tampunggagal=0;$datafile = fopen($namafilenya,"r+"); $hasilperbaris="";
	$bacafilesql = fread($datafile, filesize($namafilenya));
	if ($dataid=="siswa")
	{ if (count(explode("INTO `tbl_siswa`",$bacafilesql))<2)
	{ die("File Backupan Anda yg Anda masukkan tidak terdapat Backupan Data Siswa<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");	}
	$judulbackup="data siswa ";
	}
	else
	if ($dataid=="bayar")
	{ if (count(explode("INTO `tbl_bayar`",$bacafilesql))<2) 
	{ die("File Backupan Anda yg Anda masukkan tidak terdapat Backupan Data Pembayaran<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");	};
	$judulbackup="data pembayaran ";
	}
	else
	{ if (count(explode("INTO `pengeluaran`",$bacafilesql))<2)
	{ die("File Backupan Anda yg Anda masukkan tidak terdapat Backupan Data Pengeluaran<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");	};
	$judulbackup="data pengeluaran ";
	}

$bacaperbaris = explode(';',$bacafilesql);
foreach ($bacaperbaris as $isiperbaris) {
  if (strlen($isiperbaris)>3 && substr(ltrim($isiperbaris),0,2)!='/*') {
    $hasilquery = mysqli_query($kb, $isiperbaris);
    if (!$hasilquery) {
      $hasilperbaris = "gagal";
      break; } }; }
if (mysqli_connect_errno()!="0")
{die("Mohon Maaf, Proses Restore ".$judulbackup."gagal, silahkan upload manual melalui phpmyadmin, terima kasih<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");}
die("Proses Restore ".$judulbackup."berhasil, terima kasih<br/><a href=\"index.php?kembalike=setting\"><button class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang setting</button></a></div>");
die();
 break;
 	case 'hapus':

	if ($dataid=="siswa")
	{ $tablenya="tbl_siswa";
	$judulbackup="siswa ";
	}
	else
	if ($dataid=="bayar")
	{ $tablenya="tbl_bayar";
	$judulbackup="pembayaran ";
	}
	else
	{ $tablenya="pengeluaran";
	$judulbackup="pengeluaran ";
	}

	$hapus=mysqli_query($kb,"truncate ".$tablenya);
echo "<div style='width:auto;margin:18% auto;text-align:center;'>";
	if ($hapus)
	{die("Data ".$judulbackup." Berhasil di hapus<br/><button onclick=\"bukalaman('setting')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data setting</button></div>");}
	else
	{die("Data ".$judulbackup." Berhasil di hapus<br/><button onclick=\"bukalaman('setting')\" class=\"kotaktombol\" style=\"width:auto;margin-top:13px;\">muat ulang data setting</button></div>");}
break;
	default:
		break;
}

}
?>
<h2>Data Setting</h2>
<div>
<button class="kotaktombol" style="width:auto;" onclick="bukalaman('setting','siswa','restoreform');">Restore Data Siswa</button> <button class="kotaktombol" style="width:auto;" onclick="bukalaman('setting','bayar','restoreform');">Restore Data Pembayaran</button> <button class="kotaktombol" style="width:auto;" onclick="bukalaman('setting','keluar','restoreform');">Restore Data Pengeluaran</button>
</div>
<?php
$judulbackup="";
$cekdata=@mysqli_query($kb,"select * from tbl_siswa");
$cekdatasiswa=@mysqli_num_rows($cekdata) or 0;
$cekdata=@mysqli_query($kb,"select * from tbl_bayar");
$cekdatabayar=@mysqli_num_rows($cekdata) or 0;
$cekdata=@mysqli_query($kb,"select * from pengeluaran");
$cekdatakeluar=@mysqli_num_rows($cekdata) or 0;
?>
<div style="width:100%;margin-top: 7px;padding-top: 13px;border-top: 1px solid #000;">
<?php
if (($cekdatasiswa>0)||($cekdatabayar>0)||($cekdatakeluar))
{ if ($cekdatasiswa>0) { ?>
<a href="index.php?do=tampil&page=setting&crud=backupdo&dataid=siswa" target="_blank"><button class="kotaktombol" style="width:auto;">Backup Data Siswa</button></a> <?php }; if ($cekdatabayar>0) { ?><a href="index.php?do=tampil&page=setting&crud=backupdo&dataid=bayar" target="_blank"><button class="kotaktombol" style="width:auto;">Backup Data Pembayaran</button></a> <?php }; if ($cekdatakeluar>0) { ?><a href="index.php?do=tampil&page=setting&crud=backupdo&dataid=keluar" target="_blank"><button class="kotaktombol" style="width:auto;">Backup Data Pengeluaran</button></a> <?php };
}
else
{echo "Tidak ada satupun data yang tersimpan di database";}
?>
</div>
<div style="width:100%;margin-top: 7px;padding-top: 13px;border-top: 1px solid #000;">
<button class="kotaktombol" style="width:auto;" onclick="hapusan('setting','siswa');">Hapus Data Siswa</button> <button class="kotaktombol" style="width:auto;" onclick="hapusan('setting','bayar');">Hapus Data Pembayaran</button> <button class="kotaktombol" style="width:auto;" onclick="hapusan('setting','keluar');">Hapus Data Pengeluaran</button>
</div>