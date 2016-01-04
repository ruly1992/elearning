<?php 
	function countKonsultasiKategori($allKonsultasi, $idKategori)
	{	
		$jumlah = 0;
		foreach($allKonsultasi as $k){
			if($k->id_kategori==$idKategori){
				$jumlah = $jumlah+1;
			}
		}
		return $jumlah;
	}


?>