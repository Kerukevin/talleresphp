<?php 
Load:: models('Producto');
class ProductoController extends AppController{
	public function index (	$page=1, $var){
		if($var=='$p'){
			/*settype($var, 'string');
			Flash::Valid($var);
			Flash::Valid("Entro index1");*/
			Flash::Error('Iniciar Sesion');
			Redirect::to("Cliente/login");
			
		}else{

			$se = new Producto();
			$this->listProducto = $se->getProducto($page);
		}

	}	

	public function create ()
	{
		if(Input::hasPost('Producto'))
		{
			$us = new Producto(Input::post('Producto'));
			if($us->create())
			{
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to('Producto/index/1/U');
			}else
			{
				Flash::Error('Fallo en la Operacion');
			}

		}
	}

	public function Edit($id)
	{
		
		$us= new Producto();
		if(Input::hasPost('Producto'))
		{

			if($us->update(Input::post ('Producto')))
			{	
				Flash::Valid('Operacion editar exitosa');
				return Redirect::to('Producto/index/1/U');//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{

			$this -> Producto = $us-> find ( (int) $id); 
		}
	}
	public function del ($id)
	{
		//$id=4;	
		$us =new Producto();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Producto/index/1/U');
	}
	//esto va en contrato servicio como un create
	public function contratar ($id){
		$us= new Producto();
		$this -> Producto = $us-> find ( (int) $id); 
	}

}
 ?>