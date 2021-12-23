<?php

namespace Khoirulh1610\Helpers;

class Helper{
	// SpintText
	static function ST($string){    
		$total = substr_count($string,"{");
		if($total>0){
			for ($i=0; $i < $total; $i++) { 
				$awal = strpos($string,"{");
				$startCharCount = strpos($string,"{")+1;
				$firstSubStr = substr($string, $startCharCount, strlen($string));
				$endCharCount = strpos($firstSubStr, "}");        
				if ($endCharCount == 0) {
					$endCharCount = strlen($firstSubStr);
				}
				$hasil1 =  substr($firstSubStr, 0, $endCharCount);
				$rw = explode("|",$hasil1);
				$hasil2 = $hasil1;
				if(count($rw)>0){
					$n = rand(0,count($rw)-1);
					$hasil2 = $rw[$n];
				}
				$string = str_replace("{".$hasil1."}",$hasil2,$string);    
			}
			return trim($string);
		}else {
			return $string;
		}
	}

	// Alih waktu
	static function salam($text)
    {
        $b = time();
        $hour = (Int) date("G",$b);
        $hasil = "";
        if ($hour>=0 && $hour<10)
        {
            $hasil = "Pagi";
        }
        elseif ($hour >=10 && $hour<15)
        {
            $hasil = "Siang";
        }
        elseif ($hour >=15 && $hour<=17)
        {
            $hasil = "Sore";
        }
        else{
            $hasil = "Malam";
        }
        
        $text = str_replace(['Pagi','Siang','Sore','Malam'],$hasil,$text);
        return $text;
        
    }

	
	// Replace data Array
	static function  RA($array,$string){    		
		$cek_tgl_lahir = $array['tanggal_lahir'] ?? '';
		if($cek_tgl_lahir!==''){
			$usia = usia($cek_tgl_lahir);
			$string = str_replace('[usia]',$usia,$string);
		}
		$pjg = substr_count($string,"[");   
		for ($i=0; $i < $pjg ; $i++) { 
			$col1 = strpos($string,"[");
			$col2 = strpos($string,"]");  
			$find = strtolower(substr($string,$col1+1,$col2-$col1-1));
			$relp = substr($string,$col1,$col2-$col1+1);            
			if(isset($array[$find])){				
				$string = str_replace($relp,$array[$find],$string);
			}else{
				$string = str_replace('['.$find.']','',$string);            
			} 
			
		}           
		return self::ST(self::salam($string));
	}
}