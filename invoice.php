
<?php
 
  
include "connect.php"; 
ini_set('memory_limit','2048M');
ini_set('max_execution_time', 900); //300 seconds = 5 minutes
date_default_timezone_set('Europe/Rome');
function numCheck($value){
  return (double)$value;
}
require_once(__DIR__.'/vendor/autoload.php');
set_include_path("dompdf/");
require_once "autoload.inc.php";


use Dompdf\Dompdf;
use mikehaertl\wkhtmlto\Pdf;
/*Temporarily turning of error reporting since cond['example'] might be
null and number_format prints warnings/errors and pdf is not generated*/
//error_reporting(0);

$dompdf = new DOMPDF();



$dompdf->set_paper("A4", "landscape");

$cond= json_decode($_POST['condo_info'],true);

$cod = $cond['codice'];
$scad=  $cond['scad'];
$temp_condo = $cond['condo'];
$condo=  explode("::",$temp_condo )[0];
$ref = "Totale Acquedotto Ivato";



$periodo = "trim.";
if(isset(explode("::",$temp_condo )[1]))
{
    $ref = "Totale Ivato";
    $periodo = explode("::",$temp_condo )[1];
}

$amm = $cond['amministratore'];
$sez = $cond['sez'];
$cat = $cond['cat'];
$ruolo = $cond['ruolo'];
$tf = $cond['tf'];
$nuae = explode(":",$cond['nuae'])[0];
$nuaeND = explode(":",$cond['nuae'])[1];

$testnd = " - NUAE Non Domestico: $nuaeND";
if(!is_numeric($nuaeND))
{
    $testnd = "";
}

$nou = $cond['numofusers'];
$tel = $cond['tel'];
$ind = $cond['ind'];

 $particular_state = array();

/*General values*/
$attG =($cond['attG']);
$preG =($cond['preG']);
$consG=(explode(":",$cond['consG'])[0]);

$consAcc =(explode(":",$cond['consG'])[1]);

$impG   = number_format(numCheck(explode(":",$cond['impG'])[0]),2,',','.');
$impAcc = number_format(numCheck(explode(":",$cond['impG'])[1]),2,',','.');

$depG   = number_format(numCheck(explode(":",$cond['depG'])[0]),2,',','.');
$depAcc = number_format(numCheck(explode(":",$cond['depG'])[1]),2,',','.');

$qfG    = number_format(numCheck($cond['qfG']),2,',','.');
$qfAcc  = 0;//number_format(numCheck($cond['qfG']),2,',','.');number_format(numCheck($cond['qfG']),2,',','.');

$totG   = number_format(numCheck(explode(":",$cond['totG'])[0]),2,',','.');
$totAcc = number_format(numCheck(explode(":",$cond['totG'])[1]),2,',','.');

$varie =number_format(numCheck($cond['varie']),2,',','.');

$consAcc = ($consAcc > 0) ? $consAcc : "";
$impAcc  =  ($impAcc > 0) ? $impAcc  : "";
$depAcc  = ($depAcc > 0) ? $depAcc : "";
$qfAcc =  ($consAcc > 0) ? $qfAcc : "";

/*Total values*/
$tot_cons = $cond['tot_cons']; 

// echo $tot_cons;
// exit;

$tot_fasc = number_format(numCheck($cond['tot_fasc']),2,',','.');

$tot_DF = number_format(numCheck($cond['tot_DF']),2,',','.');
$tot_QF = number_format(numCheck($cond['tot_QF']),2,',','.');
$tot_DC = number_format(numCheck($cond['tot_DC']),0,',','.');
$tot_IMP = number_format(numCheck($cond['tot_IMP']),2,',','.');
$tot_IVA = number_format(numCheck($cond['tot_IVA']),2,',','.');
$tot_ArrP = number_format(numCheck($cond['tot_ArrP']),2,',','.');
$tot_ArrA = number_format(numCheck($cond['tot_ArrA']),2,',','.');

$tot_tot = number_format(numCheck($cond['tot_tot']),2,',','.');


$user= json_decode($_POST["user0"],true);
$data = $user['data']; 
    
    $tempdata = explode("-", $data);
    $data=    $tempdata[2]."/".$tempdata[1]."/".$tempdata[0];

$html="";
$html .= "
<style>

table {
    border-collapse: collapse;
    border-spacing: 0;
}

