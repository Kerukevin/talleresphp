<?php 
class Auto extends ActiveRecord{
	public function getAuto ($page,$ppage= 20){
		$cols = "idAuto,matricula,marca,modelo,anio,color,idCliente";
		//SI tuviese clave foranea seria una nueva variale y un INNER JOIN
		$join = "INNER JOIN Cliente ON us idCliente= idCliente";
		return $this->paginate("page: $page", "per_page: $ppage", 'order: idAuto desc');
	}
	 protected function initialize() 
    {
        //$this-> validates_email_in("email");
    }

        public function all()
    {
        return $this->find('order: matricula');
    }	
    //EN LAS CLAVES FORANEAS SE PONE MAS CODIGO VER VIDEO
}

 ?>
