<?php
	include "connect.php";
	
	
    	
function stringifyYear($num)
{
    if($num==1)
    {
        return "Primo";
    }
    else if($num==2)
    {
        return "Secondo";
    }
    else if($num==3)
    {
        return "Terzo";
    }
    else if($num==4)
    {
        return "Quarto";
    }
    else if($num==5)
    {
        return "Quinto";
    }
    else if($num==6)
    {
        return "Sesto";
    }
    else if($num==7)
    {
        return "Settimo";
    }
    else if($num==8)
    {
        return "Ottavo";
    }
    else if($num==9)
    {
        return "Nono";
    }
    else if($num==10)
    {
        return "Decimo";
    }
    else if($num==11)
    {
        return "Undicesimo";
    }
    else if($num==12)
    {
        return "Dodicesimo";
    }
}
            $idScelto  =   $_POST['t_oken'];//id
            $queryidScelto = "";
if( $idScelto == 1)
            {
	    
	       $queryidScelto   = "Select * from  miteamx1_players.Condominio  order BY id_condo+0 ASC";
	       $resultidScelto   = mysqli_query($connection, $queryidScelto);
	    
	    
	    	
			while($row_users = mysqli_fetch_assoc($resultidScelto))
			{
			    $users[] = $row_users;
			}
			
			echo json_encode(array('condo' =>$users));
			
		
	  		
	
	         	
}
else if( $idScelto == 2)
{
            $filter =  $_POST['isFilter'];
            
            if($filter == "" || $filter == null)
            {
                
                 $queryidScelto   = "select Id, id_condo, Amministratore, Indirizzo, count(*) as num, Fatturazione from miteamx1_players.Condominio, miteamx1_players.Utenze where Id = ID_Condominio and Status = 'ACTIVE' group by Indirizzo ORDER by id_condo+0 desc";
                 $resultidScelto  = mysqli_query($connection, $queryidScelto);
	      
        		if (mysqli_num_rows($resultidScelto) <= 0  )
        	  	{
        	  		echo "Nessun Condominio Trovato";
        	  
        	 	} else 
        	 	{
        	 		
        			while($row_users = mysqli_fetch_assoc($resultidScelto))
        			{
        			    $users[] = $row_users;
        			}
        			
        			
        			
        			echo json_encode(array('condo' =>$users));
	  		
	
	         }
                
            }
            else
            {
                
                    $what = explode(':', $filter)[0];
                    $actual = explode(':', $filter)[1];
                    if($what == 'amminis')
                    {
                        
                        $queryidScelto   = "select Id, id_condo, Amministratore, Indirizzo, count(*) as num from miteamx1_players.Condominio, miteamx1_players.Utenze
                        where Id = ID_Condominio and Status = 'ACTIVE' and Amministratore = '$actual'  group by Indirizzo ORDER by id_condo+0 desc";
                        $resultidScelto  = mysqli_query($connection, $queryidScelto);
        	      
                        	if (mysqli_num_rows($resultidScelto) <= 0  )
                    	  	{
                    	  		echo "Nessun Condominio Trovato";
                    	  
                    	 	} 
                    	 	else 
                    	 	{
                    	 		
                    			while($row_users = mysqli_fetch_assoc($resultidScelto))
                    			{
                    			    $users[] = $row_users;
                    			}
                    			
                    			
                    			
                    			echo json_encode(array('condo' =>$users));
                    	  		
                    	
                    	    }
                    }
                    else if ($what == 'sezione')
                    {
                        $queryidScelto   = "select Id, id_condo, Amministratore, Indirizzo, count(*) as num from miteamx1_players.Condominio, miteamx1_players.Utenze
                        where Id = ID_Condominio and Status = 'ACTIVE' and Sezione = '$actual'  group by Indirizzo ORDER by sezione+0 desc";
                        $resultidScelto  = mysqli_query($connection, $queryidScelto);
        	      
                        	if (mysqli_num_rows($resultidScelto) <= 0  )
                    	  	{
                    	  		echo "Nessun Condominio Trovato";
                    	  
                    	 	} 
                    	 	else 
                    	 	{
                    	 		
                    			while($row_users = mysqli_fetch_assoc($resultidScelto))
                    			{
                    			    $users[] = $row_users;
                    			}
                    			
                    			
                    			
                    			echo json_encode(array('condo' =>$users));
                    	  		
                    	
                    	    }
                    }
                    else if ($what == 'citta')
                    {
                        $queryidScelto   = "select Id, id_condo, Amministratore, Indirizzo, count(*) as num from miteamx1_players.Condominio, miteamx1_players.Utenze
                        where Id = ID_Condominio and Status = 'ACTIVE' and Citta = '$actual'  group by Indirizzo ORDER by sezione+0 desc";
                        $resultidScelto  = mysqli_query($connection, $queryidScelto);
        	      
                        	if (mysqli_num_rows($resultidScelto) <= 0  )
                    	  	{
                    	  		echo "Nessun Condominio Trovato";
                    	  
                    	 	} 
                    	 	else 
                    	 	{
                    	 		
                    			while($row_users = mysqli_fetch_assoc($resultidScelto))
                    			{
                    			    $users[] = $row_users;
                    			}
                    			
                    			
                    			
                    			echo json_encode(array('condo' =>$users));
                    	  		
                    	
                    	    }
                    }
                    
                    
        	
            }
          
            
}
else if( $idScelto == 3)
{
            
               $idCondominio  =   $_POST['iden'];
               
               $queryidScelto   = "Select Nome, Cognome, Interno, id_user, Scala, Isolato, Matricola_Contatore from  miteamx1_players.Utenze where ID_Condominio = '$idCondominio' and Status = 'ACTIVE' group by Nome, Cognome, Interno order by id_user+0; ";
               $resultidScelto  = mysqli_query($connection, $queryidScelto);
	           
	           $setInvoiceType = "select Fatturazione from Condominio where Id = $idCondominio;";
               $sendIt         = mysqli_query($connection, $setInvoiceType);
               
               $resultS         = mysqli_fetch_object($sendIt);
               $invoiceType    = $resultS->Fatturazione;
	          
	    
	    
		if (mysqli_num_rows($resultidScelto) <= 0  )
	  	{
	  		echo "Nessun Utente Trovato Ancora";
	  
	 	} else 
	 	{
	 		
			while($row_users = mysqli_fetch_assoc($resultidScelto))
			{
			    $users[] = $row_users;
			}
			
			
			 //echo var_dump($users);
	   //        exit;
			echo json_encode(array('condo' =>$users, 'fatturazione' =>$invoiceType));
	  		
	
	 	}
            
}
else if( $idScelto == 10)
{
            
               $idCondominio  =   $_POST['iden'];
               
               $queryidScelto   = "Select Nome, Cognome, Interno, id_user, Scala, Isolato from  miteamx1_players.Utenze where ID_Condominio = '$idCondominio' and Status = 'ACTIVE' group by Nome, Cognome, Interno order by id_user+0; ";
               
               
	           $resultidScelto  = mysqli_query($connection, $queryidScelto);
	       
	          
	    
	    
		if (mysqli_num_rows($resultidScelto) <= 0  )
	  	{
	  		echo "Nessun Utente Trovato Ancora";
	  
	 	} else 
	 	{
	 		
			while($row_users = mysqli_fetch_assoc($resultidScelto))
			{
			    $users[] = $row_users;
			}
			
			
			 //echo var_dump($users);
	   //        exit;
			echo json_encode(array('condo' =>$users));
	  		
	
	 	}
            
            }
else if( $idScelto == 4)
{
               $valQ = "";
               $Condominio  =   $_POST['building'];
               $Quarter     =   $_POST['quart'];
               $Year     =   $_POST['y'];
               $Strings = explode("-", $Condominio);
               
               $idCondominio = $Strings[0];
               
               $prevQ  = $Quarter - 1;
               
                if($prevQ == 2)
                {
                    $valQ = "Val_Secondo";
                
                    $queryidScelto   = "Select sum(Val_Secondo) as totale from Letture_Acqua where ID = '$idCondominio' and anno = '$Year'; ";
                    $resultidScelto  = mysqli_query($connection, $queryidScelto);
                    
                    $queryidScelto2   = "Select NUAE as n, T_F as tf, Ruolo as ru, Sezione as sez  from Condominio where ID = '$idCondominio'; ";
                    $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                    if (mysqli_num_rows($resultidScelto) <= 0  )
            	  	{            
            	  		echo "Nessuna Lettura Trovata";
            	  
            	 	} else 
            	 	{
            	 	 	   $row = mysqli_fetch_object($resultidScelto);
            	 	 	   $val = $row->totale;
            			   
            			   $row1 = mysqli_fetch_object($resultidScelto2);
            			   
            	 	 	   $val1 = $row1->n;
            	 	 	   $val2 = $row1->tf;
            	 	 	   $val3 = $row1->ru;
            	 	 	   $val4 = $row1->sez;
            			echo $val."-".$val1."-".$val2."-".$val3."-".$val4;
            	  		
            	
            	 	}       
                }
                
               
            
        }