body {
     font-family: 'Arial Unicode';
     margin: 0;
     padding: 0;
     height: 20mm; 
     
}



/*CELL styles*/
#first_row td{
  border:1.5px solid black;
  font-size:0.3cm;
}

#second_row td{
  font-size:0.3cm;
  
}


#inner_table2 tr td{
  border:1.5px solid black;
  font-size:0.4cm;
  text-align:center;
  
  
}

#inner_table4 tr td{
  margin-bottom:-0.2px;
  padding-bottom:-0.2px;
  font-size:0.4cm;
  text-align:center;
  border:1.5px solid black;
 
}

#title2{
  border:1.5px solid black;
  font-size:0.4cm;
  font-weight:bold;
}

#cen{
  border:1px solid white;
  color:white;
}



/*Table styles*/


#main_table{
 
  border-left :1.5px solid black;
  border-right :1.5px solid black;
  border-collapse:collapse;
  margin-left:-10px;
  margin-top:-10px;
  width:42cm;
  margin: 0 auto;
}

.inner_table
{
     margin:0 auto;
     width:100%;
}
#inner_table1{
 
  border-collapse:collapse;
  width:80%;
  margin: 0 auto;
}
#inner_table2{
  border-collapse:collapse;
  
}
#inner_table3{
  border-collapse:collapse;
}
#inner_table4{
  border-collapse:collapse;
  margin-top:-2px;
}


#totals{
 
  left: 2.5cm;
  top: 25cm;
  float:right;
  font-size:0.4cm;
  width:99.8%;
  height:1cm;
  border:1.5px solid black;
  margin-top:2.5cm;
  
}

#totals p{
 
  margin-left:10cm;
  font-size:0.4cm;
  float:left;
  text-align:right;
  margin-right: 40px;
  font-weight:bold;
  
}

.legenda{
    
    
    font-size:0.3cm;
    margin:0 auto; 
    text-align:left;
    width:20%;
    bottom:0;
    
    
   
}

.new-page {
    page-break-before: always;
  }
  
br{
  line-height:0.2cm;
}


@page {
  margin-left: 1.5cm;
  margin-top: 0.8cm;
  margin-bottom: 0;
  margin-right:1cm:
}

#first_row > td {text-align:left}
#inner_table1_first_row > td:first-child{padding-left:0px;}
#inner_table1_first_row > td:second-child {font-size:0.4cm; text-align:center;}
#inner_table2 > tr:first-child{border:1px solid white;border-right:1px solid black;}
#inner_table2 > tr:last-child{border:1.5px solid black;}


.final{text-align:center}
.trow
{text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;}


</style>
";
$speciale_htmlS = "";
$speciale_htmlY = "";
$nouperpage = 37;
if($nouperpage == $nou ) 
{
    $nouperpage = $nouperpage - 1;
}

if(fmod($nou/$nouperpage, 1) === 0.00)
{
    $nouperpage = $nouperpage - 1;
}

$nopages = ceil($nou/$nouperpage);


$x =0;

