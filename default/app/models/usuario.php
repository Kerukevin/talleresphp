<?php 
class Usuario extends ActiveRecord {
	public function getUsuario ($page,$ppage= 20){
		$cols = "idUsuario,nombre,password,genero,fechaNacimiento,email";
		//SI tuviese clave foranea seria una nueva variale y un INNER JOIN
		return $this->paginate("page: $page", "per_page: $ppage", 'order: idUsuario desc');
	}
	 protected function initialize() 
    {
        $this-> validates_email_in("email");
    }
}

?>