else if($idScelto == 51)
{
               $idCondominio  =   $_POST['iden'];
            
               $setInvoiceType = "select Fatturazione from Condominio where Id = $idCondominio;";
               $sendIt         = mysqli_query($connection, $setInvoiceType);
               $resultS         = mysqli_fetch_object($sendIt);
               $invoiceType    = $resultS->Fatturazione;
               
               $getLastPeriod  = "SELECT max(a.Anno) as anno, max(a.Trimestre) as periodo
            	                        FROM(SELECT Anno, Trimestre, ID_Condominio, Tipo_fatturazione from Contabilita_Chiuse group by Anno, ID_Condominio, Tipo_fatturazione, Trimestre order by Anno desc)as a
                                  where a.ID_Condominio = $idCondominio and a.Tipo_fatturazione = '$invoiceType' and a.Anno = (select max(Anno) from Contabilita_Chiuse
                                                                                                                               where ID_Condominio = $idCondominio)
                                ";
               $execP          = mysqli_query($connection, $getLastPeriod);
               $resultP        = mysqli_fetch_object($execP);
               
               $yearL          = $resultP->anno;
               $lasti          = $resultP->periodo;
               
               if($resultP)
               {
                   $nextP = -1;
                   $nextY = $yearL;
                   if($invoiceType == "TRIM")
                   {
                       if($lasti == 4)
                       {
                           $nextP = 1;
                           $nextY = $yearL+1;
                       }
                       else
                       {
                           $nextP = $lasti + 1;
                       }
                   }
                   else if($invoiceType == "BIM")
                   {
                       if($lasti == 6)
                       {
                           $nextP = 1;
                           $nextY = $yearL+1;
                       }
                       else
                       {
                           $nextP = $lasti + 1;
                       }
                   }
                   else if($invoiceType == "MEN")
                   {
                       if($lasti == 12)
                       {
                           $nextP = 1;
                           $nextY = $yearL+1;
                       }
                       else
                       {
                           $nextP = $lasti + 1;
                       }
                   }
                   else if($invoiceType == "SEM")
                   {
                       if($lasti == 2)
                       {
                           $nextP = 1;
                           $nextY = $yearL+1;
                       }
                       else
                       {
                           $nextP = $lasti + 1;
                       }
                   }
                   
                   $getVarie       = "select Varie from Lista_Varie where Condominio = $idCondominio and Periodo = '$lasti' and Tipo_Fattura = '$invoiceType' and Anno = $nextY;";
                   
                   $execVarie      = mysqli_query($connection, $getVarie);
                   $varie = 0;
                   if($execVarie)
                   {
                       $risVarie       = mysqli_fetch_object($execVarie);
                       if(isset( $risVarie->Varie))
                       {
                           $varie = $risVarie->Varie;
                       }
                       else
                       {
                           $varie = 0;
                       }
                       
                   }
                   $ini_data = array();
                   $ini_data[] =
                   [
        			  "fatturazione" => $invoiceType,
        			  "lastY"        => $yearL,
        			  "lastI"        => $lasti,
        			  "nextI"        => $nextP,
        			  "nextY"        => $nextY,
        			  "varie"        => $varie
        			  
                   ];
               }
               else
               {
                   $ini_data = array();
                   $ini_data[] =
                   [
        			  "fatturazione" => $invoiceType,
        			  "lastY"        => "NA",
        			  "lastI"        => "NA",
        			  "nextI"        => "NA",
        			  "nextY"        => "NA",
        			  "varie"        => "NA"
        			  
                   ];
               }
               
             $data = array();
             $data['data'] = $ini_data;
             echo json_encode($data, JSON_PRETTY_PRINT);
               
}
else if( $idScelto == 5)
{
            
               $idCondominio  =   $_POST['iden'];
               
               
               //get the last invoiced period
            
               $setInvoiceType = "select Fatturazione from Condominio where Id = $idCondominio;";
               $sendIt         = mysqli_query($connection, $setInvoiceType);
               
               $resultS         = mysqli_fetch_object($sendIt);
               $invoiceType    = $resultS->Fatturazione;
               
               
               $getLastPeriod  = "SELECT max(a.Anno) as anno, max(a.Trimestre) as periodo
            	                        FROM(SELECT Anno, Trimestre, ID_Condominio, Tipo_fatturazione from Contabilita_Chiuse group by Anno, ID_Condominio, Tipo_fatturazione, Trimestre order by Anno desc)as a
                                  where a.ID_Condominio = $idCondominio and a.Tipo_fatturazione = '$invoiceType' and a.Anno = (select max(Anno) from Contabilita_Chiuse
                                                                                                                               where ID_Condominio = $idCondominio)
                                ";
                                  
               $execP          = mysqli_query($connection, $getLastPeriod);
               $resultP        = mysqli_fetch_object($execP);
               
               $yearL          = $resultP->anno;
               $lasti          = $resultP->periodo;
               
             
               $anno_da_fatturare   =   $_POST['anno_per_fatt'];
               $anno_fat_pre  =  $_POST['ly'];
               $stazione      =   $_POST['station'];
               $trimestreC    =   $_POST['cur_trim'];
               $ls            =   $_POST['ls'];
               $lp            =   $_POST['lp'];
               $fa = "";
               $fp = "";
               
               if($lasti == null)
               {
                   $lasti = $lp;
               }
               if($yearL == null)
               {
                   $yearL = $anno_fat_pre;
               }
              
            //   echo $yearL. " ".$lasti;
            //   exit;
               
               $nextP = -1;
               $nextY = $yearL;
               if($invoiceType == "TRIM")
               {
                   if($lasti == 4)
                   {
                       $nextP = 1;
                       $nextY = $yearL+1;
                   }
                   else
                   {
                       $nextP = $lasti + 1;
                   }
               }
               else if($invoiceType == "BIM")
               {
                   if($lasti == 6)
                   {
                       $nextP = 1;
                       $nextY = $yearL+1;
                   }
                   else
                   {
                       $nextP = $lasti + 1;
                   }
               }
               else if($invoiceType == "MEN")
               {
                   if($lasti == 12)
                   {
                       $nextP = 1;
                       $nextY = $yearL+1;
                   }
                   else
                   {
                       $nextP = $lasti + 1;
                   }
               }
               else if($invoiceType == "SEM")
               {
                   if($lasti == 2)
                   {
                       $nextP = 1;
                       $nextY = $yearL+1;
                   }
                   else
                   {
                       $nextP = $lasti + 1;
                   }
               }
               
               $getVarie       = "select Varie from Lista_Varie where Condominio = $idCondominio and Periodo = '$trimestreC' and Tipo_Fattura = '$invoiceType' and Anno = $nextY;";
               
               $execVarie      = mysqli_query($connection, $getVarie);
               $varie = 0;
               if($execVarie)
               {
                   $risVarie       = mysqli_fetch_object($execVarie);
                   if(isset( $risVarie->Varie))
                   {
                       $varie = $risVarie->Varie;
                   }
                   else
                   {
                       $varie = 0;
                   }
                   
               }
               
               $ini_data = array();
               $ini_data[] =
               [
    			  "fatturazione" => $invoiceType,
    			  "lastY"        => $yearL,
    			  "lastI"        => $lasti,
    			  "nextI"        => $nextP,
    			  "nextY"        => $nextY,
    			  "varie"        => $varie
    			  
               ];
               //end of get the last invoiced period
               
            //     print_r($ini_data);
            //   exit;
               //print_r($ini_data); ;exit;
               
            
               if($_POST['fa'] == null || $_POST['fp'] == null )
               {
                 
                  $fa            =  $invoiceType;
                  $fp            =  $invoiceType;
               }
               else
               {
                   
                  
                  $fa            =   $_POST['fa'];
                  $fp            =   $_POST['fp'];                   
               }

                   
               
             
                   if($anno_da_fatturare == null)
                   {
                       $anno_da_fatturare = 2019;
                   }
                   
                   $scorso_da_fatturare   =   $anno_da_fatturare - 1;
                   $data = array();
                   $nu   = array();
                   $putenza = array();
                   $anotation_array = array();
                   $second_max      = array();
                   
                   
                   $nuae = "select NUAE from Condominio where Id = '$idCondominio';";
                   $result_nuae = mysqli_query($connection, $nuae);
                   $n = $result_nuae->fetch_object();
                   
                   $anot = "select Anotazione from Condominio where Id = '$idCondominio';";
                   $result_anot = mysqli_query($connection, $anot);
                   $an = $result_anot->fetch_object();
                   
                   $pt = "select Potenza from Condominio where Id = '$idCondominio';";   
                   $result_pt = mysqli_query($connection, $pt);
                   $pot = $result_pt->fetch_object();
                   
                //   $second_max_q = "select * from Massimi where Condominio = '$idCondominio';";   
                //   $result_second_max_q = mysqli_query($connection, $second_max_q);
                //   $second_max_o = $result_second_max_q->fetch_object();
                   
                   $potenza_C[] =
                   [
    			           "water_consumption" =>  $pot->Potenza
                   ];
                    
                   $anotation_array[] = [
                            "an"   =>  $an->Anotazione
                    ];
                   $nu[] =
                   [
    			           "the_n" =>  $n->NUAE
                   ];
                   
                //   while($sndmax = $result_second_max_q->fetch_object())
                //   {
                // 		$second_max[] = [
                			                         
                //             	"utente"          => $sndmax->Utente,
                //             	"interno"         => $sndmax->Interno,
                //             	"smaller_max"     => $sndmax->Valore_Secondo_Massimo,
                //             	"data_small_max"  => $sndmax->Data_Secondo_Massimo
                //         ];
                // 	} 
                   
                   $data['nuae']      = $nu;
                   $data['putenza']   = $potenza_C;
                   $data['anotation'] = $anotation_array;
                   $data['smallMax']  = $second_max;
                   
                   
                 //  echo $fa.$fp;
                     if($stazione === null || $stazione != "GAS")
                     {
                        
                        if($fa == "TRIM" && $fp == "TRIM")
                        {
                            if($trimestreC == 1)
                            {   
                                
                                
                                $check_prev_closed = "select Creazione from Check_List where Trimestre = 4 and Anno = '$scorso_da_fatturare' and Condominio = $idCondominio ";
                                $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                
                                $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                $isCreated         = $get_Creazione->Creazione;
                                
                                if($isCreated == 'Attivo')
                                {   
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 4 and Anno = '$scorso_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                            $queryidScelto1   = "Select Attuale as Val_Quarto,
                                                            Utenze.Interno, 
                                                            Scala, 
                                                            Isolato, 
                                                            Contabilita_Chiuse.Utente, 
                                                            Sit_Conta_Gene4, 
                                                            Stato4   
                                                     from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                     where Letture_Acqua.ID = '$idCondominio'
                                                     and Contabilita_Chiuse.Trimestre = 4
                                                     and Contabilita_Chiuse.Anno = '$scorso_da_fatturare' 
                                                     and Letture_Acqua.Anno      = '$scorso_da_fatturare'
                                                     and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                     and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                     and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                     and Utenze.Status = 'ACTIVE'
                                                     and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus and Tipo_fatturazione = '$fp'
                                                     group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                            }
                                            else
                                            {
                                                $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio' 
                                                        and Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and R4 = 'NA'  and Val_Quarto != 'NA' and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                            }
                      
                                                        
                               
                                }
                                else
                                {
                                      $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio' 
                                                        and Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and R4 = 'NA'  and Val_Quarto != 'NA' and Utenze.Status = 'ACTIVE' 
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                }
                                
                               
                                                        
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio  and Val_Primo != 'NA' and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$scorso_da_fatturare'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = 4
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and Utenze.Status = 'ACTIVE' and Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                 if($resultidScelto1)
                                 {
                                      
                    		                   
                                    	while($d = $resultidScelto1->fetch_object())
                            			{
            			                     $letturaPrec[] = [
            			                         
                        		                "nome"       => $d->Utente,
                        		                "val4"       => $d->Val_Quarto,
                        		                "contaG"     => $d->Sit_Conta_Gene4,
                        		                "statuspre"  => $d->Stato4,
                        		                "scala"      => $d->Scala,
                                		        "interno"    => $d->Interno,
                                		        "isolato"    => $d->Isolato
                        		                
                        		              ];
            		                   }
            		                   
            		                   	while($d1 = $resultidScelto2->fetch_object())
                            			{
            			                     $letturaAtt[] = [
            			                         
                        		                "nome"       => $d1->Utente,
                        		                "val1"       => $d1->Val_Primo,
                        		                "contaG1"    => $d1->Sit_Conta_Gene,
                        		                "interno"    => $d1->Interno,
                        		                "status"     => $d1->Stato,
                        		                "data"       => $d1->Data_Inserimento,
                        		                "doppio"     => $d1->Doppio_Contatore,
                        		                "inverso"    => $d1->Contatore_Inverso,
                        		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                        		                "tipo_contatore" => $d1->Tipo,
                        		                "palazzina" => $d1->Palazzina,
                        		                "domestico" => $d1->Domestico,
                        		                "dent"       => $d1->id_user
                        		  
                    		               
            		                        ];
            		                   }
            		                   
            		                   	while($d2 = $resultidScelto3->fetch_object())
                            			{
            			                     $roundings[] = [
            			                         
                        		                "nome"       => $d2->Utente,
                        		                "interno"    => $d2->Interno,
                        		                "prev"       => $d2->Arrotondamento
                        		              
            		                        ];
            		                   }
            		                   
            		                   	while($d3 = $result_Y->fetch_object())
                            			{
            			                     $y_status[] = [
            			                         
                        		                "nome"       =>  $d3->Utente,
                        		                "valme"       => $d3->Valore_Medio,
                        		                "interno"       => $d3->Interno
                        		                
                        		              
            		                        ];
            		                   }
            		                   
            		                   
            		            $data['valPrec'] = $letturaPrec; $data['data'] = $ini_data;
            		            $data['round']   = $roundings;
            		            $data['valAtt']  = $letturaAtt;
            		            $data['statoy']  = $y_status;
                            	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                 else
                                 {
                                    echo "Errore: Non esistono Valori Per Il 4o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                                
                            }
                            else if($trimestreC == 2)
                            {
                                
                                        $check_prev_closed = "select Creazione from Check_List where Trimestre = 1 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio";
                                        $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                        
                                        $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                        $isCreated         = $get_Creazione->Creazione;
                                
                                        if($isCreated == 'Attivo')
                                        {   
                                            
                                               $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 1 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                $queryidScelto1   = "Select Attuale,
                                                                    Val_Secondo as trim3,
                                                                    Utenze.Interno, 
                                                                    Scala, 
                                                                    Isolato, 
                                                                    Contabilita_Chiuse.Utente, 
                                                                    Sit_Conta_Gene,
                                                                    Sit_Conta_Gene2,
                                                                    Stato,
                                                                    Stato2,
                                                                    Doppio_Contatore,
                                                                    Tipo,
                                                                    Palazzina,
                                                                    Domestico,
                                                                    Contatore_Inverso,
                                                                    Bonus_Idrico,
                                                                    Data_Inserimento2,
                                                                    id_user
                                                             from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                             where Letture_Acqua.ID = '$idCondominio' 
                                                             and Contabilita_Chiuse.Trimestre = 1
                                                             and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                             and Letture_Acqua.Anno      = '$anno_da_fatturare'
                                                             and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                             and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                             and Utenze.Status = 'ACTIVE'
                                                             and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                             and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus and Tipo_fatturazione = '$fp'
                                                             group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                                                
                                            }
                                            else
                                            {
                                                  $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico, id_user 
                                                                from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and ID = ID_Condominio  and Val_Secondo != 'NA'  and R1 = 'NA'  and Interno = Internus  group by Utente, Internus order by id_user+0 ;";
                                            }
                                             
                                       
                                        }
                                        else
                                        {
                                            $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore,Bonus_Idrico, Tipo, Palazzina, Domestico, id_user 
                                                                from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and ID = ID_Condominio  and Val_Secondo != 'NA'  and R1 = 'NA'  and Interno = Internus  group by Utente, Internus order by id_user+0 ;";
                                        }
                                        
                                        
                                        $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                        
                                        
                                        
                                        $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze  where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = 1
                                                                and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and Arrotondamenti.Internio = Utenze.Interno  and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                        $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                        
                                        $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                        $result_Y        = mysqli_query($connection, $query_for_Y);
                                        
                                        
                                        if($resultidScelto1)
                                        {
                                                while($d = $resultidScelto1->fetch_object())
                                    			{
                                    			    
                    			                     $letturaPrec[] = [
                    			                         
                                		                "nome"       => $d->Utente,
                                		                "val2"       => $d->Attuale,
                                		                "val3"       => $d->trim3,
                                		                "contaG"     => $d->Sit_Conta_Gene,
                                		                "contaG1"    => $d->Sit_Conta_Gene2,
                                		                "status"     => $d->Stato2,
                                		                "statuspre"  => $d->Stato,
                                		                "doppio"     => $d->Doppio_Contatore,
                                		                "inverso"    => $d->Contatore_Inverso,
                                		                "Bonus_Idrico"   => $d->Bonus_Idrico,
                                		                "tipo_contatore" => $d->Tipo,
                                		                "palazzina"      => $d->Palazzina,
                                		                "domestico"      => $d->Domestico,
                                		                "scala"      => $d->Scala,
                                		                "interno"    => $d->Interno,
                                		                "isolato"    => $d->Isolato,
                                		                "data"       => $d->Data_Inserimento2,
                                		                "dent"       => $d->id_user
                            		               
                    		                        ];
                    		                   }
                    		                   
                            		            while($d2 = $resultidScelto3->fetch_object())
                                    			{
                    			                     $roundings[] = [
                    			                         
                                		                "nome"       => $d2->Utente,
                                		                "prev"       => $d2->Arrotondamento
                                		              
                    		                        ];
                    		                   }
                    		                   
                    		                   	while($d3 = $result_Y->fetch_object())
                                    			{
                    			                     $y_status[] = [
                    			                         
                                		                "nome"       =>  $d3->Utente,
                                		                "valme"       => $d3->Valore_Medio,
                                		                "interno"       => $d3->Interno
                                		              
                    		                        ];
                    		                   } 
                                        	$data['valPrec'] = $letturaPrec; 
                                        	$data['data'] = $ini_data;
                                            $data['round']   = $roundings;
                                        	$data['statoy']  = $y_status;
                                        	
                                    	echo json_encode($data, JSON_PRETTY_PRINT);
                                    	  		
                                        }
                                        else
                                        {
                                            echo "Errore: ". mysqli_error($connection);
                                        }
                                        
                                        
                            }
                            else if($trimestreC == 3)
                            {   
                                
                                        $check_prev_closed = "select Creazione from Check_List where Trimestre = 2 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio";
                                    
                                        $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                        
                                        $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                        $isCreated         = $get_Creazione->Creazione;
                                                  
                             
                                        if($isCreated == 'Attivo')
                                        {
                                            
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 2 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                 $queryidScelto1   = "Select Attuale,
                                                                    Val_Terzo as trim3,
                                                                    Utenze.Interno, 
                                                                    Scala, 
                                                                    Isolato, 
                                                                    Contabilita_Chiuse.Utente, 
                                                                    Sit_Conta_Gene2,
                                                                    Sit_Conta_Gene3,
                                                                    Stato2,
                                                                    Stato3,
                                                                    Doppio_Contatore,
                                                                    Contatore_Inverso,
                                                                    Bonus_Idrico,
                                                                    Tipo,
                                                                    Palazzina,
                                                                    Domestico,
                                                                    Data_Inserimento3,
                                                                    id_user
                                                             from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                             where Letture_Acqua.ID = '$idCondominio' 
                                                             and Contabilita_Chiuse.Trimestre = 2
                                                             and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                             and Letture_Acqua.Anno      = '$anno_da_fatturare'
                                                             and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                             and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                             and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                             and Utenze.Status = 'ACTIVE'
                                                             and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus and Tipo_fatturazione = '$fp'
                                                             group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                            }
                                            else
                                            {
                                                         $queryidScelto1   = "Select Val_Secondo as Attuale, Val_Terzo as trim3, Val_Primo as prece, Utente, Sit_Conta_Gene2, Sit_Conta_Gene3, Stato3, Stato2, Scala,Interno,Isolato,Data_Inserimento3, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico,  id_user 
                                                        from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                        and Val_Terzo != 'NA' and   R2 = 'NA'  and Interno = Internus  group by Utente, Internus order by id_user+0;";
                                            }
                                            
                                                
                                        }
                                        else
                                        {
                                                     
                                                        $queryidScelto1   = "Select Val_Secondo as Attuale, Val_Terzo as trim3, Val_Primo as prece, Utente, Sit_Conta_Gene2, Sit_Conta_Gene3, Stato3, Stato2, Scala,Interno,Isolato,Data_Inserimento3, Doppio_Contatore, Bonus_Idrico, Tipo,  Palazzina, Domestico, id_user 
                                                        from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                        and Val_Terzo != 'NA' and   R2 = 'NA'  and Interno = Internus  group by Utente, Internus order by id_user+0;";
                                        }
                              
                                                        
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                
                                $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                $result_Y        = mysqli_query($connection, $query_for_Y);
                              
                                           
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' and Trimestre = 2  
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                               
                                if($resultidScelto1)
                                {
                                    
                    		        while($d = $resultidScelto1->fetch_object())
                                    {
                                        
                                        
                    			        $letturaPrec[] = [
                    			                         
                                		     "nome"       => $d->Utente,
                                		     "val2"       => $d->Attuale,
                                		     "val3"       => $d->trim3,
                                		     "prec"       => $d->prece,
                                		     "contaG"     => $d->Sit_Conta_Gene2,
                                		     "contaG1"    => $d->Sit_Conta_Gene3,
                                		     "status"     => $d->Stato3,
                                		     "statuspre"  => $d->Stato2,
                                		     "doppio"     => $d->Doppio_Contatore,
                                		     "inverso"    => $d->Contatore_Inverso,
                                		     "Bonus_Idrico" => $d->Bonus_Idrico,
                                		     "tipo_contatore" => $d->Tipo,
                                		     "palazzina"      => $d->Palazzina,
                                		     "domestico"        => $d->Domestico,
                                		     "scala"      => $d->Scala,
                                             "interno"    => $d->Interno,
                                		     "isolato"    => $d->Isolato,
                                		     "data"       => $d->Data_Inserimento3,
                                		     "dent"       => $d->id_user
                            		               
                    		                        ];
                    		          }
                    		                   
                    		         
                    		          while($d3 = $result_Y->fetch_object())
                                      {
                    			                     $y_status[] = [
                    			                         
                                		                "nome"       =>  $d3->Utente,
                                		                "valme"       => $d3->Valore_Medio,
                                		                "interno"       => $d3->Interno
                                		              
                    		                        ];
                    		                        
                    		          } 
                    		          while($d2 = $resultidScelto3->fetch_object())
                            		  {
            			                     $roundings[] = [
            			                         
                        		                "nome"       => $d2->Utente,
                        		                "prev"       => $d2->Arrotondamento
                        		              
            		                        ];
            		                   }
            		                  $data['valPrec'] = $letturaPrec;
            		                  $data['data'] = $ini_data;
                                      $data['round']   = $roundings;
                                      $data['statoy']  = $y_status;
                                    	
                                    	
                                    	
                                    	echo json_encode($data, JSON_PRETTY_PRINT);
                                    	  		
                                }
                                else
                                {
                                        echo "Errore: ". mysqli_error($connection);
                                }
                                        
                            }
                            else if ($trimestreC == 4)
                            {
                                       
                                        
                                        $check_prev_closed = "select Creazione from Check_List where Trimestre = 3 and Anno = '$anno_da_fatturare'  and Condominio = $idCondominio ";
                                        $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                        
                                        $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                        $isCreated         = $get_Creazione->Creazione;
                                
                                        if($isCreated == 'Attivo')
                                        {
                                            
                                               $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 3 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                                    $queryidScelto1   = "Select Attuale,
                                                                    Val_Quarto as trim3,
                                                                    Utenze.Interno, 
                                                                    Scala, 
                                                                    Isolato, 
                                                                    Contabilita_Chiuse.Utente, 
                                                                    Sit_Conta_Gene3,
                                                                    Sit_Conta_Gene4,
                                                                    Stato3,
                                                                    Stato4,
                                                                    Doppio_Contatore,
                                                                    Bonus_Idrico,
                                                                    Tipo,
                                                                    Palazzina,
                                                                    Domestico,
                                                                    Contatore_Inverso,
                                                                    Data_Inserimento4,
                                                                    id_user
                                                             from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                             where Letture_Acqua.ID = '$idCondominio' 
                                                             and Contabilita_Chiuse.Trimestre = 3
                                                             and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                             and Letture_Acqua.Anno      = '$anno_da_fatturare'
                                                             and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                             and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                             and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio  and Tipo_fatturazione = '$fp'
                                                             and Utenze.Status = 'ACTIVE'
                                                             and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus 
                                                             group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                            }
                                            else
                                            {
                                                $queryidScelto1   = "Select Val_Terzo as Attuale, Val_Quarto as trim3, Val_Secondo as prece, Utente, Sit_Conta_Gene3, Sit_Conta_Gene4, Stato4, Stato3, Scala,Interno,Isolato,Data_Inserimento4, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico,
                                                                id_user from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and Interno = Internus and Val_Quarto != 'NA' and  R3 = 'NA'  group by Utente, Internus order by id_user+0;";
                                            }
    
                                                
                                        }
                                        else
                                        {
                                            $queryidScelto1   = "Select Val_Terzo as Attuale, Val_Quarto as trim3, Val_Secondo as prece, Utente, Sit_Conta_Gene3, Sit_Conta_Gene4, Stato4, Stato3, Scala,Interno,Isolato,Data_Inserimento4, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico,
                                                                id_user from  miteamx1_players.Letture_Acqua, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and Interno = Internus and Val_Quarto != 'NA' and  R3 = 'NA'  group by Utente, Internus order by id_user+0;";
                                        }
                                        
                                        $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                        
                                        $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' 
                                                                and Trimestre = 3  and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                        $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                        
                                        $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                        $result_Y        = mysqli_query($connection, $query_for_Y);
                       
                                                                 
                                        if($resultidScelto1)
                                        {
                                                
                                             
                                    		   while($d = $resultidScelto1->fetch_object())
                                    		   {
                    			                     $letturaPrec[] = [
                    			                         
                                		                 "nome"       => $d->Utente, 
                                            		     "val2"       => $d->Attuale,
                                            		     "val3"       => $d->trim3,
                                            		     "prec"       => $d->prece,
                                            		     "contaG"     => $d->Sit_Conta_Gene3,
                                            		     "contaG1"    => $d->Sit_Conta_Gene4,
                                            		     "status"     => $d->Stato4,
                                            		     "statuspre"  => $d->Stato3,
                                            		     "doppio"     => $d->Doppio_Contatore,
                                            		     "inverso"    => $d->Contatore_Inverso,
                                            		     "Bonus_Idrico" => $d->Bonus_Idrico,
                                            		     "tipo_contatore" => $d->Tipo,
                                            		     "palazzina"      => $d->Palazzina,
                                            		     "domestico"        => $d->Domestico,
                                            		     "scala"      => $d->Scala,
                                                         "interno"    => $d->Interno,
                                            		     "isolato"    => $d->Isolato,
                                            		     "data"       => $d->Data_Inserimento4,
                                            		     "dent"       => $d->id_user
                                		                
                            		               
                    		                        ];
                    		                   }
                    		                   
                    		                   
                    		                   while($d2 = $resultidScelto3->fetch_object())
                            			       {
            			                         $roundings[] = [
            			                         
                        		                 "nome"       => $d2->Utente,
                        		                 "prev"       => $d2->Arrotondamento
                        		              
            		                            ];
            		                           }
                            		           while($d3 = $result_Y->fetch_object())
                                               {
                            			                     $y_status[] = [
                            			                         
                                        		                "nome"       =>  $d3->Utente,
                                        		                "valme"       => $d3->Valore_Medio,
                                        		                "interno"       => $d3->Interno
                                        		              
                            		                        ];
                            		              }    
                                    		      
                    		                   	$data['round']     = $roundings;
                                            	$data['valPrec']   = $letturaPrec;
                                            	$data['data'] = $ini_data;
                                            	$data['statoy']    = $y_status;
                                            
                                            	
                                            	echo json_encode($data, JSON_PRETTY_PRINT);
                                    	  		
                                        }
                                        else
                                        {
                                            
                                            echo "Errore: ". mysqli_error($connection);
                                        }
                                        
                                    }
                        }
                        else if($fa == "TRIM" && $fp == "MEN")
                        {
                        
                            $resultidScelto1 = false;
                            $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = MEN
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente 
                                                         from  Letture_Acqua_Mensili, Utenze, Contabilita_Chiuse   
                                                         where Letture_Acqua_Mensili.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Acqua_Mensili.Anno      = '$anno_fat_pre'
                                                         and Letture_Acqua_Mensili.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua_Mensili.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Acqua_Mensili.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua_Mensili.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Acqua_Mensili.Utente, Letture_Acqua_Mensili.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                if($resultidScelto1)
                                {           
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"       => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->$value,
                            		                "contaG1"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else
                                {
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                            
                            
                            
                        }
                        else if($fa == "TRIM" && $fp == "BIM")
                        {
                            
                            $resultidScelto1 = false;
                            $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente  
                                                         from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                         where Letture_Gas.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Gas.Anno      = '$anno_fat_pre'
                                                         and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                 
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"       => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->$value,
                            		                "contaG1"    => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: ".$queryidScelto1." ". mysqli_error($connection);
                                 }
                        }
                        else if($fa == "TRIM" && $fp == "SEM")
                        {}
                        
                        
                        
                        else if($fa == "BIM" && $fp == "BIM")
                        {
                              $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                              
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente  
                                                         from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                         where Letture_Gas.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Gas.Anno      = '$anno_fat_pre'
                                                         and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Letture_Gas.Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                //  echo $queryidScelto1;
                                //  exit;
                                 
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }                                            
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"       => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->$value,
                            		                "contaG1"    => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if($fa == "BIM" && $fp == "TRIM")
                        {
                              $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente
                                                         from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                         where Letture_Acqua.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Acqua.Anno      = '$anno_fat_pre'
                                                         and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                            
                                 
                                if($resultidScelto1)
                                {
                                    
 
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }                                            
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"    => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"    => $d->$value,
                            		                "contaG1"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if($fa == "BIM" && $fp == "MEN")
                        {
                             $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente 
                                                         from  Letture_Acqua_Mensili, Utenze, Contabilita_Chiuse   
                                                         where Letture_Acqua_Mensili.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Acqua_Mensili.Anno      = '$anno_fat_pre'
                                                         and Letture_Acqua_Mensili.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua_Mensili.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Acqua_Mensili.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua_Mensili.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Acqua_Mensili.Utente, Letture_Acqua_Mensili.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                    $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }                                            
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"       => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->$value,
                            		                "contaG1"    => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec;
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if($fa  == "BIM" && $fp == "SEM")
                        {}
                        
                       
                        else if(($fa == "MEN" && $fp == "MEN"))
                        {
                              $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente  
                                                         from  Letture_Acqua_Mensili, Utenze, Contabilita_Chiuse   
                                                         where Letture_Acqua_Mensili.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Acqua_Mensili.Anno      = '$anno_fat_pre'
                                                         and Letture_Acqua_Mensili.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua_Mensili.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Acqua_Mensili.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua_Mensili.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Acqua_Mensili.Utente, Letture_Acqua_Mensili.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }                                            
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"       => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->$value,
                            		                "contaG1"    => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 7)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Settimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene7,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato7,
                                		                "data"       => $d1->Data_Inserimento7,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 8)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Ottavo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene8,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato8,
                                		                "data"       => $d1->Data_Inserimento8,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 9)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Nono,
                                		                "contaG1"    => $d1->Sit_Conta_Gene9,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato9,
                                		                "data"       => $d1->Data_Inserimento9,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 10)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Decimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene10,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato10,
                                		                "data"       => $d1->Data_Inserimento10,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 11)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Undicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene11,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato11,
                                		                "data"       => $d1->Data_Inserimento11,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 12)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Dodicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene12,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato12,
                                		                "data"       => $d1->Data_Inserimento12,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if(($fa == "MEN" && $fp == "BIM"))
                        {
                              $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente 
                                                         from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                         where Letture_Gas.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Gas.Anno      = '$anno_fat_pre'
                                                         and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }                                            
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"    => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"    => $d->$value,
                            		                "contaG1"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 7)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Settimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene7,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato7,
                                		                "data"       => $d1->Data_Inserimento7,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 8)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Ottavo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene8,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato8,
                                		                "data"       => $d1->Data_Inserimento8,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 9)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Nono,
                                		                "contaG1"    => $d1->Sit_Conta_Gene9,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato9,
                                		                "data"       => $d1->Data_Inserimento9,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 10)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Decimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene10,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato10,
                                		                "data"       => $d1->Data_Inserimento10,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 11)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Undicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene11,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato11,
                                		                "data"       => $d1->Data_Inserimento11,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 12)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Dodicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene12,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato12,
                                		                "data"       => $d1->Data_Inserimento12,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec; 
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if(($fa == "MEN" && $fp == "TRIM"))
                        {
                              $resultidScelto1 = false;
                              $queryidScelto1  = "";
                           
                                //passo 1, controllo presenza valori nella tabella contabilitá chiuse con tipo fatturazione = BIM
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = $ls and Anno = '$anno_fat_pre' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid     = $get_Tabu->Attuale;
                                                
                                                $value       = "Val_".stringifyYear($ls);
                                                
                                                if(isset($isValid))
                                                {
                                                                $queryidScelto1   = "Select *, Attuale as $value,
                                                                Utenze.Interno, 
                                                                Scala, 
                                                                Isolato, 
                                                                Contabilita_Chiuse.Utente   
                                                         from  Letture_Acqua, Utenze, Contabilita_Chiuse   
                                                         where Letture_Acqua.ID = '$idCondominio'
                                                         and Contabilita_Chiuse.Trimestre = $ls
                                                         and Contabilita_Chiuse.Anno = '$anno_fat_pre' 
                                                         and Letture_Acqua.Anno      = '$anno_fat_pre'
                                                         and Letture_Acqua.Anno      = Contabilita_Chiuse.Anno
                                                         and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua.Utente = Contabilita_Chiuse.Utente 
                                                         and Letture_Acqua.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                         and Utenze.Status = 'ACTIVE'
                                                         and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua.Internus and Tipo_fatturazione = '$fp'
                                                         group by Letture_Acqua.Utente, Letture_Acqua.Internus order by id_user+0;";
                                                }
                                                else
                                                {
                                                    $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua, Utenze   where ID = '$idCondominio' 
                                                            and Anno = '$anno_fat_pre' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                            and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                                }
                            
                                    
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            
                                //passo 2, selezionare il valore attuale che dipende dalla scelta di fatturazione attuale   
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua_Mensili, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_fat_pre'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = $ls
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Utenze.Status = 'ACTIVE' and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = $trimestreC and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                if($resultidScelto1)
                                {
                                            if($ls < 10)
                                            {
                                                $ls = sprintf("%01d", $ls);
                                            }
                                            if($ls == 1)
                                            {
                                               $ls = "";
                                            }
                                            $cg = "Sit_Conta_Gene".$ls;
                                            $sp = 'Stato'.$ls;
                                  
                                            while($d = $resultidScelto1->fetch_object())
                            		        {
                            		            if($trimestreC == 1)
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val4"    => $d->$value,
                            		                "contaG"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];
                                			    }
                                			    else
                                			    {
                                    			    $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"    => $d->$value,
                            		                "contaG1"     => $d->$cg,
                            		                "statuspre"  => $d->$sp,
                            		                "scala"      => $d->Scala,
                                    		        "interno"    => $d->Interno,
                                    		        "isolato"    => $d->Isolato
                            		                
                            		              ];                                			        
                                			    }

            		                        }
            		                    	while($d1 = $resultidScelto2->fetch_object())
                                			{
                                			  
                                			     
                                			      if($trimestreC == 1)
                                			      {
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val1"       => $d1->Val_Primo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato,
                                		                "data"       => $d1->Data_Inserimento,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];
                                			      }
                                			      else if($trimestreC == 2)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Secondo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene2,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato2,
                                		                "data"       => $d1->Data_Inserimento2,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 3)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Terzo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene3,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato3,
                                		                "data"       => $d1->Data_Inserimento3,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			      else if($trimestreC == 4)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quarto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene4,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato4,
                                		                "data"       => $d1->Data_Inserimento4,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 5)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Quinto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene5,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato5,
                                		                "data"       => $d1->Data_Inserimento5,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 6)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Sesto,
                                		                "contaG1"    => $d1->Sit_Conta_Gene6,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato6,
                                		                "data"       => $d1->Data_Inserimento6,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 7)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Settimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene7,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato7,
                                		                "data"       => $d1->Data_Inserimento7,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 8)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Ottavo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene8,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato8,
                                		                "data"       => $d1->Data_Inserimento8,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 9)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Nono,
                                		                "contaG1"    => $d1->Sit_Conta_Gene9,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato9,
                                		                "data"       => $d1->Data_Inserimento9,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 10)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Decimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene10,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato10,
                                		                "data"       => $d1->Data_Inserimento10,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 11)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Undicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene11,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato11,
                                		                "data"       => $d1->Data_Inserimento11,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                		          else if($trimestreC == 12)
                                			      {
                                			          
                                			           $letturaAtt[] = [
                			                         
                                		                "nome"       => $d1->Utente,
                                		                "val3"       => $d1->Val_Dodicesimo,
                                		                "contaG1"    => $d1->Sit_Conta_Gene12,
                                		                "interno"    => $d1->Interno,
                                		                "status"     => $d1->Stato12,
                                		                "data"       => $d1->Data_Inserimento12,
                                		                "doppio"     => $d1->Doppio_Contatore,
                                		                "inverso"    => $d1->Contatore_Inverso,
                                		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                                		                "tipo_contatore" => $d1->Tipo,
                                		                "palazzina"      => $d1->Palazzina,
                                		                "domestico"        => $d1->Domestico,
                                		                "dent"       => $d1->id_user
                                		              ];                                			     
                                		          }
                                			
                		                    }
                		                    while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "interno"    => $d2->Interno,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                    while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		                
                            		              
                		                        ];
                		                   }
            		                   
                        		            $data['valPrec'] = $letturaPrec;
                        		            $data['data'] = $ini_data;
                        		            $data['round']   = $roundings;
                        		            $data['valAtt']  = $letturaAtt;
                        		            $data['statoy']  = $y_status;
                                        	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                else{
                                    echo "Errore: Non esistono Valori Per ".$ls."o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                        }
                        else if($fa == "MEN" && $fp == "SEM")
                        {}
                        
                        else if($fa == "SEM" && $fp == "SEM")
                        {
                            if($trimestreC == 1)
                            {   
                                
                                
                                $check_prev_closed = "select Creazione from Check_List where Trimestre = 2 and Anno = '$scorso_da_fatturare' and Condominio = $idCondominio ";
                                $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                
                                $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                $isCreated         = $get_Creazione->Creazione;
                                
                                if($isCreated == 'Attivo')
                                {   
                                                $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 2 and Anno = '$scorso_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'; ";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                            $queryidScelto1   = "Select Attuale as Val_Secondo,
                                                            Utenze.Interno, 
                                                            Scala, 
                                                            Isolato, 
                                                            Contabilita_Chiuse.Utente, 
                                                            Sit_Conta_Gene2, 
                                                            Stato2   
                                                     from  Letture_Acqua_Semestrali, Utenze, Contabilita_Chiuse   
                                                     where Letture_Acqua_Semestrali.ID = '$idCondominio'
                                                     and Contabilita_Chiuse.Trimestre = 2
                                                     and Contabilita_Chiuse.Anno = '$scorso_da_fatturare' 
                                                     and Letture_Acqua_Semestrali.Anno      = '$scorso_da_fatturare'
                                                     and Letture_Acqua_Semestrali.Anno      = Contabilita_Chiuse.Anno
                                                     and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua_Semestrali.Utente = Contabilita_Chiuse.Utente 
                                                     and Letture_Acqua_Semestrali.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio
                                                     and Utenze.Status = 'ACTIVE'
                                                     and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua_Semestrali.Internus and Tipo_fatturazione = '$fp'
                                                     group by Letture_Acqua_Semestrali.Utente, Letture_Acqua_Semestrali.Internus order by id_user+0;";
                                            }
                                            else
                                            {
                                                $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua_Semestrali, Utenze   where ID = '$idCondominio' 
                                                        and Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and R2 = 'NA'  and  and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                            }
                      
                                                        
                               
                                }
                                else
                                {
                                      $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Acqua_Semestrali, Utenze   where ID = '$idCondominio' 
                                                        and Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and R2 = 'NA'   and Utenze.Status = 'ACTIVE' 
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;"; 
                                }
                                
                               
                                                        
                                $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Acqua_Semestrali, Utenze   where ID = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio   and Utenze.Status = 'ACTIVE'
                                                        and Interno = Internus group by Utente, Internus order by id_user+0;";
                                                        
                               
                             
                                $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                                
                                $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$scorso_da_fatturare'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Trimestre = 2
                                                        and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and Utenze.Status = 'ACTIVE' and Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                                $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                
                                 
                                 $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                 $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                 if($resultidScelto1)
                                 {
                                      
                    		                   
                                    	while($d = $resultidScelto1->fetch_object())
                            			{
            			                     $letturaPrec[] = [
            			                         
                        		                "nome"       => $d->Utente,
                        		                "val4"       => $d->Val_Secondo,
                        		                "contaG"     => $d->Sit_Conta_Gene2,
                        		                "statuspre"  => $d->Stato2,
                        		                "scala"      => $d->Scala,
                                		        "interno"    => $d->Interno,
                                		        "isolato"    => $d->Isolato
                        		                
                        		              ];
            		                   }
            		                   
            		                   	while($d1 = $resultidScelto2->fetch_object())
                            			{
            			                     $letturaAtt[] = [
            			                         
                        		                "nome"       => $d1->Utente,
                        		                "val1"       => $d1->Val_Primo,
                        		                "contaG1"    => $d1->Sit_Conta_Gene,
                        		                "interno"    => $d1->Interno,
                        		                "status"     => $d1->Stato,
                        		                "data"       => $d1->Data_Inserimento,
                        		                "doppio"     => $d1->Doppio_Contatore,
                        		                "inverso"    => $d1->Contatore_Inverso,
                        		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                        		                "tipo_contatore" => $d1->Tipo,
                        		                "palazzina"      => $d1->Palazzina,
                        		                "domestico"        => $d1->Domestico,
                        		                "dent"       => $d1->id_user
                        		  
                    		               
            		                        ];
            		                   }
            		                   
            		                   	while($d2 = $resultidScelto3->fetch_object())
                            			{
            			                     $roundings[] = [
            			                         
                        		                "nome"       => $d2->Utente,
                        		                "interno"    => $d2->Interno,
                        		                "prev"       => $d2->Arrotondamento
                        		              
            		                        ];
            		                   }
            		                   
            		                   	while($d3 = $result_Y->fetch_object())
                            			{
            			                     $y_status[] = [
            			                         
                        		                "nome"       =>  $d3->Utente,
                        		                "valme"       => $d3->Valore_Medio,
                        		                "interno"       => $d3->Interno
                        		                
                        		              
            		                        ];
            		                   }
            		                   
            		                   
            		            $data['valPrec'] = $letturaPrec; $data['data'] = $ini_data;
            		            $data['round']   = $roundings;
            		            $data['valAtt']  = $letturaAtt;
            		            $data['statoy']  = $y_status;
                            	echo json_encode($data, JSON_PRETTY_PRINT);
                            	  		
                                }
                                 else
                                 {
                                    echo "Errore: Non esistono Valori Per Il 2o ".$scorso_da_fatturare. mysqli_error($connection);
                                 }
                                
                            }
                            else if ($trimestreC == 2)
                            {
                                       
                                        
                                        $check_prev_closed = "select Creazione from Check_List where Trimestre = 1 and Anno = '$anno_da_fatturare'  and Condominio = $idCondominio ";
                                        $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                                        
                                        $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                                        $isCreated         = $get_Creazione->Creazione;
                                
                                        if($isCreated == 'Attivo')
                                        {
                                            
                                               $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 1 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio and Tipo_fatturazione = '$fp'";
                                            
                                                $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                                
                                                $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                                $isValid         = $get_Tabu->Attuale;
                                            if(isset($isValid))
                                            {
                                                                    $queryidScelto1   = "Select Attuale,
                                                                    Val_Secondo as trim3,
                                                                    Utenze.Interno, 
                                                                    Scala, 
                                                                    Isolato, 
                                                                    Contabilita_Chiuse.Utente, 
                                                                    Sit_Conta_Gene,
                                                                    Sit_Conta_Gene2,
                                                                    Stato,
                                                                    Stato2,
                                                                    Doppio_Contatore,
                                                                    Bonus_Idrico,
                                                                    Tipo,
                                                                    Palazzina,
                                                                    Domestico,
                                                                    Contatore_Inverso,
                                                                    Data_Inserimento2,
                                                                    id_user
                                                             from  Letture_Acqua_Semestrali, Utenze, Contabilita_Chiuse   
                                                             where Letture_Acqua_Semestrali.ID = '$idCondominio' 
                                                             and Contabilita_Chiuse.Trimestre = 2
                                                             and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                             and Letture_Acqua_Semestrali.Anno      = '$anno_da_fatturare'
                                                             and Letture_Acqua_Semestrali.Anno      = Contabilita_Chiuse.Anno
                                                             and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Acqua_Semestrali.Utente = Contabilita_Chiuse.Utente 
                                                             and Letture_Acqua_Semestrali.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio  and Tipo_fatturazione = '$fp'
                                                             and Utenze.Status = 'ACTIVE'
                                                             and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Acqua_Semestrali.Internus 
                                                             group by Letture_Acqua_Semestrali.Utente, Letture_Acqua_Semestrali.Internus order by id_user+0;";
                                            }
                                            else
                                            {
                                                $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico,
                                                                id_user from  miteamx1_players.Letture_Acqua_Semestrali, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and Interno = Internus  and  R1 = 'NA'  group by Utente, Internus order by id_user+0;";
                                            }
    
                                                
                                        }
                                        else
                                        {
                                            $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico,
                                                                id_user from  miteamx1_players.Letture_Acqua_Semestrali, Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                                and Interno = Internus  and  R1 = 'NA'  group by Utente, Internus order by id_user+0;";
                                        }
                                        //echo $queryidScelto1;
                                        
                                        $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                        
                                        $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' 
                                                                and Trimestre = 1  and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                        $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                        
                                        $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                        $result_Y        = mysqli_query($connection, $query_for_Y);
                       
                                       
                                                                 
                                        if($resultidScelto1)
                                        {
                                                
                                             
                                    		   while($d = $resultidScelto1->fetch_object())
                                    		   {
                    			                     $letturaPrec[] = [
                    			                         
                                		                 "nome"       => $d->Utente, 
                                            		     "val2"       => $d->Attuale,
                                            		     "val3"       => $d->trim3,
                                            		     
                                            		     "contaG"     => $d->Sit_Conta_Gene,
                                            		     "contaG1"    => $d->Sit_Conta_Gene2,
                                            		     "status"     => $d->Stato2,
                                            		     "statuspre"  => $d->Stato,
                                            		     "doppio"     => $d->Doppio_Contatore,
                                            		     "inverso"    => $d->Contatore_Inverso,
                                            		     "Bonus_Idrico" => $d->Bonus_Idrico,
                                            		     "tipo_contatore" => $d->Tipo,
                                            		     "palazzina"      => $d->Palazzina,
                                            		     "domestico"        => $d->Domestico,
                                            		     "scala"      => $d->Scala,
                                                         "interno"    => $d->Interno,
                                            		     "isolato"    => $d->Isolato,
                                            		     "data"       => $d->Data_Inserimento2,
                                            		     "dent"       => $d->id_user
                                		                
                            		               
                    		                        ];
                    		                   }
                    		                   
                    		                   
                    		                   while($d2 = $resultidScelto3->fetch_object())
                            			       {
            			                         $roundings[] = [
            			                         
                        		                 "nome"       => $d2->Utente,
                        		                 "prev"       => $d2->Arrotondamento
                        		              
            		                            ];
            		                           }
                            		           while($d3 = $result_Y->fetch_object())
                                               {
                            			                     $y_status[] = [
                            			                         
                                        		                "nome"       =>  $d3->Utente,
                                        		                "valme"       => $d3->Valore_Medio,
                                        		                "interno"       => $d3->Interno
                                        		              
                            		                        ];
                            		              }    
                                    		      
                    		                   	$data['round']     = $roundings;
                                            	$data['valPrec']   = $letturaPrec;
                                            	$data['data'] = $ini_data;
                                            	$data['statoy']    = $y_status;
                                            
                                            	
                                            	echo json_encode($data, JSON_PRETTY_PRINT);
                                    	  		
                                        }
                                        else
                                        {
                                            
                                            echo "Errore: ". mysqli_error($connection);
                                        }
                                        
                                    }
                        }
                        else if($fa == "SEM" && $fp == "BIM")
                        {
                                      
                        }
                        else if($fa == "SEM" && $fp == "TRIM")
                        {}
                        else if($fa == "SEM" && $fp == "MEN")
                        {}
                        
                        
                        
                        
                     
                     } //sotto inizia gas  
                     else
                     {
                      //user selected gas   
                      $fa == "BIM" && $fp == "BIM";
                      
                       if($trimestreC == 1)
                       {   
                           
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 6 and Anno = '$scorso_da_fatturare' and Condominio = $idCondominio ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                            if($isCreated == 'Attivo')
                            {
                                
                                           $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 6 and Anno = '$scorso_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                            $queryidScelto1   = "Select Attuale as Val_Sesto,
                                                        Utenze.Interno, 
                                                        Scala, 
                                                        Isolato, 
                                                        Contabilita_Chiuse.Utente, 
                                                        Sit_Conta_Gene6, 
                                                        Stato6   
                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                 where Letture_Gas.ID = '$idCondominio'
                                                 and Contabilita_Chiuse.Trimestre = 6
                                                 and Contabilita_Chiuse.Anno = '$scorso_da_fatturare' 
                                                 and Letture_Gas.Anno      = '$scorso_da_fatturare'
                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                 and Utenze.Status = 'ACTIVE'
                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                            
                                                $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' and
                                                Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Val_Sesto != 'NA' and R6 = 'NA' and Utenze.Status = 'ACTIVE'
                                                and Interno = Internus group by Utente, Internus order by id_user+0;";
                                        }
                                 
                                              
                            }
                            else
                            {
                            
                                 $queryidScelto1   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' and
                                                Anno = '$scorso_da_fatturare' and Utente = CONCAT(Nome,' ', Cognome) and ID = ID_Condominio and Val_Sesto != 'NA' and R6 = 'NA' and Utenze.Status = 'ACTIVE'
                                                and Interno = Internus group by Utente, Internus order by id_user+0;";
                            }                   
                            $queryidScelto2   = "Select *  from  miteamx1_players.Letture_Gas, Utenze   where ID = '$idCondominio' 
                                                and Anno = '$anno_da_fatturare'   and Utente = CONCAT(Nome,' ' , Cognome) and ID = ID_Condominio   and Utenze.Status = 'ACTIVE'
                                                and Val_Primo != 'NA'   and Interno = Internus group by Utente, Internus order by id_user+0;";
                            
                          
                                    
                            
                            $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            $resultidScelto2  = mysqli_query($connection, $queryidScelto2);
                            
                            $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze where Arrotondamenti.ID_Condominio = '$idCondominio'
                                                and Anno = '$scorso_da_fatturare'  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) 
                                                and Trimestre = 6 and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                                
                                                
                                            
                            $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                            
                             
                             $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC'
                                                    and Anno = '$anno_da_fatturare'; ";
                             $result_Y        = mysqli_query($connection, $query_for_Y);
                             
                             
                                 
                             if($resultidScelto1)
                             {
                                 
                                   
                                	while($d = $resultidScelto1->fetch_object())
                        			{
        			                     $letturaPrec[] = [
        			                         
                    		                "nome"       => $d->Utente,
                    		                "val4"       => $d->Val_Sesto,
                    		                "contaG"     => $d->Sit_Conta_Gene6,
                    		                "prec"       => $d->Val_Quinto,
                    		                "statuspre"  => $d->Stato6,
                    		                "scala"      => $d->Scala,
                            		        "interno"    => $d->Interno,
                            		        "isolato"    => $d->Isolato
                    		                
                    		              ];
        		                   }
        		                   
        		                   	while($d1 = $resultidScelto2->fetch_object())
                        			{
        			                     $letturaAtt[] = [
        			                         
                    		                "nome"       => $d1->Utente,
                    		                "val1"       => $d1->Val_Primo,
                    		                "contaG1"    => $d1->Sit_Conta_Gene,
                    		                "interno"    => $d1->Interno,
                    		                "status"     => $d1->Stato,
                    		                "data"       => $d1->Data_Inserimento,
                    		                "doppio"     => $d1->Doppio_Contatore,
                    		                "inverso"    => $d1->Contatore_Inverso,
                    		                "Bonus_Idrico" => $d1->Bonus_Idrico,
                    		                "tipo_contatore" => $d1->Tipo,
                    		                "palazzina"      => $d1->Palazzina,
                    		                "domestico"        => $d1->Domestico,
                    		                "dent"       => $d1->id_user
                    		  
                		               
        		                        ];
        		                   }
        		                   
        		                   	while($d2 = $resultidScelto3->fetch_object())
                        			{
        			                     $roundings[] = [
        			                         
                    		                "nome"       => $d2->Utente,
                    		                "prev"       => $d2->Arrotondamento
                    		              
        		                        ];
        		                   }
        		                   
        		                   	while($d3 = $result_Y->fetch_object())
                        			{
        			                     $y_status[] = [
        			                         
                    		                "nome"          => $d3->Utente,
                    		                "valme"         => $d3->Valore_Medio,
                    		                "interno"       => $d3->Interno
                    		                
                    		              
        		                        ];
        		                   }
        		                   
        		                   
        		            $data['valPrec'] = $letturaPrec; $data['data'] = $ini_data;
        		            $data['round']   = $roundings;
        		            $data['valAtt']  = $letturaAtt;
        		            $data['statoy']  = $y_status;
                        	echo json_encode($data, JSON_PRETTY_PRINT);
                        	  		
                            }
                            else
                            {
                                echo "Errore:". mysqli_error($connection);
                            }
                            
                        }
                       else if($trimestreC == 2)
                       {
                           
                                    
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 1 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                                    if($isCreated == 'Attivo')
                                    {
                                        $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 1 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                                                       $queryidScelto1   = "Select Attuale,
                                                                        Val_Secondo as trim3,
                                                                        Utenze.Interno, 
                                                                        Scala, 
                                                                        Isolato, 
                                                                        Contabilita_Chiuse.Utente, 
                                                                        Sit_Conta_Gene,
                                                                        Sit_Conta_Gene2,
                                                                        Stato,
                                                                        Stato2,
                                                                        Doppio_Contatore,
                                                                        Contatore_Inverso,
                                                                        Bonus_Idrico,
                                                                        Tipo,
                                                                        Palazzina,
                                                                        Domestico,
                                                                        Data_Inserimento2,
                                                                        id_user
                                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                                 where Letture_Gas.ID = '$idCondominio' 
                                                                 and Contabilita_Chiuse.Trimestre = 1
                                                                 and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                                 and Letture_Gas.Anno      = '$anno_da_fatturare'
                                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                                 and Utenze.Status = 'ACTIVE'
                                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                                     $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore, Bonus_Idrico, Tipo,Palazzina, Domestico,  Contatore_Inverso, id_user from  miteamx1_players.Letture_Gas,
                                                                    Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and Utente = CONCAT(Nome, ' ', Cognome) 
                                                                    and ID = ID_Condominio  and Val_Secondo != 'NA'  and R1 = 'NA'  and Utenze.Status = 'ACTIVE' 
                                                                    and Interno = Internus  group by Utente, Internus order by id_user+0 ;";
                                        }
 
                                    }
                                    else
                                    {
                                            $queryidScelto1   = "Select Val_Primo as Attuale, Val_Secondo as trim3, Utente, Sit_Conta_Gene, Sit_Conta_Gene2, Stato2, Stato, Scala,Interno,Isolato,Data_Inserimento2, Doppio_Contatore, Bonus_Idrico, Tipo, Palazzina, Domestico, id_user, Contatore_Inverso from  miteamx1_players.Letture_Gas,
                                                                    Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and Utente = CONCAT(Nome, ' ', Cognome) 
                                                                    and ID = ID_Condominio  and Val_Secondo != 'NA'  and R1 = 'NA'   and Utenze.Status = 'ACTIVE'
                                                                    and Interno = Internus  group by Utente, Internus order by id_user+0 ;";
                                    }                               
                                    $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                    
                                    
                                    $queryidScelto3   = "Select * from  miteamx1_players.Arrotondamenti, Utenze  where Arrotondamenti.ID_Condominio = '$idCondominio'
                                                        and Anno = '$anno_da_fatturare' and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome)  and Utenze.Status = 'ACTIVE'
                                                        and Trimestre = 1  and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0 ;";
                                    $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                    
                                    $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                    $result_Y        = mysqli_query($connection, $query_for_Y);
                                    
                                    if($resultidScelto1)
                                    {
                                          
                                    
                                			while($d = $resultidScelto1->fetch_object())
                                			{
                			                     $letturaPrec[] = [
                			                         
                            		                "nome"       => $d->Utente,
                            		                "val2"       => $d->Attuale,
                            		                "val3"       => $d->trim3,
                            		                "contaG"     => $d->Sit_Conta_Gene,
                            		                "contaG1"    => $d->Sit_Conta_Gene2,
                            		                "status"     => $d->Stato2,
                            		                "statuspre"  => $d->Stato,
                            		                "doppio"     => $d->Doppio_Contatore,
                            		                "inverso"    => $d->Contatore_Inverso,
                            		                "Bonus_Idrico" => $d->Bonus_Idrico,
                            		                "tipo_contatore" => $d->Tipo,
                            		                "palazzina"      => $d->Palazzina,
                            		                "domestico"        => $d->Domestico,
                            		                "scala"      => $d->Scala,
                            		                "interno"    => $d->Interno,
                            		                "isolato"    => $d->Isolato,
                            		                "data"       => $d->Data_Inserimento2,
                            		                "dent"       => $d->id_user
                        		               
                		                        ];
                		                   }
                		                   
                        		            while($d2 = $resultidScelto3->fetch_object())
                                			{
                			                     $roundings[] = [
                			                         
                            		                "nome"       => $d2->Utente,
                            		                "prev"       => $d2->Arrotondamento
                            		              
                		                        ];
                		                   }
                		                   
                		                   	while($d3 = $result_Y->fetch_object())
                                			{
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		              
                		                        ];
                		                   } 
                                        	$data['valPrec'] = $letturaPrec;
                                        	$data['data'] = $ini_data;
                                        	$data['round']   = $roundings;
                                            $data['statoy']  = $y_status;
                                        
                                	        echo json_encode($data, JSON_PRETTY_PRINT);
                                	  		
                                    }
                                    else
                                    {
                                        echo "Errore: ". mysqli_error($connection);
                                    }
                                    
                                    
                        }
                       else if($trimestreC == 3)
                       {   
                           
                           
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 2 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                                    if($isCreated == 'Attivo')
                                    {
                                        
                                           $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 2 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                            $queryidScelto1   = "Select Attuale,
                                                                        Val_Terzo as trim3,
                                                                        Utenze.Interno, 
                                                                        Scala, 
                                                                        Isolato, 
                                                                        Contabilita_Chiuse.Utente, 
                                                                        Sit_Conta_Gene2,
                                                                        Sit_Conta_Gene3,
                                                                        Stato2,
                                                                        Stato3,
                                                                        Doppio_Contatore,
                                                                        Contatore_Inverso,
                                                                        Bonus_Idrico,
                                                                        Tipo,
                                                                        Palazzina,
                                                                        Domestico,
                                                                        Data_Inserimento3,
                                                                        id_user
                                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                                 where Letture_Gas.ID = '$idCondominio' 
                                                                 and Contabilita_Chiuse.Trimestre = 2
                                                                 and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                                 and Letture_Gas.Anno      = '$anno_da_fatturare'
                                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                                 and Utenze.Status = 'ACTIVE'
                                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                              $queryidScelto1   = "Select Val_Secondo as Attuale, Val_Terzo as trim3, Val_Primo as prece, Utente, Sit_Conta_Gene2, Sit_Conta_Gene3, Stato3, Stato2, Scala,Interno,Isolato,Data_Inserimento3, Doppio_Contatore, Tipo, Palazzina, Domestico,  Contatore_Inverso, id_user from  miteamx1_players.Letture_Gas,
                                                    Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio 
                                                    and Utente = CONCAT(Nome, ' ', Cognome)  and Val_Terzo != 'NA' and   R1 = 'NA'  and Utenze.Status = 'ACTIVE'
                                                    and Interno = Internus group by Utente, Internus order by id_user+0;";
                                        }
                                        
                                         
                                    }
                                    else
                                    {
                                                   $queryidScelto1   = "Select Val_Secondo as Attuale, Val_Terzo as trim3, Val_Primo as prece, Utente, Sit_Conta_Gene2, Sit_Conta_Gene3, Stato3, Stato2, Scala,Interno,Isolato,Data_Inserimento3, Doppio_Contatore,  Tipo, Palazzina, Domestico, Contatore_Inverso,  id_user from  miteamx1_players.Letture_Gas,
                                                    Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio 
                                                    and Utente = CONCAT(Nome, ' ', Cognome)  and Val_Terzo != 'NA' and   R1 = 'NA'  and Utenze.Status = 'ACTIVE'
                                                    and Interno = Internus group by Utente, Internus order by id_user+0;";
                                    }
         
                            
                            $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                            
                            $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                            $result_Y        = mysqli_query($connection, $query_for_Y);
                          
                                       
                            $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' 
                                                    and Trimestre = 2  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) and Utenze.Status = 'ACTIVE'
                                                                and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno group by Utente, Internio order by id_user+0;";
                            $resultidScelto3  = mysqli_query($connection, $queryidScelto3);

                                    
                            if($resultidScelto1)
                            {
                                
                                while($d = $resultidScelto1->fetch_object())
                                {
                			        $letturaPrec[] = [
                			                         
                            		     "nome"       => $d->Utente,
                            		     "val2"       => $d->Attuale,
                            		     "val3"       => $d->trim3,
                            		     "prec"       => $d->prece,
                            		     "contaG"     => $d->Sit_Conta_Gene2,
                            		     "contaG1"    => $d->Sit_Conta_Gene3,
                            		     "status"     => $d->Stato3,
                            		     "statuspre"  => $d->Stato2,
                            		     "doppio"     => $d->Doppio_Contatore,
                            		     "inverso"    => $d->Contatore_Inverso,
                            		     "Bonus_Idrico" => $d->Bonus_Idrico,
                            		     "tipo_contatore" => $d->Tipo,
                            		     "palazzina"      => $d->Palazzina,
                            		     "domestico"        => $d->Domestico,
                            		     "scala"      => $d->Scala,
                                         "interno"    => $d->Interno,
                            		     "isolato"    => $d->Isolato,
                            		     "data"       => $d->Data_Inserimento3,
                            		     "dent"       => $d->id_user
                        		               
                		                        ];
                		                   }
                		        while($d3 = $result_Y->fetch_object())
                                {
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		              
                		                        ];
                		                        
                		          } 
                		        while($d2 = $resultidScelto3->fetch_object())
                        		{
        			                     $roundings[] = [
        			                         
                    		                "nome"       => $d2->Utente,
                    		                "prev"       => $d2->Arrotondamento
                    		              
        		                        ];
        		                }
        		                   
        		                  
                                	$data['valPrec'] = $letturaPrec; $data['data'] = $ini_data;
                                	$data['round']   = $roundings;
                                	$data['statoy']  = $y_status;
                                	
                                	
                                	
                                	echo json_encode($data, JSON_PRETTY_PRINT);
                                	  		
                                    }
                            else
                            {
                                        echo "Errore: ". mysqli_error($connection);
                            }
                                    
                       }
                       else if ($trimestreC == 4)
                       {
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 3 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                                    if($isCreated == 'Attivo')
                                    {
                                        
                                           $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 3 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                                                        $queryidScelto1   = "Select Attuale,
                                                                        Val_Quarto as trim3,
                                                                        Utenze.Interno, 
                                                                        Scala, 
                                                                        Isolato, 
                                                                        Contabilita_Chiuse.Utente, 
                                                                        Sit_Conta_Gene3,
                                                                        Sit_Conta_Gene4,
                                                                        Stato3,
                                                                        Stato4,
                                                                        Doppio_Contatore,
                                                                        Contatore_Inverso,
                                                                        Bonus_Idrico,
                                                                        Tipo,
                                                                        Palazzina,
                                                                        Domestico,
                                                                        Data_Inserimento4,
                                                                        id_user
                                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                                 where Letture_Gas.ID = '$idCondominio' 
                                                                 and Contabilita_Chiuse.Trimestre = 3
                                                                 and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                                 and Letture_Gas.Anno      = '$anno_da_fatturare'
                                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                                 and Utenze.Status = 'ACTIVE'
                                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                             $queryidScelto1   = "Select Val_Terzo as Attuale, Val_Quarto as trim3, Val_Secondo as prece, Utente, Sit_Conta_Gene3, Sit_Conta_Gene4, Stato4,Stato3, Scala,Interno,Isolato,Data_Inserimento4, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user, Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Quarto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R3 = 'NA'  group by Utente, Internus order by id_user+0;";
                                        }
        
                                    }
                                    else
                                    {
                                         $queryidScelto1   = "Select Val_Terzo as Attuale, Val_Quarto as trim3, Val_Secondo as prece, Utente, Sit_Conta_Gene3, Sit_Conta_Gene4, Stato4,Stato3, Scala,Interno,Isolato,Data_Inserimento4, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user, Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Quarto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R3 = 'NA'  group by Utente, Internus order by id_user+0;";
                                    }
                                   
                                                            
                                    $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                    
                                    $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' and Trimestre = 3  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome)
                                                            and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                    $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                    
                                    $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                    $result_Y        = mysqli_query($connection, $query_for_Y);
                                 
                                    if($resultidScelto1)
                                    {
                                           
                            		        
                                	      while($d = $resultidScelto1->fetch_object())
                                		  {
                			                     $letturaPrec[] = [
                			                         
                            		                 "nome"       => $d->Utente, 
                                        		     "val2"       => $d->Attuale,
                                        		     "val3"       => $d->trim3,
                                        		     "prec"       => $d->prece,
                                        		     "contaG"     => $d->Sit_Conta_Gene3,
                                        		     "contaG1"    => $d->Sit_Conta_Gene4,
                                        		     "status"     => $d->Stato4,
                                        		     "statuspre"  => $d->Stato3,
                                        		     "doppio"     => $d->Doppio_Contatore,
                                        		     "inverso"    => $d->Contatore_Inverso,
                                        		     "Bonus_Idrico" => $d->Bonus_Idrico,
                                        		     "tipo_contatore" => $d->Tipo,
                                        		     "palazzina"      => $d->Palazzina,
                                        		     "domestico"        => $d->Domestico,
                                        		     "scala"      => $d->Scala,
                                                     "interno"    => $d->Interno,
                                        		     "isolato"    => $d->Isolato,
                                        		     "data"       => $d->Data_Inserimento4,
                                        		     "dent"       => $d->id_user
                            		                
                        		               
                		                        ];
                		                   }
                		                  while($d2 = $resultidScelto3->fetch_object())
                        			      {
        			                         $roundings[] = [
        			                         
                    		                 "nome"       => $d2->Utente,
                    		                 "prev"       => $d2->Arrotondamento
                    		              
        		                            ];
        		                        }
                    		              while($d3 = $result_Y->fetch_object())
                                          {
                    			                     $y_status[] = [
                    			                         
                                		                "nome"       =>  $d3->Utente,
                                		                "valme"       => $d3->Valore_Medio,
                                		                "interno"       => $d3->Interno
                                		              
                    		                        ];
                    		              }
                    		              
        		                   	$data['round']   = $roundings;
                                	$data['valPrec'] = $letturaPrec; 
                                	$data['data'] = $ini_data;
                                	$data['statoy']  = $y_status;
                                
                                	
                                	echo json_encode($data, JSON_PRETTY_PRINT);
                                	  		
                                    }
                                    else
                                    {
                                        
                                        echo "Errore: ". mysqli_error($connection);
                                    }
                                    
                                }
                       else if ($trimestreC == 5)
                       {
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 4 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                                    if($isCreated == 'Attivo')
                                    {
                                        
                                         $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 4 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                            $queryidScelto1   = "Select Attuale,
                                                                        Val_Quinto as trim3,
                                                                        Utenze.Interno, 
                                                                        Scala, 
                                                                        Isolato, 
                                                                        Contabilita_Chiuse.Utente, 
                                                                        Sit_Conta_Gene4,
                                                                        Sit_Conta_Gene5,
                                                                        Stato4,
                                                                        Stato5,
                                                                        Doppio_Contatore,
                                                                        Contatore_Inverso,
                                                                        Bonus_Idrico,
                                                                        Tipo,
                                                                        Palazzina,
                                                                        Domestico,
                                                                        Data_Inserimento5,
                                                                        id_user
                                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                                 where Letture_Gas.ID = '$idCondominio' 
                                                                 and Contabilita_Chiuse.Trimestre = 4
                                                                 and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                                 and Letture_Gas.Anno      = '$anno_da_fatturare'
                                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                                 and Utenze.Status = 'ACTIVE'
                                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                             $queryidScelto1   = "Select Val_Quarto as Attuale, Val_Quinto as trim3, Val_Terzo as prec, Utente, Sit_Conta_Gene4, Sit_Conta_Gene5, Stato5, Stato4, Scala,Interno,Isolato,Data_Inserimento5, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user, Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Quinto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R4 = 'NA'  group by Utente, Internus order by id_user+0;";
                                        }
                                         
                                    }
                                    else
                                    {
                                         $queryidScelto1   = "Select Val_Quarto as Attuale, Val_Quinto as trim3, Val_Terzo as prec, Utente, Sit_Conta_Gene4, Sit_Conta_Gene5, Stato5, Stato4, Scala,Interno,Isolato,Data_Inserimento5, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user, Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Quinto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R4 = 'NA'  group by Utente, Internus order by id_user+0;";
                                    }
                                   
                                    $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                    
                                    $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' and Trimestre = 4  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome) 
                                                            and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                    $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                    
                                    $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                    $result_Y        = mysqli_query($connection, $query_for_Y);
                                       
                                        
                                    if($resultidScelto1)
                                    {
                                           
                                    
                                			while($d = $resultidScelto1->fetch_object())
                                			{
                			                     $letturaPrec[] = [
                			                         
                            		                 "nome"       => $d->Utente, 
                                        		     "val2"       => $d->Attuale,
                                        		     "val3"       => $d->trim3,
                                        		     "contaG"     => $d->Sit_Conta_Gene4,
                                        		     "contaG1"    => $d->Sit_Conta_Gene5,
                                        		     "prec"       => $d->prec,
                                        		     "status"     => $d->Stato5,
                                        		     "statuspre"  => $d->Stato4,
                                        		     "doppio"     => $d->Doppio_Contatore,
                                        		     "inverso"    => $d->Contatore_Inverso,
                                        		     "Bonus_Idrico" => $d->Bonus_Idrico,
                                        		     "tipo_contatore" => $d->Tipo,
                                        		     "palazzina"      => $d->Palazzina,
                                        		     "domestico"        => $d->Domestico,
                                        		     "scala"      => $d->Scala,
                                                     "interno"    => $d->Interno,
                                        		     "isolato"    => $d->Isolato,
                                        		     "data"       => $d->Data_Inserimento5,
                                        		     "dent"       => $d->id_user
                            		                
                        		               
                		                        ];
                		                   }
                		                   
                		                   while($d2 = $resultidScelto3->fetch_object())
                        			        {
        			                         $roundings[] = [
        			                         
                    		                 "nome"       => $d2->Utente,
                    		                 "prev"       => $d2->Arrotondamento
                    		              
        		                            ];
        		                        }
                		              while($d3 = $result_Y->fetch_object())
                                     {
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		              
                		                        ];
                		              }       
        		                   	$data['round']   = $roundings;
                                	$data['valPrec'] = $letturaPrec; $data['data'] = $ini_data;
                                	$data['statoy']  = $y_status;
                                
                                	
                                	echo json_encode($data, JSON_PRETTY_PRINT);
                                	  		
                                    }
                                    else
                                    {
                                        
                                        echo "Errore: ". mysqli_error($connection);
                                    }
                                    
                                }
                       else if ($trimestreC == 6)
                       {
                          
                            $check_prev_closed = "select Creazione from Check_List where Trimestre = 5 and Anno = '$anno_da_fatturare' and Condominio = $idCondominio             ";
                            $result_chec_prev  = mysqli_query($connection, $check_prev_closed);
                            
                            $get_Creazione     = mysqli_fetch_object($result_chec_prev);
                            $isCreated         = $get_Creazione->Creazione;
                            
                                    if($isCreated == 'Attivo')
                                    {
                                         $check_tabu = "select Attuale from Contabilita_Chiuse where Trimestre = 5 and Anno = '$anno_da_fatturare' and ID_Condominio = $idCondominio";
                                        
                                            $result_chec_tabu = mysqli_query($connection, $check_tabu);
                                            
                                            $get_Tabu    = mysqli_fetch_object($result_chec_tabu);
                                            $isValid         = $get_Tabu->Attuale;
                                        if(isset($isValid))
                                        {
                                             $queryidScelto1   = "Select Attuale,
                                                                        Val_Sesto as trim3,
                                                                        Utenze.Interno, 
                                                                        Scala, 
                                                                        Isolato, 
                                                                        Contabilita_Chiuse.Utente, 
                                                                        Sit_Conta_Gene5,
                                                                        Sit_Conta_Gene6,
                                                                        Stato5,
                                                                        Stato6,
                                                                        Doppio_Contatore,
                                                                        Contatore_Inverso,
                                                                        Bonus_Idrico,
                                                                        Tipo,
                                                                        Palazzina,
                                                                        Domestico,
                                                                        Data_Inserimento6,
                                                                        id_user
                                                                 from  Letture_Gas, Utenze, Contabilita_Chiuse   
                                                                 where Letture_Gas.ID = '$idCondominio' 
                                                                 and Contabilita_Chiuse.Trimestre = 5
                                                                 and Contabilita_Chiuse.Anno = '$anno_da_fatturare' 
                                                                 and Letture_Gas.Anno      = '$anno_da_fatturare'
                                                                 and Letture_Gas.Anno      = Contabilita_Chiuse.Anno
                                                                 and Contabilita_Chiuse.Utente = CONCAT(Nome,' ', Cognome) and Letture_Gas.Utente = Contabilita_Chiuse.Utente 
                                                                 and Letture_Gas.ID = Contabilita_Chiuse.ID_Condominio and Contabilita_Chiuse.ID_Condominio = Utenze.ID_Condominio 
                                                                 and Utenze.Status = 'ACTIVE'
                                                                 and Utenze.Interno = Contabilita_Chiuse.Interno and Contabilita_Chiuse.Interno = Letture_Gas.Internus 
                                                                 group by Letture_Gas.Utente, Letture_Gas.Internus order by id_user+0;";
                                        }
                                        else
                                        {
                                            $queryidScelto1   = "Select Val_Quinto as Attuale, Val_Sesto as trim3, Val_Quarto as prec, Utente, Sit_Conta_Gene5, Sit_Conta_Gene6, Stato6, Stato5, Scala,Interno,Isolato,Data_Inserimento6, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user, Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Sesto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R5 = 'NA'  group by Utente, Internus order by id_user+0;";
                                        }
                                        
                                    }
                                    else
                                    {
                                        $queryidScelto1   = "Select Val_Quinto as Attuale, Val_Sesto as trim3, Val_Quarto as prec, Utente, Sit_Conta_Gene5, Sit_Conta_Gene6, Stato6, Stato5, Scala,Interno,Isolato,Data_Inserimento6, Doppio_Contatore, Tipo, Palazzina, Domestico, id_user,  Bonus_Idrico, Contatore_Inverso from  miteamx1_players.Letture_Gas, 
                                                            Utenze where ID = '$idCondominio' and Anno = '$anno_da_fatturare' and ID = ID_Condominio and Utente = CONCAT(Nome, ' ', Cognome)  and Interno = Internus and Val_Sesto!= 'NA' and Utenze.Status = 'ACTIVE'
                                                            and  R5 = 'NA'  group by Utente, Internus order by id_user+0;";
                                    }
                                    
                                    $resultidScelto1  = mysqli_query($connection, $queryidScelto1);
                                    
                                    $queryidScelto3   = "Select *  from  miteamx1_players.Arrotondamenti, Utenze   where Arrotondamenti.ID_Condominio = '$idCondominio' and Anno = '$anno_da_fatturare' and Trimestre = 4  and Arrotondamenti.Utente = CONCAT(Nome,' ', Cognome)  
                                                            and Arrotondamenti.ID_Condominio = Utenze.ID_Condominio and Arrotondamenti.Fatturazione = '$fa' and  Arrotondamenti.Internio = Utenze.Interno and Utenze.Status = 'ACTIVE' group by Utente, Internio order by id_user+0;";
                                    $resultidScelto3  = mysqli_query($connection, $queryidScelto3);
                                    
                                    $query_for_Y     = "Select Utente, Valore_Medio, Interno from  Medie_Imposte where ID_Condominio = '$idCondominio' and Trimestre = '$trimestreC' and Anno = '$anno_da_fatturare'; ";
                                    $result_Y        = mysqli_query($connection, $query_for_Y);
                              
                                    
                                    if($resultidScelto1)
                                    {
                                        
                                    
                                			while($d = $resultidScelto1->fetch_object())
                                			{
                			                     $letturaPrec[] = [
                			                         
                            		                 "nome"       => $d->Utente, 
                                        		     "val2"       => $d->Attuale,
                                        		     "val3"       => $d->trim3,
                                        		     "prec"       => $d->prece,
                                        		     "contaG"     => $d->Sit_Conta_Gene5,
                                        		     "contaG1"    => $d->Sit_Conta_Gene6,
                                        		     "status"     => $d->Stato6,
                                        		     "statuspre"  => $d->Stato5,
                                        		     "doppio"     => $d->Doppio_Contatore,
                                        		     "inverso"    => $d->Contatore_Inverso,
                                        		      "Bonus_Idrico" => $d->Bonus_Idrico,
                                        		      "tipo_contatore" => $d->Tipo,
                                        		      "palazzina"      => $d->Palazzina,
                                        		      "domestico"        => $d->Domestico,
                                        		     "scala"      => $d->Scala,
                                                     "interno"    => $d->Interno,
                                        		     "isolato"    => $d->Isolato,
                                        		     "data"       => $d->Data_Inserimento6,
                                        		     "dent"       => $d->id_user
                            		                
                        		               
                		                        ];
                		                   }
                		                   
                		                   while($d2 = $resultidScelto3->fetch_object())
                        			        {
        			                         $roundings[] = [
        			                         
                    		                 "nome"       => $d2->Utente,
                    		                 "prev"       => $d2->Arrotondamento
                    		              
        		                            ];
        		                        }
                		              while($d3 = $result_Y->fetch_object())
                                     {
                			                     $y_status[] = [
                			                         
                            		                "nome"       =>  $d3->Utente,
                            		                "valme"       => $d3->Valore_Medio,
                            		                "interno"       => $d3->Interno
                            		              
                		                        ];
                		              }       
        		                   	$data['round']   = $roundings;
                                	$data['valPrec'] = $letturaPrec; 
                                	$data['data'] = $ini_data;
                                	$data['maximum']   = $max_per_user;
                                	$data['statoy']  = $y_status;
                                
                                	
                                	echo json_encode($data, JSON_PRETTY_PRINT);
                                	  		
                                    }
                                    else
                                    {
                                        
                                        echo "Errore: ". mysqli_error($connection);
                                    }
                                    
                                }
                     }
}
else if( $idScelto == 6)
{
            $Condominio  =   $_POST['hbuild'];
            $Strings = explode("-", $Condominio);
            
            $idCondominio = $Strings[0];
            
            
            $query   = "Select Indirizzo as condo, Amministratore as admin, Categoria as cap, Recapito as telefone, Ruolo as ruolo, Sezione as sez, NUAE as nuae, T_F as tf , Indirizzo_Amministratore as indiamm, Email as em  from miteamx1_players.Condominio where ID = '$Condominio'; ";
            
            $result  = mysqli_query($connection, $query);
            
            
            if (mysqli_num_rows($result) <= 0  ){
                echo "Nessuna Lettura Trovata";
                
            }
            else
            {
                $row = mysqli_fetch_object($result);
                
                $val0 = $row->condo;
                $val1 = $row->admin;
                $val2 = $row->telefone;
                $val3 = $row->sez;
                $val4 = $row->cap;
                $val5 = $row->ruolo;
                $val6 = $row->tf;
                $val7 = $row->nuae;
                $val8 = $row->indiamm;
                $val9 = $row->em;
                
                
                echo $val0.";".$val1.";".$val2.";".$val3.";".$val4.";".$val5.";".$val6.";".$val7.";".$val8.";".$val9;
            }
        }