for($j=0; $j < $nopages; $j++ ){
    
  $to = $nouperpage*($j+1);
          if($j == $nopages-1){
            $to = $nouperpage*($j)+$nou % $nouperpage;
           
          }

//$consAcc
//$impAcc
//$depAcc
//$totAcc

/*
                          <td width="1.3cm">Consumo<br>{$consG}<br>---<br>{$consAcc} </td>
                          <td width="1.5cm">Imp.Cons<br>{$impG}<br>---<br>{$impAcc}  </td>
                          <td width="1.5cm">Dep.fogn<br>{$depG}<br>---<br>{$depAcc}  </td>
                          <td width="1.5cm">Q.F.<br>{$qfG}<br>---<br>{$qfAcc}</td>
*/
if($consAcc > 0)
{
    

$html .= <<<EOD
 

<table id=main_table >
	<tr id="first_row">
		<td width="1.5cm">CODICE<br>{$cod}</td>
		<td width="1.5cm">SCAD<br>{$scad}</td>
		<td width="11cm">CONDOMINIO: {$condo} <br>NUAE: {$nuae} - T.F.: {$tf} - Data lett.: {$data} {$testnd}</td>
		<td width="7cm">Amministratore &nbsp;&nbsp;{$amm}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$tel}<br>{$ind}</td>
		<td width="1cm" >Sez {$sez}</td>
		<td width="1cm" >Cat.<br>{$cat}</td>
		<td width="1cm" >Ruolo<br>{$ruolo}</td>
	</tr>
  <tr id="second_row">
    <td colspan="7">
        <table class="inner_table" id="inner_table1">
          <tr id="inner_table1_first_row">
            <td width="2.5cm" rowspan="2" ><img id="img" width="90cm" height="90cm"  src="https://i.imgur.com/eK6vG8c.jpg"></td>
            <td width="12cm" id='strong_r1'><strong><br><br><br><br>SITUAZIONE CONTATORE GENERALE</strong></td>
            
          </tr>
          <tr>
           
            <td width="16cm" colspan="2">
            
              <table  class="inner_table" id="inner_table2">
                <tr>
                  <td width="1.3cm" height='1.05cm'>attuale<br>{$attG} </td>
                  <td width="1.3cm">precedente<br>{$preG}</td>
                          <td width="1.3cm">consumo<br>{$consG}<br>---<br>{$consAcc} </td>
                          <td width="1.5cm">imp.cons<br>{$impG}<br>---<br>{$impAcc}  </td>
                          <td width="1.5cm">dep.fogn<br>{$depG}<br>---<br>{$depAcc}  </td>
                          <td width="1.5cm">Q.F.<br>{$qfG}<br>---<br>{$qfAcc}</td>
                  <td width="1.5cm">varie<br>{$varie}</td>
                  <td width="3.8cm"><strong>{$ref}<br>&euro; {$totG} </strong></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td colspan="7">
      <table  style='width:100%' class="inner_table" id="inner_table3">
        <tr>
         
          <td align="center" id="title2">PROSPETTO DETTAGLIO CONSUMI ACQUA AD USO AMMINISTRATIVO INTERNO</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="7">
      <table class="inner_table" id="inner_table4" cellspacing="0">
        <tr>
          <td style='width:3%' style='width:40px;' >ID</td>
          <td  style='width:15%'>nome</td>
          <td style='width:5%'>is</td>
          <td style='width:5%'>sc</td>
          <td  style='width:5%'>interno</td>
          <td  style='width:5%'>attuale</td>
          
          <td  style='width:5%'>precedente</td>
          <td  style='width:3%'> * </td>
          <td  style='width:5%'>m<sup>3</sup></td>
          
          <td  style='width:5%'>importo consumo</td>
          <td  style='width:5%'>importo acconto </td>

          <td  style='width:4%'>dep/fog</td>
          <td  style='width:3%'>Q.F.</td>
          <td  style='width:5%'>conguaglio</td>
          <td  style='width:5%'>oneri</td>
          <td  style='width:3%'>iva</td>
          <td  style='width:3%'>arrotondamenti</td>
          <td  style='width:8%'>tot.bolletta</td>
        </tr>

EOD;
}
/* <td  width="1.5cm">{$periodo}</td>
          <td  width="1.2cm">imp 3^F</td>
          <td  width="1.2cm">imp 4^F</td>
          <td  width="1.2cm">imp 5^F</td>
          
         <td  width="1cm">arr.pr</td>
          <td  width="1cm">arr.att</td>
*/
else
{
    

$html .= <<<EOD
 

<table id='main_table' >
	<tr id="first_row" >
		<td  width="1.5cm">CODICE<br>{$cod}</td>
		<td width="1.5cm">SCAD<br>{$scad}</td>
		<td width="11cm">CONDOMINIO: {$condo} <br>NUAE: {$nuae} - T.F.: {$tf} - Data lett.: {$data}{$testnd}</td>
		<td width="7cm">Amministratore &nbsp;&nbsp;{$amm}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$tel}<br>{$ind}</td>
		<td width="1cm" >Sez {$sez}</td>
		<td width="1cm" >Cat.<br>{$cat}</td>
		<td width="1cm" >Ruolo<br>{$ruolo}</td>
	</tr>
  <tr id="second_row">
    <td colspan="7">
        <table class="inner_table" id="inner_table1">
          <tr id="inner_table1_first_row">
            <td width="2.5cm" rowspan="2" ><img id="img" width="90cm" height="90cm"  src="https://i.imgur.com/eK6vG8c.jpg"></td>
            <td width="12cm" style='text-align:center;font-size:15px;' id='strong_r1'><strong><br><br><br><br>SITUAZIONE CONTATORE GENERALE</strong></td>
            
          </tr>
          <tr>
           
            <td width="16cm" colspan="2">
            
              <table  class="inner_table" id="inner_table2">
                <tr>
                  <td width="1.3cm" height='1.05cm'>Attuale<br>{$attG} </td>
                  <td width="1.3cm">precedente<br>{$preG}</td>
                  <td width="1.3cm">consumo<br>{$consG}<br></td>
                  <td width="1.5cm">imp.cons<br>{$impG}</td>
                  <td width="1.5cm">dep./fogn.<br>{$depG} </td>
                  <td width="1.5cm">Q.F.<br>{$qfG}</td>
                  <td width="1.5cm">varie<br>{$varie}</td>
                  <td width="3.8cm"><strong>{$ref}<br>&euro; {$totG} </strong></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
    </td>
  </tr>
 
  <tr>
    <td colspan="7">
      <table style='width:100%' class="inner_table" id="inner_table3">
        <tr>
         
          <td align="center" id="title2">PROSPETTO DETTAGLIO CONSUMI ACQUA AD USO AMMINISTRATIVO INTERNO</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="7">
      <table class="inner_table" id="inner_table4" cellspacing="0">
        <tr>
          <td  style='width:3%'  style='width:40px;' ">ID</td>
          <td  style='width:16%'>nome</td>
          <td  style='width:5%'>is</td>
          <td  style='width:5%'>sc</td>
          <td  style='width:5%'>interno</td>
          <td  style='width:5%'>attuale</td>
          
          <td  style='width:5%'>precedente</td>
          <td  style='width:3%'> * </td>
          <td  style='width:5%'>m<sup>3</sup></td>
          
          <td  style='width:5%'>importo consumo</td>
          <td  style='width:5%'>importo acconto </td>

          <td  style='width:4%'>dep/fog</td>
          <td  style='width:3%'>Q.F.</td>
          <td  style='width:5%'>conguaglio</td>
          <td  style='width:5%'>oneri</td>
          <td  style='width:3%'>iva</td>
          <td  style='width:3%'>arrotondamenti</td>
          <td  style='width:8%'>tot.bolletta</td>
        </tr>

