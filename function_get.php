<?php

//include "https://drive.google.com/file/d/1CDDe-EubUBYmRKGk3PzkXEySJgpVAptK/view?usp=drive_link";

/* untuk formulir yang ada pilihan*/
function pilihan($pilihan,$target)
{
	foreach($pilihan as $key=>$value)
	{
		$keystr=strval($key);
		$targetstr=strval($target);
		if($keystr===$targetstr)
		{
			 echo "<option value='".$key."' selected>".$value."</option>";
		}
		else
		{
			 echo "<option value='".$key."'>".$value."</option>";
		}
	}
}

function pilihan_ext($pilihan,$target)
{
	foreach($pilihan as $key=>$value)
	{
		$keystr=strval($key);
		$targetstr=strval($target);
		if($keystr===$targetstr)
		{
			 echo "<option value='".$key."' ".(isset($value[1])?"title='".$value[1]."'":'')."  selected>".$value[0]."</option>";
		}
		else
		{
			 echo "<option value='".$key."' ".(isset($value[1])?"title='".$value[1]."'":'')." >".$value[0]."</option>";
		}
	}
}

/* lookparent master page */
function lookparent($id,$mysqli)
{
	if(isset($id) and $id!="")  
	{
		$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT parent FROM data_master WHERE id_master = ".$id.""));
		return $idd[0]; 
	}
	else
	{
		return 0;
	}
}

/* lookparent master page */
function cekchild($id,$cabang,$master,$mysqli)
{	
	//$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT id_register FROM pemetaan_suj WHERE id_jabatan IN (SELECT id_jabatan FROM data_jabatan WHERE parent = ".$id." ) AND id_cabangprt=".$cabang." AND status=1 LIMIT 1"));
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT IF(FIND_IN_SET('".$master."', (SELECT group_concat(id_master SEPARATOR ',') FROM pemetaan_grup_kpi WHERE id_grup_jabatan IN (SELECT id_grup FROM data_jabatan WHERE id_jabatan IN (SELECT id_jabatan FROM pemetaan_suj WHERE id_jabatan IN (SELECT id_jabatan FROM data_jabatan WHERE parent = ".$id." ) AND id_cabangprt=".$cabang." AND status=1))))>0,1,2)"));
	if($idd[0]==1)
	{
		return true;
	}
	else
	{
		return false;
	}
	 
}

/* lookparent master page */
function cekchildjab($id,$mysqli)
{	
	//$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT id_register FROM pemetaan_suj WHERE id_jabatan IN (SELECT id_jabatan FROM data_jabatan WHERE parent = ".$id." ) AND id_cabangprt=".$cabang." AND status=1 LIMIT 1"));
	
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "(SELECT 1 FROM data_jabatan WHERE parent=".$id." LIMIT 1)"));
	if($idd[0]==1)
	{
		return true;
	}
	else
	{
		return false;
	}	 
}

/* lookparent master page */
function lookregister($id,$mysqli)
{
	if(isset($id) and $id!="")  
	{
		$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT 1 FROM data_staff WHERE id_register = ".$id.""));
		return $idd[0]; 
	}
}

/* get nama user */
function getNama($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM user WHERE id_user = ".$id.""));
	return $idd[0]; 
}

/* get nama unit */
function getNamaUnit($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_struktur WHERE id_struktur = ".$id.""));
	return $idd[0]; 
}

/* get nama unit
function getNamaUnitBy($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_struktur WHERE id_struktur = (SELECT id_struktur FROM data_jabatan WHERE id_jabatan=".$id.")"));
	return $idd[0]; 
} */

/* get nama kpi */
function getNamaJabatan($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_jabatan WHERE id_jabatan = ".$id.""));
	return $idd[0]; 
}

/* get nama kpi */
function getNamaJabatanL($mysqli,$id) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama,(SELECT alias FROM kelas WHERE id_kelas=data_jabatan.kelas) FROM data_jabatan WHERE id_jabatan = ".$id.""));
	return $idd[0]." [".$idd[1]."]"; 
}

/* get nama kpi */
function getNamaGradeL($mysqli,$id) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama,alias FROM grade WHERE id_ = ".$id.""));
	return $idd[0]; 
}

