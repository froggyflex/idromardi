<?php

  include "connect.php";
	
	
	
	
	  $valoreLet =   $_POST['vallet'];  //il periodo
	  $anno      =   $_POST['da'];
	  $condo     =   $_POST['dove'];
	  
	  $periodSelector    =  null;
	  $fatturaPrecedente =  null;
	  
	  if(isset($_POST['sf']) && $_POST['sf'] != "Scegli Tipo Fatturazione" && $_POST['fp'] != "Scegli Tipo Fatturazione Precedente" )
	  {
	      $periodSelector    = strtolower ($_POST['sf']);
	      $fatturaPrecedente = strtolower ($_POST['fp']);
	  }
	  
	    
	  if($periodSelector == null )
	  { 
	      
                   
    	  if( $valoreLet == 1)
    	  {
    	     
    	       $correct = $anno - 1;
    	       
    	       $query        = "Select * from  miteamx1_players.Letture_Acqua,Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus";
    	       $result1      = mysqli_query($connection, $query);
    	       
    	       $query4       = "Select  Utente, Val_Primo, Val_Secondo, Stato, Data_Inserimento, Sit_Conta_Gene, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result4      = mysqli_query($connection, $query4);
    	       
    	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 2 group by Utente, Interno;";
    	       $result_ric   = mysqli_query($connection, $richieste);
    	       
    	       
    	       while($row5 = $result_ric->fetch_object()){
    			  
    			 
           				 $accettazioni[] = [
           				     
    		                "nome"      => $row5->Utente,
    		                "interno"   => $row5->Interno,
    		                "val"       => $row5->Valore_Lettura,
    		                "stato"     => $row5->Stato
    		            ];
    		        }
    	   	
    			  while($row = $result1->fetch_object()){
    			  
    			  	
           				 $lettura[] = [
    		                "nome"       => $row->Utente,
    		                "val1"       => $row->Val_Primo,
    		                "val2"       => $row->Val_Secondo,
    		                "val3"       => $row->Val_Terzo,
    		                "val4"       => $row->Val_Quarto,
    		                "in"         => $row->Internus
    		               
    		            ];
    		        }
    		        
    		        while($row4 = $result4->fetch_object()){
    			  
    			 
           				 $display[] = [
    		                "nome"       => $row4->Utente,
    		                "cur"        => $row4->Val_Primo,
    		                "nextv"      => $row4->Val_Secondo,
    		                "statos"     => $row4->Stato,
    		                "data_"      => explode("-",	$row4->Data_Inserimento)[2].'-'.explode("-",	$row4->Data_Inserimento)[1].'-'.explode("-",	$row4->Data_Inserimento)[0],
    		                "lg"         => $row4->Sit_Conta_Gene,
    		                "in"         => $row4->Internus
    		                
    		               
    		            ];
    		        }
    		         
    		        $data = array();
    		        $data['p1'] = $lettura;
    			    $data['p3'] = $display; 
    		        $data['accettazioni'] = $accettazioni; 
    		      echo json_encode($data, JSON_PRETTY_PRINT);
    	         	
    	  
    	 
    	}
    	  else if( $valoreLet == 2)
    	  {
    	       
    	       $correct = $anno - 1;
    	       $query        = "Select `Utente`,`Val_Primo`, Internus  from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo'  and Status = 'ACTIVE' and Anno = '$anno' group by Utente, Internus;";
    	       $result1      = mysqli_query($connection, $query);
    	       
    	       $query2       = "Select `Utente`, `Val_Quarto`,`Val_Terzo`,`Val_Secondo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result2      = mysqli_query($connection, $query2);
    
    	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
    	       $result3      = mysqli_query($connection, $query3);
    	       
    	       $query4       = "Select  Utente, Val_Secondo, Val_Terzo, Stato2, Data_Inserimento2, Sit_Conta_Gene2, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result4      = mysqli_query($connection, $query4);
    
    	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 3 group by Utente, Interno;";
    	       $result_ric   = mysqli_query($connection, $richieste);
    	       
    	       while($row5 = $result_ric->fetch_object()){
    			  
    			 
           				 $accettazioni[] = [
           				     
    		                "nome"      => $row5->Utente,
    		                "interno"   => $row5->Interno,
    		                "val"       => $row5->Valore_Lettura,
    		                "stato"     => $row5->Stato
    		            ];
    		   }
    		        
    	        $row3 = $result3->fetch_object();
    	        $len = $row3->len;
    	       
    		if (mysqli_num_rows($result1) <= 0)
    	  	{
    	  		echo "Nessun Valore Trovato";
    	  
    	 	} else 
    	 	{
    	 	
    	 	
    	 		while($row = $result1->fetch_object())
    			{
    		  	  $lettura[] = [
    		                "nome"       => $row->Utente,
    		                "val1"       => $row->Val_Primo,
    		                 "in"        => $row->Internus
    		                ];
    			}
    	 		while ($row2 = $result2->fetch_object())
    			{     
    			  	
    			  	 
    			  	
    			  	   $part2[] = [
    		                	"nome"       => $row2->Utente,
    		               		"val4"       => $row2->Val_Quarto,
    		               		"val3"       => $row2->Val_Terzo,
    		               		"val2"       => $row2->Val_Secondo,
    		               		 "in"        => $row2->Internus
    		                ];
    			   
    		     }
    		    while ($row4 = $result4->fetch_object())
    			{     
    			       $nextv = 0;
    			       if($row4->Val_Terzo != null)
    			       {
    			           $nextv =  $row4->Val_Terzo;
    			       }
    			  	   $display[] = [
    		                	"nome"       => $row4->Utente,
    		               		"cur"        => $row4->Val_Secondo,
    		               		"nextv"       => $nextv,
    		               		"statos"     => $row4->Stato2,
    		               		"data_"      => explode("-",	$row4->Data_Inserimento2)[2].'-'.explode("-",	$row4->Data_Inserimento2)[1].'-'.explode("-",	$row4->Data_Inserimento2)[0],
    		               		"lg"         => $row4->Sit_Conta_Gene2,
    		               		 "in"        => $row4->Internus
    		           ];
    		           
    			   
    		     }     
    		         
    		        $data = array();
    		        $data['p1'] = $lettura;
    			    $data['p2'] = $part2;
    		        $data['p3'] = $display;    
    		        $data['accettazioni'] = $accettazioni;
    		        
    		        echo json_encode($data, JSON_PRETTY_PRINT);
    		         
    	  		
    	
    	         }	
    	  
    	 
    	}
    	  else if( $valoreLet == 3)
    	  {
    	       
    	       $correct = $anno - 1;
    	       
    	       $query        = "Select `Utente`,`Val_Primo`,`Val_Secondo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result1      = mysqli_query($connection, $query);
    	       
    	       $query2       = "Select `Utente`, `Val_Quarto`,`Val_Terzo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result2      = mysqli_query($connection, $query2);
    
    	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
    	       $result3      = mysqli_query($connection, $query3);
    
    	       $query4       = "Select  Utente, Val_Terzo, Val_Quarto, Stato3, Data_Inserimento3, Sit_Conta_Gene3, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result4      = mysqli_query($connection, $query4);
    	       
    	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 4 group by Utente, Interno;";
    	       $result_ric   = mysqli_query($connection, $richieste);
    	       
    	       while($row5 = $result_ric->fetch_object()){
    			  
    			 
           				 $accettazioni[] = [
           				     
    		                "nome"      => $row5->Utente,
    		                "interno"   => $row5->Interno,
    		                "val"       => $row5->Valore_Lettura,
    		                "stato"     => $row5->Stato
    		            ];
    		        }
    	       
    	        $row3 = $result3->fetch_object();
    	        $len = $row3->len;
    	       
    		if (mysqli_num_rows($result1) <= 0)
    	  	{
    	  		echo "Nessun Valore Trovato";
    	  
    	 	} else 
    	 	{
    	 	
    	 		while($row = $result1->fetch_object())
    			{
    		  	  $lettura[] = [
    		                "nome"       => $row->Utente,
    		                "val1"       => $row->Val_Primo,
    		                "val2"       => $row->Val_Secondo,
    		                 "in"        => $row->Internus
    		                
    		                ];
    			}
    	 		
    			 while ($row2 = $result2->fetch_object())
    			 {     
    			  	
    			  	   $part2[] = [
    		                	"nome"       => $row2->Utente,
    		               		"val4"       => $row2->Val_Quarto,
    		               		"val3"       => $row2->Val_Terzo,
    		               		 "in"       => $row2->Internus
    		               		
    		                ];
    			   
    		      }
    		      
    		      while ($row4 = $result4->fetch_object())
    			 {     
    			       $nextv = 0;
    			       if($row4->Val_Quarto != null)
    			       {
    			           $nextv =  $row4->Val_Quarto;
    			       }
    			  	   $display[] = [
    		                	"nome"        => $row4->Utente,
    		               		"cur"         => $row4->Val_Terzo,
    		               		"nextv"        => $nextv,
    		               		 "statos"     => $row4->Stato3,
    		               		 "data_"      => explode("-",	$row4->Data_Inserimento3)[2].'-'.explode("-",	$row4->Data_Inserimento3)[1].'-'.explode("-",	$row4->Data_Inserimento3)[0],
    		               		 "lg"         => $row4->Sit_Conta_Gene3,
    		               		  "in"        => $row4->Internus
    		           ];
    		           
    			   
    		     }   
    		         
    		        $data = array();
    		        $data['p1'] = $lettura;
    			    $data['p2'] = $part2;
    			    $data['p3'] = $display;
    		        $data['accettazioni'] = $accettazioni;
    		        
    		        echo json_encode($data, JSON_PRETTY_PRINT);
    		  
    	         }	
    	  
    	}
    	  else if( $valoreLet == 4)
    	  {
    	       
    	       $correct = $anno - 1;
    	       $following = $anno + 1;
    	       
    	       $query        = "Select `Utente`,`Val_Primo`,`Val_Secondo`, `Val_Terzo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result1      = mysqli_query($connection, $query);
    	       
    	       $query2       = "Select `Utente`, `Val_Quarto`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result2      = mysqli_query($connection, $query2);
    
    	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
    	       $result3      = mysqli_query($connection, $query3);
    
    
               $query4       = "Select  Utente, Val_Quarto, Stato4, Data_Inserimento4, Sit_Conta_Gene4, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result4      = mysqli_query($connection, $query4);
    	 
    	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$following' and Trimestre = 1 group by Utente, Interno;";
    	       $result_ric   = mysqli_query($connection, $richieste);
    	       
    	       $richiesteNext    = "Select `Utente`,`Val_Primo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$following' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus;";
    	       $result_ricNext   = mysqli_query($connection, $richiesteNext);
    	       
    	       while($row5 = $result_ric->fetch_object()){
    			  
    			 
           				 $accettazioni[] = [
           				     
    		                "nome"      => $row5->Utente,
    		                "interno"   => $row5->Interno,
    		                "val"       => $row5->Valore_Lettura,
    		                "stato"     => $row5->Stato
    		            ];
    		        }
    		        
    		  while($nexts = $result_ricNext->fetch_object()){
    			       $nextv = 0;
    			       if($nexts->Val_Primo != null)
    			       {
    			           $nextv =  $nexts->Val_Primo;
    			       }
    			 
           				 $next[] = [
           				     
    		                "nome"      => $nexts->Utente,
    		                "interno"   => $nexts->Internus,
    		                "val"       => $nextv
    		            ];
    		        }
    	    
    	        $row3 = $result3->fetch_object();
    	        $len = $row3->len;
    	       
    		if (mysqli_num_rows($result1) <= 0)
    	  	{
    	  		echo "Nessun Valore Trovato";
    	  
    	 	} else 
    	 	{
    	 	
    	 		while($row = $result1->fetch_object())
    			{
    		  	  $lettura[] = [
    		                "nome"       => $row->Utente,
    		                "val1"       => $row->Val_Primo,
    		                "val2"       => $row->Val_Secondo,
    		                "val3"       => $row->Val_Terzo,
    		                "in"         => $row->Internus
    		                
    		                ];
    			}
    	 		
    			 while ($row2 = $result2->fetch_object())
    			 {     
    			  	
    			  	   $part2[] = [
    		                	"nome"       => $row2->Utente,
    		                	"in"         => $row2->Internus,
    		               		"val4"       => $row2->Val_Quarto
    		               		
    		                ];
    			   
    		     }
    		      while ($row4 = $result4->fetch_object())
    			 {     
    			     
    			  	   $display[] = [
    		                	"nome"        => $row4->Utente,
    		               		"cur"         => $row4->Val_Quarto,
    		               		 "statos"     => $row4->Stato4,
    		               		 "data_"      => explode("-",	$row4->Data_Inserimento4)[2].'-'.explode("-",	$row4->Data_Inserimento4)[1].'-'.explode("-",	$row4->Data_Inserimento4)[0],
    		               		 "lg"         => $row4->Sit_Conta_Gene4,
    		               		 "in"         => $row4->Internus
    		           ];
    		     }  
    		         
    		        $data = array();
    		        $data['p1'] = $lettura;
    			    $data['p2'] = $part2;
    			    $data['p3'] = $display;
    			    $data['accettazioni'] = $accettazioni;
    			    $data['nextM']         = $next;
    			    
    		            
    		        echo json_encode($data, JSON_PRETTY_PRINT);
    		  
    	         }	
    	  
    	}
    
	 }
      else
      {
    
        //echo "PERIOD: ".$fatturaPrecedente;
        $correct = $anno - 1;
        if($fatturaPrecedente == "men")
        {
        
                   $lastY       = "Select  * from  miteamx1_players.Letture_Acqua_Mensili, Utenze where ID = '$condo' and  Anno = $correct and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus  order by id_user+0;";
    	           $resultLY      = mysqli_query($connection, $lastY);
    	           
    	           
    	          
    	           	while($row = mysqli_fetch_array($resultLY)){
    			       $lastYearReadings[] = $row;
    		        }
    		        
    		       
    		       $currentY      = "Select  * from  miteamx1_players.Letture_Acqua_Mensili, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus  order by id_user+0;";
    	           $resultCY      = mysqli_query($connection, $currentY);
    	           
    	           
    	           $following = $anno + 1;
    	           $richiesteNext    = "Select `Utente`,`Val_Primo`, Internus from  miteamx1_players.Letture_Acqua_Mensili, Utenze where ID = '$condo' and  Anno = '$following' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	   $result_ricNext   = mysqli_query($connection, $richiesteNext);
                   while($nexts = $result_ricNext->fetch_object()){
            			       $nextv = 0;
            			       if($nexts->Val_Primo != null)
            			       {
            			           $nextv =  $nexts->Val_Primo;
            			       }
            			 
                   				 $next[] = [
                   				     
            		                "nome"      => $nexts->Utente,
            		                "interno"   => $nexts->Internus,
            		                "val"       => $nextv
            		            ];
            	    }
            	    
                   while($row2 = mysqli_fetch_assoc($resultCY)){
    			  
    			 
           				 $CurrentYearReadings[] = $row2;
    		        }  
    		        
    		       
    		       if($valoreLet == 12)
    		       {
    		            $periodo = 1;
    		            $annoSuc = $anno + 1;
        		        $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$annoSuc' and Trimestre = '$periodo' group by Utente, Interno;";
        	            $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
    		       else
    		       {
    		           $periodo = $valoreLet + 1;
    		           $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = '$periodo' group by Utente, Interno;";
        	           $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
 
    		        
    		        
    		      //echo "COUNT(): ".count($lastYearReadings);  
    		      $data = array();
    	          $data['p1'] = $lastYearReadings;
    			  $data['p3'] = $CurrentYearReadings; 
    		      $data['accettazioni'] = $accettazioni; 
    		      $data['nextM']        = $next;
    		      echo json_encode($data, JSON_PRETTY_PRINT);
        
        }
        else if($fatturaPrecedente == "bim")
        {
                   $lastY       = "Select  * from  miteamx1_players.Letture_Gas, Utenze where ID = '$condo' and  Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
    	           $resultLY      = mysqli_query($connection, $lastY);
    	           
    	           	while($row = mysqli_fetch_assoc($resultLY)){
    			  
    			 
           				 $lastYearReadings[] = $row;
    		        }
    		        
    		        
    		       $currentY       = "Select  * from  miteamx1_players.Letture_Gas, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0 ;";
    	           $resultCY      = mysqli_query($connection, $currentY);
                   while($row2 = mysqli_fetch_assoc($resultCY)){
    			  
    			 
           				 $CurrentYearReadings[] = $row2;
    		        }  
    		        
    		       
    		       if($valoreLet == 6)
    		       {
    		            $periodo = 1;
    		            $annoSuc = $anno + 1;
        		        $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$annoSuc' and Trimestre = '$periodo' group by Utente, Interno;";
        	            $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
    		       else
    		       {
    		           $periodo = $valoreLet + 1;
    		           $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = '$periodo' group by Utente, Interno;";
        	           $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
 
    		        
    	           $following = $anno + 1;
    	           $richiesteNext    = "Select `Utente`,`Val_Primo`, Internus from  miteamx1_players.Letture_Gas, Utenze where ID = '$condo' and  Anno = '$following' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	   $result_ricNext   = mysqli_query($connection, $richiesteNext);
                   while($nexts = $result_ricNext->fetch_object()){
            			       $nextv = 0;
            			       if($nexts->Val_Primo != null)
            			       {
            			           $nextv =  $nexts->Val_Primo;
            			       }
            			 
                   				 $next[] = [
                   				     
            		                "nome"      => $nexts->Utente,
            		                "interno"   => $nexts->Internus,
            		                "val"       => $nextv
            		            ];
            	    }
    		        
    		        
    		      $data = array();
    	          $data['p1'] = $lastYearReadings;
    			  $data['p3'] = $CurrentYearReadings; 
    		      $data['accettazioni'] = $accettazioni;
    		      $data['nextM'] = $next; 
    		      echo json_encode($data, JSON_PRETTY_PRINT);
        }
        else if($fatturaPrecedente == "trim")
        {
              	  if( $valoreLet == 1)
            	  {
            	     
            	       $correct = $anno - 1;
            	       
            	       $query        = "Select * from  miteamx1_players.Letture_Acqua,Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0";
            	       $result1      = mysqli_query($connection, $query);
            	       
            	       $query4       = "Select  Utente, Val_Primo, Val_Secondo, Stato, Data_Inserimento, Sit_Conta_Gene, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result4      = mysqli_query($connection, $query4);
            	       
            	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 2 group by Utente, Interno ;";
            	       $result_ric   = mysqli_query($connection, $richieste);
            	       
            	       
            	       while($row5 = $result_ric->fetch_object()){
            			  
            			 
                   				 $accettazioni[] = [
                   				     
            		                "nome"      => $row5->Utente,
            		                "interno"   => $row5->Interno,
            		                "val"       => $row5->Valore_Lettura,
            		                "stato"     => $row5->Stato
            		            ];
            		        }
            	   	
            			  while($row = $result1->fetch_object()){
            			  
            			  	
                   				 $lettura[] = [
            		                "nome"       => $row->Utente,
            		                "val1"       => $row->Val_Primo,
            		                "val2"       => $row->Val_Secondo,
            		                "val3"       => $row->Val_Terzo,
            		                "val4"       => $row->Val_Quarto,
            		                "in"         => $row->Internus,
            		                "Stato4"     => $row->Stato4
            		               
            		            ];
            		        }
            		        
            		        while($row4 = $result4->fetch_object()){
            			  
            			 
                   				 $display[] = [
            		                "nome"       => $row4->Utente,
            		                "cur"        => $row4->Val_Primo,
            		                "nextv"      => $row4->Val_Secondo,
            		                "statos"     => $row4->Stato,
            		                "data_"      => explode("-",	$row4->Data_Inserimento)[2].'-'.explode("-",	$row4->Data_Inserimento)[1].'-'.explode("-",	$row4->Data_Inserimento)[0],
            		                "lg"         => $row4->Sit_Conta_Gene,
            		                "in"         => $row4->Internus
            		                
            		               
            		            ];
            		        }
            		         
            		        $data = array();
            		        $data['p1'] = $lettura;
            			    $data['p3'] = $display; 
            		        $data['accettazioni'] = $accettazioni; 
            		      echo json_encode($data, JSON_PRETTY_PRINT);
            	         	
            	  
            	 
            	}
            	  else if( $valoreLet == 2)
            	  {
            	       
            	       $correct = $anno - 1;
            	       $query        = "Select `Utente`,`Val_Primo`, Internus  from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo'  and Status = 'ACTIVE' and Anno = '$anno' group by Utente, Internus order by id_user+0;";
            	       $result1      = mysqli_query($connection, $query);
            	       
            	       $query2       = "Select `Utente`, `Val_Quarto`,`Val_Terzo`,`Val_Secondo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result2      = mysqli_query($connection, $query2);
            
            	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
            	       $result3      = mysqli_query($connection, $query3);
            	       
            	       $query4       = "Select  Utente, Val_Secondo, Val_Terzo, Stato2, Data_Inserimento2, Sit_Conta_Gene2, Internus, Stato from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result4      = mysqli_query($connection, $query4);
            
            	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 3 group by Utente, Interno;";
            	       $result_ric   = mysqli_query($connection, $richieste);
            	       
            	       while($row5 = $result_ric->fetch_object()){
            			  
            			 
                   				 $accettazioni[] = [
                   				     
            		                "nome"      => $row5->Utente,
            		                "interno"   => $row5->Interno,
            		                "val"       => $row5->Valore_Lettura,
            		                "stato"     => $row5->Stato
            		            ];
            		   }
            		        
            	        $row3 = $result3->fetch_object();
            	        $len = $row3->len;
            	       
            		if (mysqli_num_rows($result1) <= 0)
            	  	{
            	  		echo "Nessun Valore Trovato";
            	  
            	 	} else 
            	 	{
            	 	
            	 	
            	 		while($row = $result1->fetch_object())
            			{
            		  	  $lettura[] = [
            		                "nome"       => $row->Utente,
            		                "val1"       => $row->Val_Primo,
            		                 "in"        => $row->Internus
            		                ];
            			}
            	 		while ($row2 = $result2->fetch_object())
            			{     
            			  	
            			  	 
            			  	
            			  	   $part2[] = [
            		                	"nome"       => $row2->Utente,
            		               		"val4"       => $row2->Val_Quarto,
            		               		"val3"       => $row2->Val_Terzo,
            		               		"val2"       => $row2->Val_Secondo,
            		               		 "in"        => $row2->Internus
            		                ];
            			   
            		     }
            		    while ($row4 = $result4->fetch_object())
            			{     
            			       $nextv = 0;
            			       if($row4->Val_Terzo != null)
            			       {
            			           $nextv =  $row4->Val_Terzo;
            			       }
            			  	   $display[] = [
            		                	"nome"       => $row4->Utente,
            		               		"cur"        => $row4->Val_Secondo,
            		               		"nextv"       => $nextv,
            		               		"statos"     => $row4->Stato2,
            		               		"data_"      => explode("-",	$row4->Data_Inserimento2)[2].'-'.explode("-",	$row4->Data_Inserimento2)[1].'-'.explode("-",	$row4->Data_Inserimento2)[0],
            		               		"lg"         => $row4->Sit_Conta_Gene2,
            		               		 "in"        => $row4->Internus,
            		               		 "sp"        => $row4->Stato
            		           ];
            		           
            			   
            		     }     
            		         
            		        $data = array();
            		        $data['p1'] = $lettura;
            			    $data['p2'] = $part2;
            		        $data['p3'] = $display;    
            		        $data['accettazioni'] = $accettazioni;
            		        
            		        echo json_encode($data, JSON_PRETTY_PRINT);
            		         
            	  		
            	
            	         }	
            	  
            	 
            	}
            	  else if( $valoreLet == 3)
            	  {
            	       
            	       $correct = $anno - 1;
            	       
            	       $query        = "Select `Utente`,`Val_Primo`,`Val_Secondo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result1      = mysqli_query($connection, $query);
            	       
            	       $query2       = "Select `Utente`, `Val_Quarto`,`Val_Terzo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result2      = mysqli_query($connection, $query2);
            
            	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
            	       $result3      = mysqli_query($connection, $query3);
            
            	       $query4       = "Select  Utente, Val_Terzo, Val_Quarto, Stato3, Data_Inserimento3, Sit_Conta_Gene3, Internus, Stato2 from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result4      = mysqli_query($connection, $query4);
            	       
            	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = 4 group by Utente, Interno;";
            	       $result_ric   = mysqli_query($connection, $richieste);
            	       
            	       while($row5 = $result_ric->fetch_object()){
            			  
            			 
                   				 $accettazioni[] = [
                   				     
            		                "nome"      => $row5->Utente,
            		                "interno"   => $row5->Interno,
            		                "val"       => $row5->Valore_Lettura,
            		                "stato"     => $row5->Stato
            		            ];
            		        }
            	       
            	        $row3 = $result3->fetch_object();
            	        $len = $row3->len;
            	       
            		if (mysqli_num_rows($result1) <= 0)
            	  	{
            	  		echo "Nessun Valore Trovato";
            	  
            	 	} else 
            	 	{
            	 	
            	 		while($row = $result1->fetch_object())
            			{
            		  	  $lettura[] = [
            		                "nome"       => $row->Utente,
            		                "val1"       => $row->Val_Primo,
            		                "val2"       => $row->Val_Secondo,
            		                 "in"        => $row->Internus
            		                
            		                ];
            			}
            	 		
            			 while ($row2 = $result2->fetch_object())
            			 {     
            			  	
            			  	   $part2[] = [
            		                	"nome"       => $row2->Utente,
            		               		"val4"       => $row2->Val_Quarto,
            		               		"val3"       => $row2->Val_Terzo,
            		               		 "in"       => $row2->Internus
            		               		
            		                ];
            			   
            		      }
            		      
            		      while ($row4 = $result4->fetch_object())
            			 {     
            			       $nextv = 0;
            			       if($row4->Val_Quarto != null)
            			       {
            			           $nextv =  $row4->Val_Quarto;
            			       }
            			  	   $display[] = [
            		                	"nome"        => $row4->Utente,
            		               		"cur"         => $row4->Val_Terzo,
            		               		"nextv"        => $nextv,
            		               		 "statos"     => $row4->Stato3,
            		               		 "data_"      => explode("-",	$row4->Data_Inserimento3)[2].'-'.explode("-",	$row4->Data_Inserimento3)[1].'-'.explode("-",	$row4->Data_Inserimento3)[0],
            		               		 "lg"         => $row4->Sit_Conta_Gene3,
            		               		  "in"        => $row4->Internus,
            		               		  "sp"        => $row4->Stato2
            		           ];
            		           
            			   
            		     }   
            		         
            		        $data = array();
            		        $data['p1'] = $lettura;
            			    $data['p2'] = $part2;
            			    $data['p3'] = $display;
            		        $data['accettazioni'] = $accettazioni;
            		        
            		        echo json_encode($data, JSON_PRETTY_PRINT);
            		  
            	         }	
            	  
            	}
            	  else if( $valoreLet == 4)
            	  {
            	       
            	       $correct = $anno - 1;
            	       $following = $anno + 1;
            	       
            	       $query        = "Select `Utente`,`Val_Primo`,`Val_Secondo`, `Val_Terzo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result1      = mysqli_query($connection, $query);
            	       
            	       $query2       = "Select `Utente`, `Val_Quarto`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and Anno = '$correct' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result2      = mysqli_query($connection, $query2);
            
            	       $query3       = "Select  count(*) as len from  miteamx1_players.Utenze where ID_Condominio = '$condo';";
            	       $result3      = mysqli_query($connection, $query3);
            
            
                       $query4       = "Select  Utente, Val_Quarto, Stato4, Data_Inserimento4, Sit_Conta_Gene4, Internus, Stato3 from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result4      = mysqli_query($connection, $query4);
            	 
            	       $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$following' and Trimestre = 1 group by Utente, Interno;";
            	       $result_ric   = mysqli_query($connection, $richieste);
            	       
            	       $richiesteNext    = "Select `Utente`,`Val_Primo`, Internus from  miteamx1_players.Letture_Acqua, Utenze where ID = '$condo' and  Anno = '$following' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	       $result_ricNext   = mysqli_query($connection, $richiesteNext);
            	       
            	       while($row5 = $result_ric->fetch_object()){
            			  
            			 
                   				 $accettazioni[] = [
                   				     
            		                "nome"      => $row5->Utente,
            		                "interno"   => $row5->Interno,
            		                "val"       => $row5->Valore_Lettura,
            		                "stato"     => $row5->Stato
            		            ];
            		        }
            		        
            		  while($nexts = $result_ricNext->fetch_object()){
            			       $nextv = 0;
            			       if($nexts->Val_Primo != null)
            			       {
            			           $nextv =  $nexts->Val_Primo;
            			       }
            			 
                   				 $next[] = [
                   				     
            		                "nome"      => $nexts->Utente,
            		                "interno"   => $nexts->Internus,
            		                "val"       => $nextv
            		            ];
            		        }
            	    
            	        $row3 = $result3->fetch_object();
            	        $len = $row3->len;
            	       
            		if (mysqli_num_rows($result1) <= 0)
            	  	{
            	  		echo "Nessun Valore Trovato";
            	  
            	 	} else 
            	 	{
            	 	
            	 		while($row = $result1->fetch_object())
            			{
            		  	  $lettura[] = [
            		                "nome"       => $row->Utente,
            		                "val1"       => $row->Val_Primo,
            		                "val2"       => $row->Val_Secondo,
            		                "val3"       => $row->Val_Terzo,
            		                "in"         => $row->Internus
            		                
            		                ];
            			}
            	 		
            			 while ($row2 = $result2->fetch_object())
            			 {     
            			  	
            			  	   $part2[] = [
            		                	"nome"       => $row2->Utente,
            		                	"in"         => $row2->Internus,
            		               		"val4"       => $row2->Val_Quarto
            		               		
            		                ];
            			   
            		     }
            		      while ($row4 = $result4->fetch_object())
            			 {     
            			     
            			  	   $display[] = [
            		                	"nome"        => $row4->Utente,
            		               		"cur"         => $row4->Val_Quarto,
            		               		 "statos"     => $row4->Stato4,
            		               		 "data_"      => explode("-",	$row4->Data_Inserimento4)[2].'-'.explode("-",	$row4->Data_Inserimento4)[1].'-'.explode("-",	$row4->Data_Inserimento4)[0],
            		               		 "lg"         => $row4->Sit_Conta_Gene4,
            		               		 "in"         => $row4->Internus,
            		               		 "sp"        => $row4->Stato3
            		           ];
            		     }  
            		         
            		        $data = array();
            		        $data['p1'] = $lettura;
            			    $data['p2'] = $part2;
            			    $data['p3'] = $display;
            			    $data['accettazioni'] = $accettazioni;
            			    $data['nextM']         = $next;
            			    
            		            
            		        echo json_encode($data, JSON_PRETTY_PRINT);
            		  
            	         }	
            	  
            	}
        }
        else if($fatturaPrecedente == "sem")
        {
            
                  
                   $lastY       = "Select  * from  miteamx1_players.Letture_Acqua_Semestrali, Utenze where ID = '$condo' and  Anno = $correct and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus  order by id_user+0;";
    	           $resultLY      = mysqli_query($connection, $lastY);
    	           
    	           
    	          
    	           	while($row = mysqli_fetch_array($resultLY)){
    			       $lastYearReadings[] = $row;
    		        }
    		        
    		       
    		       $currentY      = "Select  * from  miteamx1_players.Letture_Acqua_Semestrali, Utenze where ID = '$condo' and  Anno = '$anno' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus  order by id_user+0;";
    	           $resultCY      = mysqli_query($connection, $currentY);
                   while($row2 = mysqli_fetch_assoc($resultCY)){
    			  
    			 
           				 $CurrentYearReadings[] = $row2;
    		        }  
    		        
    		       
    		       if($valoreLet == 2)
    		       {
    		            $periodo = 1;
    		            $annoSuc = $anno + 1;
        		        $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$annoSuc' and Trimestre = '$periodo' group by Utente, Interno;";
        	            $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
    		       else
    		       {
    		           $periodo = $valoreLet + 1;
    		           $richieste    = "Select * from  miteamx1_players.Richieste_Accettazioni where ID_Condominio = '$condo' and  Anno = '$anno' and Trimestre = '$periodo' group by Utente, Interno;";
        	           $result_ric   = mysqli_query($connection, $richieste);
        	           while($row5 = $result_ric->fetch_object()){
        			         $accettazioni[] = [
               				     
        		                "nome"      => $row5->Utente,
        		                "interno"   => $row5->Interno,
        		                "val"       => $row5->Valore_Lettura,
        		                "stato"     => $row5->Stato
        		            ];
        	           } 
    		       }
 
    	           $following = $anno + 1;
    	           $richiesteNext    = "Select `Utente`,`Val_Primo`, Internus from  miteamx1_players.Letture_Acqua_Semestrali, Utenze where ID = '$condo' and  Anno = '$following' and ID_Condominio = ID and Status = 'ACTIVE' and concat(Nome, ' ', Cognome) = Utente group by Utente, Internus order by id_user+0;";
            	   $result_ricNext   = mysqli_query($connection, $richiesteNext);
                   while($nexts = $result_ricNext->fetch_object()){
            			       $nextv = 0;
            			       if($nexts->Val_Primo != null)
            			       {
            			           $nextv =  $nexts->Val_Primo;
            			       }
            			 
                   				 $next[] = [
                   				     
            		                "nome"      => $nexts->Utente,
            		                "interno"   => $nexts->Internus,
            		                "val"       => $nextv
            		            ];
            	    }
    		 
    		      $data = array();
    	          $data['p1'] = $lastYearReadings;
    			  $data['p3'] = $CurrentYearReadings; 
    		      $data['accettazioni'] = $accettazioni; 
    		      $data['nextM'] = $next; 
    		      echo json_encode($data, JSON_PRETTY_PRINT);
        }
        
        
     }
	  
	  
	  
?>