EOD;
}
//$x+=($nopages-1)*$j;

$cont = 0;
for (; $x <$to; $x++) {
$cont++;
$user= json_decode($_POST["user$x"],true);

$utente = $user['utente'];
$name = $user['name'];
$sie = $user['sie'];
$last[0] =  $user['ls'];
$int = $user['int'];
$attuate = $user['attuate'];
$pre = $user['pre'];
$star = $user['star'];
if($star == "OK")
{
        $star = "K";
}
$cons = $user['cons'];
$tr = $user['tr'];
$imp1 =number_format(numCheck($user['imp1']),2,',','.');
$imp2 =number_format(numCheck($user['imp2']),2,',','.');
$imp3 =number_format(numCheck($user['imp3']),2,',','.');
$imp4 =number_format(numCheck($user['imp4']),2,',','.');
$imp5 =number_format(numCheck($user['imp5']),2,',','.');
$depfog =number_format(numCheck($user['depfog']),2,',','.');
$qfiss =number_format(numCheck($user['qfiss']),2,',','.');
$diffcons =number_format(numCheck($user['diffcons']),2,',','.');
$imponver =number_format(numCheck($user['imponver']),2,',','.');
$iva =number_format(numCheck($user['iva']),2,',','.');

$arrpf =number_format(numCheck($user['arrpf']),2,',','.');
$arratt =number_format(numCheck($user['arratt']),2,',','.');

$totbolletta = number_format(numCheck($user['totbolletta']),2,',','.');

$acconto = number_format(numCheck($user['acconto']),2,',','.');


$area_inte     = "";
$area_nome     = "";
$area_diffcons = "";

$fullname      = "";

   $getNames = "select Nome, Cognome, Interno from Utenze, Condominio where id_user = '$utente' and Interno = '$int' and Condominio.id_condo = $cod and ID_Condominio = Id; ";
   $result_esiste   = mysqli_query($connection, $getNames);	
		
		$e                 = mysqli_fetch_object($result_esiste);
        $nome              = $e->Nome;
        $cognome           = $e->Cognome;
        $internosel        = $e->Interno;
       
        $fullname          = $cognome." ".$nome;
        //$fullname          = str_replace("'", "\'", $fullname);
  
        
        if(strlen($internosel) < 8)
        {
            $area_inte = "<td style='text-align:center;border-left:1.5px solid black;border-top:0.05cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;'>{$int}</td>";
        }
        else  if(strlen($internosel) < 3)
        {
             $area_inte = "<td style='text-align:center;border-left:1.5px solid black;border-top:0.05cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;'>{$int}</td>";
        }
        else
        {
            
             $area_inte = "<td style='text-align:left;border-left:1.5px solid black;border-top:0.05cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;'>{$int}</td>";
      
        }
        
        if(strlen($fullname) < 23)
        {
            $area_nome = "<td valign='bottom' style='text-align:left;border-left:1.5px solid black;border-top:0.05cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;margin-right:-2cm;'>{$fullname}</td>";
        }
        else
        {
            $fullname = substr($fullname, 0, 23). "...";
            
             $area_nome = "<td valign='bottom' style='text-align:left;border-left:1.5px solid black;border-top:0.05cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;margin-right:-2cm;'>{$fullname}</td>";
      
        }
        
        
    $num_length = strlen((string)$diffcons);

    if($num_length >= 8) {
        
        $area_diffcons = "<td valign='bottom'  style='text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm'>{$diffcons}</td>";
        
    } else {
        $area_diffcons = "<td valign='bottom'  style='text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm'>{$diffcons}</td>";
    }
 

if( $last[0] === null)
{
     $last[0] = "";
}

if($star === "Y" )
{
    
    $speciale_htmlY.= $utente.". ". $fullname." Media Cont. illeggibile "."<br>" ;
}
else if ( $star === "S")
{
     $speciale_htmlS.= $utente.". ". $fullname."<br>" ;
}
$nullarea = "";
$segnalY = "<strong>Le utenze di seguito indicate hanno contatori che necessitano di sostituzione </strong>";
$segnalS = "<strong>Sulle utenze di seguito indicate e' stato sostituito il contatore</strong> ";

/*

  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$tr}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$imp3}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$imp4}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$imp5}</td>
  \<td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$arratt}</td>
  
*/
$nullarea = "";
$totaleFascia = number_format(numCheck(($user['imp1'] +$user['imp2']+$user['imp3']+$user['imp4']+$user['imp5'])),2,',','.');
$totaleArr    = number_format(numCheck(($user['arrpf'] + $user['arratt'])),2,',','.');



$html .= <<<EOD
<tr class="users_row">
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;padding-bottom:-0.05cm; font-weight:bold; ">{$utente}</td>
  {$area_nome}
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$last[0]}</td>
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$sie}</td>
  {$area_inte}
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white ;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$attuate}</td>
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white ;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$pre}</td>
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$star}</td>
  <td valign="bottom" style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white ;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$cons}</td>
  
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$totaleFascia}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$acconto}</td>

  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$depfog}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$qfiss}</td>
 
  {$area_diffcons}
  
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$imponver}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$iva}</td>
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;">{$totaleArr}</td>
  
  <td valign="bottom"  style="text-align:center;border-left:1.5px solid black;border-right:1.5px solid black;border-bottom:1.2px solid lightgrey;border-top:0.01cm solid white;font-size:0.4cm;"><b>{$totbolletta}</b></td>