/* get nama kpi */
function getNamaMaster($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_master WHERE id_master = ".$id.""));
	return $idd[0]; 
}


/* get nama kpi 
function getNamaGrup($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_grup_jabatan WHERE id_grup = ".$id.""));
	return $idd[0]; 
}*/

/* get nama kpi */
function getNamaCabang($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_cabang WHERE id_cabang = ".$id.""));
	return $idd[0]; 
}


/* get nama kpi */
function getNamaCabangL($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT (SELECT alias FROM tipecabang WHERE id_=(SELECT tipe FROM data_cabang WHERE id_cabang=".$id.")) as tc, (SELECT alias FROM kelas WHERE id_kelas=(SELECT kelas FROM data_cabang WHERE id_cabang=".$id.")) as kls, nama FROM data_cabang WHERE id_cabang = ".$id.""));
	return $idd[2]." [".$idd[0]."]"; 
}

/* get nama user */
function getNamaStaff($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM data_staff WHERE id_register = ".$id.""));
	return $idd[0]; 
}

/* get nama user */
function getPemetaanStaff($id,$mysqli) //OK
{//register,jabatan,cabang,date,struktur,grupjabatan,namastaff,approval,statuskan,mtdkpi
	#--- ini bakal nampil id_data
	// $idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT 
	// id_jabatan as idj,
	// id_cabang,
	// (SELECT id_grup FROM data_jabatan WHERE id_jabatan=idj) as grupjabatan,
	// (SELECT nama FROM data_staff WHERE id_register=".$id.") as namastaff,
	// id_peta FROM pemetaan_suj WHERE id_register = ".$id." and status=1 and status_jbt=0 LIMIT 1"));
	// return $idd;

	$query="CALL p_getPemetaanStaffbyIdr(".$id.")";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	$mysqli->next_result(); /* DITAMBAH JIKA PEMANGGILAN DENGAN STROE PROCEDUR*/
	return $idd;
}

function getPemetaanStaff1($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data 
	//register,jabatan,cabang,date,struktur,grupjabatan,namastaff,approval,statuskan,mtdkpi

	//query terakhir sebelum prosedur
	// $idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT id_register as idr,
	// id_jabatan as idj,
	// id_cabang,
	// date,
	// (SELECT id_struktur FROM data_jabatan WHERE id_jabatan=idj) as idstruktur,
	// (SELECT id_grup FROM data_jabatan WHERE id_jabatan=idj) as grupjabatan,
	// (SELECT nama FROM data_staff WHERE id_register=idr) as namastaff,
	// (SELECT approval FROM data_jabatan WHERE id_jabatan=idj) as jabapp,
	// status_jbt,
	// (SELECT mtd_kpi FROM data_jabatan WHERE id_jabatan=idj) as mtdkpi 
	// FROM pemetaan_suj WHERE id_peta = ".$id.""));
	// return $idd; 

	$query="CALL p_getPemetaanStaffbyPeta(".$id.")";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	$mysqli->next_result(); /* DITAMBAH JIKA PEMANGGILAN DENGAN STROE PROCEDUR*/
	return $idd; 
}


function getPemetaanStaff_nv($id,$mysqli) //OK
{
	$query="CALL p_getPemetaanStaffbyPeta_nv(".$id[0].",'".$id[1]."')";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	$mysqli->next_result(); /* DITAMBAH JIKA PEMANGGILAN DENGAN STROE PROCEDUR*/
	return $idd; 
}

/* get nama user */
function getDataStaff($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT b.nama,b.jk,DATE_FORMAT(b.ttl,'%d %M %Y'),b.jbstatus,DATE_FORMAT(b.tglterdaftar,'%d %M %Y'),a.id_jabatan as idj,(SELECT nama FROM data_jabatan WHERE id_jabatan=idj) as nmjabatan,(SELECT nama FROM data_struktur WHERE id_struktur=(SELECT id_struktur FROM data_jabatan WHERE id_jabatan=idj)) as nmstruktur,a.id_cabang as idcab,(SELECT nama FROM data_cabang WHERE id_cabang=idcab) as nmcabang,(SELECT nama FROM tipecabang WHERE id_=(SELECT tipe FROM data_cabang WHERE id_cabang=idcab)) as nmtipe,
	b.photo_url,b.photo_type,SHA2(b.id_register,0) as photosmall
	
	FROM pemetaan_suj a,data_staff b WHERE b.id_register = ".$id." AND a.id_register = b.id_register AND a.status=1 LIMIT 1"));
	return $idd; 
}