else if( $idScelto == 7 )
{
			$condo   = $_POST['condo'];
			
			$query = "Select id_user, Nome , Cognome, Scala, Interno, Isolato  from miteamx1_players.Utenze where $condo = id_condominio and Status = 'Active' order by id_user+0 asc";
			$result  = mysqli_query($connection, $query);
			
			  if (mysqli_num_rows($result) <= 0  ){
                echo -1;
            }
            else
            {
                 
			while($row_users = mysqli_fetch_assoc($result)){
			    $users[] = $row_users;
			}
			
			echo json_encode(array('users' => $users));
            }
			
		}
else if( $idScelto == 8 )
{  
            $data = array();
			$condo   = $_POST['condo'];
			
			$query = "select count(DISTINCT(nome)) as num from Utenze where ID_Condominio = $condo and Status = 'ACTIVE'";
			
			$query2 = "select id_user as nume from Utenze where ID_Condominio = '$condo' and Status = 'ACTIVE' ORDER BY nume+0";
		    
		
		    //$query2 = "select id_user from Utenze where $condo=id_condominio and  id_auto in (select max(id_auto) from Utenze)";
			$result  = mysqli_query($connection, $query);
		    $result2  = mysqli_query($connection, $query2);
			
			if (mysqli_num_rows($result) <= 0  ){
                echo -1;
            }
            else
            {
                
            //   $row = mysqli_fetch_object($result);
            // 	 $val = $row->num;
            	 
            	 
            	 while($v = $result->fetch_object())
                {
        			$val[] = [
        			                         
                    	 "valore"       => $v->num, 
                       	               
        		      ];
        		}
            	 
            	 while($d = $result2->fetch_object())
                {
        			$ids[] = [
        			                         
                    	 "id_"       => $d->nume, 
                       	               
        		      ];
        		}
            	 
            	 $data['valore'] = $val;
            	 $data['ids']    = $ids;
            	 
            	 echo json_encode($data, JSON_PRETTY_PRINT);
			  
			}
	       
			
}
 else if( $idScelto == 9 )
{
             $data = array();
                
             $query2 = "select id_condo as nume from Condominio  ORDER BY nume+0 asc;";
		     $result2  = mysqli_query($connection, $query2);
		     
		      while($d = $result2->fetch_object())
              {
        			$ids[] = [
        			                         
                    	 "id_"       => $d->nume, 
                       	               
        		      ];
        	   }
            	 
            	 
            	 $data['primo_libero']    = $ids;
            	 
            	 echo json_encode($data, JSON_PRETTY_PRINT);
			
    
    
    
}
else if( $idScelto == 11)
{
            
               $idCondominio  =   $_POST['token'];
               
               $queryidScelto   = "Select Indirizzo from  miteamx1_players.Condominio where Id = '$idCondominio'; ";
               
               
	           $resultidScelto  = mysqli_query($connection, $queryidScelto);
	           
	           $result = mysqli_fetch_object($resultidScelto);
	           
	           echo $result->Indirizzo;
	          
	    
            
}