</tr>


EOD;

if($x == ($to-1))
{
    if($cont < $nouperpage)
    {
    
     for($l = $cont; $l <= $nouperpage-1; $l++)
     {
        $html .= "<tr style='visibility:hidden;' class='users_row'><td  valign='bottom'  style='text-align:center;border-left:1.5px solid black;border-top:0.01cm solid white;border-bottom:1.2px solid lightgrey;font-size:0.4cm;'> {$utente}</td></tr>";
     }
   }
}
}


$unity = "";
if($tf == 1)
{
    $unity = "m<sup>3</sup>";
   // $tot_DC = $tot_DC;
    
}
/*
     <p id="tarra" style="position:absolute;left:18cm;font-size:0.35cm"><i>Att. {$tot_ArrA}</i></p>
     number_format(numCheck(($cond['tot_ArrP'] + $cond['tot_ArrA'])),2,',','.');
*/
$totarut = number_format(numCheck(($cond['tot_ArrP'] + $cond['tot_ArrA'])),2,',','.');
$html .= <<<EOD
  </table>
        </td>
      </tr>
  </table>
 
  <div id="totals" style='margin-top: 20px;'>
    <p id="tcon"  style="position:absolute;left:-0.7cm;font-size:0.35cm"><i>cons.</i> {$tot_cons}  m<sup>3</sup> </i></p>
    <p id="tfas"  style="position:absolute;left:2.0cm;font-size:0.35cm"><i>&euro; </i>{$tot_fasc}<sup><i style='visibility:hidden;'>1</i></sup></i></p>
    <p id="tdf"   style="position:absolute;left:4.5cm;font-size:0.35cm"><i>dep./fogn. {$tot_DF}<sup><i style='visibility:hidden;'>1</i></i></p>
    <p id="tqf"   style="position:absolute;left:8cm;font-size:0.35cm"><i>Q.F. {$tot_QF}<sup><i style='visibility:hidden;'>1</i></i></p>
    <p id="tdc"   style="position:absolute;left:11cm;font-size:0.35cm"><i>conguaglio {$tot_DC}{$unity}<sup><i style='visibility:hidden;'>1</i></i></p>
    <p id="timp"  style="position:absolute;left:15cm;font-size:0.35cm"><i>oneri {$tot_IMP}<sup><i style='visibility:hidden;'>1</i> </i></p>
    <p id="tiva"  style="position:absolute;left:18.25cm;font-size:0.35cm"> <i> iva {$tot_IVA}<sup><i style='visibility:hidden;'>1</i></i></p>
    <p id="tarrp" style="position:absolute;left:20.25cm;font-size:0.35cm"><i>arrotondamento {$totarut}<sup><i style='visibility:hidden;'>1</i></i></p>
   
    <p  id="ttot" style="position:absolute;left:26.5cm;font-size:0.38cm;font-weight:bold" ><i>tot. boll. </i>&euro; {$tot_tot}<sup><i style='visibility:hidden;'>1</i></p>
  </div>
 