function getDataStaffL($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT id_register,nama,jk,ttl,jbstatus,tglterdaftar,last_login,(SELECT deskripsi FROM grade WHERE id_=data_staff.grade) FROM data_staff WHERE id_register=".$id.""));
	return $idd; 
}

/* get NAMA */
function getnamakelas($id,$mysqli) //OK
{
	#--- ini bakal nampil id_data
	$idd=mysqli_fetch_row(mysqli_query($mysqli, "SELECT nama FROM kelas WHERE id_kelas=".$id.""));
	return $idd[0]; 
}

function AturParent($mysqli,$id,$lib) //OK
{
	$lib=array();
	$query = "SELECT  @org_id as id,
    (SELECT @org_id := parent FROM data_master WHERE id_master = @org_id) AS parent_id 
	FROM (SELECT @org_id :=".$id." ) vars, data_master org 
	WHERE @org_id != 0 
	ORDER BY id_master";
	$result = mysqli_query($mysqli, $query);
	while($row = mysqli_fetch_row($result))  
	{
		if(!isset($lib[$row[1]]))
		{
			$lib[$row[1]]=array();
		}
		if (!in_array($id, $lib[$row[1]]))
  		{
			array_push($lib[$row[1]],$row[0]);
		}
		
	}
	return $lib;
}

function kumpulkpi($mysqli,$grup) //OK
{
	$lib=array();
	$query = "SELECT id_master FROM pemetaan_grup_kpi WHERE id_grup_jabatan=".$grup."";
	$result = mysqli_query($mysqli, $query);
	while($row = mysqli_fetch_row($result))  
	{
		$lib=AturParent($mysqli,$row[0],$lib);
	}
	
	return $lib;
}

function gatcbyParent($mysqli,$id,$date) //OK
{
	//gatlast sebelum procedur	
	// $query="
	// SELECT 
	// CASE
	// 	WHEN bndprt = 0 AND portal_mnl=0 /*TIDAK FOLLOW PRNT DAN OTOMATIS*/ THEN 
	// 		CASE 
	// 			WHEN ( DATE_FORMAT( DATE_ADD( NOW( ), INTERVAL - 1 MONTH ), '%m' ) ) = ( DATE_FORMAT( '".$date."', '%m' ) ) THEN
	// 			(SELECT IF(MOD((DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 MONTH),'%m')), (SELECT value FROM setting WHERE id_=7))=0 
	// 			AND (DATE_ADD(LAST_DAY('".$date."'),INTERVAL + (SELECT value FROM setting WHERE id_=18) DAY) < DATE_FORMAT( NOW( ), '%Y-%m-%d') ), DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 MONTH),'%Y-%m'),0))			
	// 			ELSE 0
	// 		END
	// 	WHEN bndprt = 0 AND portal_mnl=1 /*TIDAK FOLLOW PRNT DAN MANUAL*/ THEN 
	// 		CASE WHEN (NOW( ) >= wwl AND NOW( ) <= wal) AND (DATE_FORMAT('".$date."','%Y-%m')=DATE_FORMAT(perwl,'%Y-%m')) THEN 
	// 			(SELECT IF(NOW()>perwl,DATE_FORMAT(perwl,'%Y-%m'),0))
	// 		ELSE 
	// 			0 
	// 		END
	// 	ELSE 
	// 	(	
	// 		SELECT
	// 		CASE
	
	// 		WHEN T2.bndprt = 0 AND T2.portal_mnl=0 THEN 
	// 			CASE 
	// 				WHEN ( DATE_FORMAT( DATE_ADD( NOW( ), INTERVAL - 1 MONTH ), '%m' ) ) = ( DATE_FORMAT( '".$date."', '%m' ) ) THEN 
	// 				(SELECT IF(MOD((DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 MONTH),'%m')), (SELECT value FROM setting WHERE id_=7))=0 AND (DATE_ADD(LAST_DAY('".$date."'),INTERVAL + (SELECT value FROM setting WHERE id_=18) DAY) < DATE_FORMAT( NOW( ), '%Y-%m-%d') ), DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 MONTH),'%Y-%m'),0))		
	// 				ELSE 0
	// 			END
	// 		WHEN (NOW() >= T2.wwl AND NOW()<= T2.wal) AND (DATE_FORMAT('".$date."','%Y-%m')=DATE_FORMAT(T2.perwl,'%Y-%m')) THEN 
	// 			(SELECT IF(NOW()>T2.perwl,DATE_FORMAT(T2.perwl,'%Y-%m'),0))
	// 		ELSE
	// 			0
	// 		END as izin

	// 		FROM
	// 		(
	// 		SELECT
	// 			@r1 AS _id,
	// 			( SELECT @r1 := parent FROM data_cabang WHERE id_cabang = _id ) AS parent,
	// 			( SELECT @bnd := bndprt FROM data_cabang WHERE id_cabang = _id ) AS bnd_parent,
	// 			@l := @l + 1 AS lvl 
	// 		FROM
	// 			(
	// 			SELECT
	// 				@r1 := ( SELECT id_cabang FROM data_cabang WHERE id_cabang = ".$id." AND STATUS = 1 ),
	// 				@bnd := ( SELECT bndprt FROM data_cabang WHERE id_cabang = @r1 AND STATUS = 1 ),
	// 				@l := 0 
	// 			) varsx,
	// 			data_cabang h 
	// 		WHERE
	// 			@r1 <> 0 
	// 			AND @bnd <> 0 
	// 		) T1
	// 		JOIN data_cabang T2 ON T1.parent = T2.id_cabang 
	// 		ORDER BY
	// 		T1.lvl DESC 
	// 		LIMIT 1
	// 	)
			
	// END as izin
	// FROM data_cabang WHERE id_cabang = ".$id." and status=1";

	$query="SELECT f_showgatcbyParent('".$date."',".$id.")";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	
	return $idd[0];
}

