<?php 
class Cliente extends ActiveRecord{
	public function getCliente ($page,$ppage= 20){
		$cols = "idCliente,nombreCliente,password,genero,fechaNacimiento,email,rol";
		//SI tuviese clave foranea seria una nueva variale y un INNER JOIN
		return $this->paginate("page: $page", "per_page: $ppage", 'order: idCliente desc');
	}
	 protected function initialize() 
    {
        $this-> validates_email_in("email");
    }	
    //EN LAS CLAVES FORANEAS SE PONE MAS CODIGO VER VIDEO
    public function all()
    {
        return $this->find('order: nombreCliente');
    }
}

 ?>
