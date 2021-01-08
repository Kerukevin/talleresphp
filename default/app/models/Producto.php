<?php 
class Producto extends ActiveRecord{
	public function getProducto ($page,$ppage= 20){
		$cols = "idProducto,nombre, precio,stock";
		//SI tuviese clave foranea seria una nueva variale y un INNER JOIN
		return $this->paginate("page: $page", "per_page: $ppage", 'order: idProducto desc');
	}
	
}

 ?>