function tgl_indo($tanggal,$show){
	$bulan = array (
	1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
		$pecahkan = explode('-', $tanggal);

        if($show=='dmy')
        {
            return $pecahkan[2].' '.$bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
		else if($show=='m')
        {
            return $bulan[ (int)$pecahkan[1] ];
        }
		else if($show=='Y')
        {
            return $pecahkan[0];
        }
        else
        {
            return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
	}

function getallchild_gc($mysqli,$idtarget,$tabelid,$self,$ext)
{
	if($tabelid==1)
	{
		$tabel="data_jabatan";
		$primid="id_jabatan";
	}
	else if($tabelid==2)
	{
		$tabel="data_cabang";
		$primid="id_cabang";
	}
	else 
	{
		$tabel="data_struktur";
		$primid="id_struktur";
	}

	// $query="SELECT
	// GROUP_CONCAT( idc ) 
	// FROM
	// (
	// 	".(($self==1)?" ( SELECT ".$primid." AS idc FROM ".$tabel." WHERE ".$primid." = ".$idtarget." ) UNION ":'')."
	// 	(
	// 	SELECT
	// 		GROUP_CONCAT( lv SEPARATOR ',' ) AS idc 
	// 	FROM
	// 		(
	// 		SELECT
	// 			@pv := ( SELECT GROUP_CONCAT( ".$primid." SEPARATOR ',' ) FROM ".$tabel." WHERE FIND_IN_SET( parent, @pv ) ) AS lv 
	// 		FROM
	// 			".$tabel."
	// 			JOIN ( SELECT @pv := ".$idtarget." ) tmp 
	// 		) a 
	// 	) 
	// ) AS s";
	
	//yang dipakai yang bawah jika bermasalah
	// $query="
	// SELECT
	// CASE
		
	// WHEN
	// 	ISNULL( child ) = 1 THEN
	// 	".$idtarget." ELSE CONCAT( ".$idtarget.", ',', child ) 
	// 		END AS Result 
	// FROM
	// 	(
	// 	SELECT
	// 		IFNULL(
	// 			(
	// 			SELECT
	// 				GROUP_CONCAT( lv SEPARATOR ',' ) AS idc 
	// 			FROM
	// 				(
	// 				SELECT
	// 					@pv := ( SELECT GROUP_CONCAT( ".$primid." SEPARATOR ',' ) FROM ".$tabel." WHERE FIND_IN_SET( parent, @pv ) ) AS lv 
	// 				FROM
	// 					".$tabel."
	// 					JOIN ( SELECT @pv := ".$idtarget." ) tmp 
	// 				) a 
	// 			),
	// 		NULL 
	// 		) AS child 
	// ) a ";

	$query = "SELECT f_getallchild_gc(".$idtarget.",'".$tabel."')";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	//$mysqli->next_result(); /* DITAMBAH JIKA PEMANGGILAN DENGAN STROE PROCEDUR*/
	
	return $idd[0]; 
}

function img_check($register,$html)
{
	$image = 'staff_images/'.$register.'.jpg';

	if (file_exists($image)) 
	{
    	echo '<'.$html.'src="'.$image.'">';
	} 
	else 
	{
		echo '<'.$html.' src="staff_images/default.jpg">';
	}
}

function img_check5($obj)
{
	if (!empty($obj[2])) 
	{
		$link="webservice_get.php?url=".$obj[2]."&url_type=".$obj[3]."";
    	echo '<'.$obj[1].'src="'.$link.'">';
	} 
	else 
	{
		$image = 'staff_images/'.$obj[0].'.jpg';
		if (file_exists($image)) 
		{
			echo '<'.$obj[1].'src="'.$image.'">';
		} 
		else 
		{
			echo '<'.$obj[1].' src="staff_images/default.jpg">';
		}
	}
}

function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'key_one';
	$secret_iv = 'key_two';
	// hash
	$key = hash('sha256', $secret_key);
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		//$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

		if($output = base64_decode($string))
		{
			$output = openssl_decrypt($output, $encrypt_method, $key, 0, $iv);
		}
		else 
		{
			$output = 'ERR';
		}
	}
	return $output;
}

function img_check2 ($url,$token,$type,$register,$html)
{
  $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36';
  
  $headers = array(
    "Accept: */*",
    "X-Authorization: Bearer ".$token,
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

  $output = curl_exec($ch);
  curl_close($ch);

  header('Content-type: '.$type);
  header('Content-Disposition: inline; filename="'.uniqid().'"');


	if (!empty($output )) 
	{
		//echo '<'.$html.' src="'.$image.'">';
		echo '<'.$html.' src="'.img_check2 ('http://172.16.98.11/hcis_api/api/file/user_profile2/8pleBV0e6YWIxPs1ynA8R0oNxPY9FD5I7pIbXylnnpXNz9uAwTrimpCHNKZPldgFTUEV3m7_h-OZ2cTj',$token,'image/jpeg').'">';
	} 
	else 
	{
		echo '<'.$html.' src="staff_images/default.jpg">';
	}
}

function img_check3 ($url,$token,$type,$register,$html)
{
  $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36';
  
  $headers = array(
    "Accept: */*",
    "X-Authorization: Bearer ".$token,
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

  $output = curl_exec($ch);
  curl_close($ch);

  header('Content-type: '.$type);
  header('Content-Disposition: inline; filename="'.uniqid().'"');


	if (!empty($output )) 
	{
		//echo '<'.$html.' src="'.$image.'">';
		echo '<'.$html.' src="'.img_check2 ('http://172.16.98.11/hcis_api/api/file/user_profile2/8pleBV0e6YWIxPs1ynA8R0oNxPY9FD5I7pIbXylnnpXNz9uAwTrimpCHNKZPldgFTUEV3m7_h-OZ2cTj',$token,'image/jpeg').'">';
	} 
	else 
	{
		echo '<'.$html.' src="staff_images/default.jpg">';
	}
}

function trimstr($mysqli,$maxchar,$str)
{
	$query="SELECT (SELECT IF(CHAR_LENGTH('".$str."')>".$maxchar.",CONCAT(SUBSTRING('".$str."', 1, ".$maxchar."),'...'),SUBSTRING('".$str."', 1, ".$maxchar."))) as str";
	$idd=mysqli_fetch_row(mysqli_query($mysqli, $query));
	return $idd[0]; 
}


?>