else if( $idScelto == 99)
{
    
    $pending = "<b style='color:orange'>Da pagare</b>";
    $paid    = "<b style='color:green'> Pagato</b>";
    
    $html = "
        <table style='font-size:20px;height:35vh;'>
            <thead>
                <tr>
                    <th>Tipo di Lavoro</th> <th>Periodo</th> <th>Totale Addebitato €</th><th>Stato</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aggiunta funzioni, modifiche TF, aggiornamento moduli</td><td>Dal 20/09/2019 al 31/12/2019</td><td>100</td><td>".$paid."</td>
                </tr>
                <tr>
                    <td>Aggiunta Bonus Idrico per ABC</td><td>Dal 01/01/2020 al 02/01/2020</td><td>8</td><td>".$paid."</td>
                </tr>
            
                <tr>
                    <td>Aggiunta Consumi Manuali, aggiunta bollette bianche, modifiche discusse con simona </td><td>Dal 11/01/2020 al 27/01/2020</td><td>100</td><td>".$paid."</td> 
                </tr>
                <tr>
                
               
                    <td>Aggiunta contatori ABC, fatturazione semestrale, n-contatori, nuovo sistema pdf </td><td>Dal 15/06/2020 al 24/07/2020</td><td>180</td><td>".$paid."</td> 
                 </tr>
                 <tr>
                     <td>Acconti per nuovo sistema ABC </td><td>Dal 01/12/2020 al 8/12/2020</td><td>50</td><td>".$paid."</td>
                </tr>
               <tr>
                     <td>Aggiunta matricole, controllo stati C, nuovo sistema ACEA, aggiunta gestione amministratori, Incassi, acesso e panello di controllo amministratori</td><td>Dal 09/01/2021 al 09/02/2021</td><td>108</td><td>".$pending."</td>
                </tr>
               <tr>
                     <td>Ripensare fatturazione per tariffe a periodo variabile</td><td>Dal ? al ?</td><td>?</td><td>".$pending."</td>
                </tr>
            </tbody>
        </table>
    
    
    
    
    ";
    
    echo $html;
}
		
       
      
            
            

?>