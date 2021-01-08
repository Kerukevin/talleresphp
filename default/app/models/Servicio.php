<?php 
class Servicio extends ActiveRecord{
	public function getServicio ($page,$ppage= 20){
		$cols = "idServicio,nombre, precio";
		//SI tuviese clave foranea seria una nueva variale y un INNER JOIN
		return $this->paginate("page: $page", "per_page: $ppage", 'order: idServicio desc');
	}
	
}

 ?>
