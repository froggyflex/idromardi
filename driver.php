<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
require "connect.php";


$mysql_qry = "select Indirizzo, id_condo from Condominio order by id_condo+0";

$result = mysqli_query($connection, $mysql_qry );


$path  = getcwd();
$main  = "";
$main .=  $path."/Storico_Bollette/";
$pdffiles  = glob($main . "*.pdf");


$data = array();
while($row = mysqli_fetch_assoc($result))
{
   
    $data[] = $row;
}


foreach($data as $elem)
{
    
                $path1 = getcwd(). "/Storico_Bollette/".$elem['id_condo']."_".$elem['Indirizzo'];
                //echo $path;
                if (!file_exists($path1)) {
                    mkdir($path1,0755,true);
                }
                
                echo "ONOMA: ".$elem['id_condo'] ." <br>";
        	    foreach($pdffiles as $pdffile)
                {
                    //BOLLETTA__ FUMO_25_4^19_67.pdf
                    //BOLLETTA__MARCO FUMO_25_1^20_67.pdf
                    //Bolletta__ FONTANINA VIALE_4^18_24.pdf
                    
                    $temp = explode("__", $pdffile)[1];
                    $details = explode("_", $temp);
                                 
                    $onoma   = $details[0];
                    $interno = $details[1];
                    $periodo = $details[2];
                    $code_t  = explode(".", $details[count($details)-1])[0];
                    
                    //$full_name == $onoma and $code == $code_t or $elem['Cognome'] == $onoma and $code == $code_t
                    
                    echo "INSIDE: ".$interno ." ".$code_t."<br>";
                    
                    if((int)$elem['id_condo'] == (int)$code_t  )
            	    {
            	        
            	        rename( getcwd()."/Storico_Bollette/Bolletta__".$onoma."_".$interno."_".$periodo."_".$code_t.".pdf", $path1."/Bolletta__".$onoma."_".$interno."_".$periodo."_".$code_t.".pdf");
                        
            	       
                                       
            	    }
            	   
                }

}



// $dirs = array();

// // directory handle
// $dir = dir($main);

// while (false !== ($entry = $dir->read())) {
//     if ($entry != '.' && $entry != '..') {
//       if (is_dir($main . '/' .$entry)) {
//             $dirs[] = $entry; 
//       }
//     }
// }

// foreach($dirs as $key=>$folder)
// {
    
// }





function isContained($main,$string)
{
    if (strpos($main, $string) !== false) {
        return 1;
    }
    else
    {
        return 0;
    }
     
    
}



?>