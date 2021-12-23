<?php

namespace Khoirulh1610\Helpers;

class Apiwa{
	public $layanan;
	
	public function layanan() {
        return "diajax";        
    }

	public function start(){
		return self::layanan();
	}
}