EOD;

$html .= <<<EOD
        
         
        <br><br><br>
        <pre id="legenda" style='margin-top: 25px;' >                                                 *Legenda K = lett. verificata; U = utente; T = telefono; F = foto contatore; I = internet; L = cartolina;  S = contatore sostituito; X = cons. presunto per utenza chiusa; Y = m. contatore guasto illeggibile o fermo; C = disabitato; 
        </pre> </div>
EOD;

$html .= "<div class='new-page'></div>";
}

if($speciale_htmlS == "")
{
    $segnalS        = "";
    $speciale_htmlS = "";
}

if($speciale_htmlY == "")
{
    $speciale_htmlY = "";
    $segnalY        = "";
}

$html .= <<<EOD
        
            <p class='final'>{$segnalY}</p>
        
            <p class='final'>{$speciale_htmlY}</p>
            
            
            <p class='final'>{$segnalS}</p>
        
            <p class='final'>{$speciale_htmlS}</p>
            
        
            
        
EOD;

/*Uncomment to see html*/
//echo  ($html);
//exit;

//f$dompdf->load_html(utf8_decode($html), 'UTF-8');


$pdf = new Pdf(array(
    'binary' => 'vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',
    'no-outline',    
    'ignoreWarnings' => true,
    'margin-top'     => 1.60,
    'margin-right'   => 0.67,
    'margin-bottom'  => 0.00,
    'margin-left'    => 0.67,
    'footer-html' => 'http://www.google.com',
    'orientation' => 'landscape',
    'commandOptions' => array(
        'useExec' => true,      // Can help on Windows systems
        
        'procEnv' => array(
            // Check the output of 'locale -a' on your system to find supported languages
             'LANG' => 'utf-8',
        ),
     ),
    ));
     $pdf->addPage($html);
     
     if (!$pdf->send()) {
         echo "ERROR:".$pdf->getError();
      }
// $dompdf->load_html($html);

// $dompdf->render();
/* Uncomment to save to pc */
//$dompdf->stream();



/* Uncomment to open in browser*/

// $dompdf->stream("invoice.pdf", array("Attachment" => false));

/* Uncommnet for debug*/
// error_reporting( E_ALL );
// exit;


?>