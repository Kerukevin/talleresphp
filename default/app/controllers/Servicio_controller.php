<?php 
Load:: models('Servicio');
class ServicioController extends AppController{
	public function index (	$page=1, $var){
		if($var=='$p'){
			/*settype($var, 'string');
			Flash::Valid($var);
			Flash::Valid("Entro index1");*/
			Flash::Error('Iniciar Sesion');
			Redirect::to("Cliente/login");
			
		}else{

			$se = new Servicio();
			$this->listServicio = $se->getServicio($page);
		}
	}	

	public function create ()
	{
		if(Input::hasPost('Servicio'))
		{
			$us = new Servicio(Input::post('Servicio'));
			if($us->create())
			{
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to('Servicio/index/1/U');
			}else
			{
				Flash::Error('Fallo en la Operacion');
			}

		}
	}

	public function Edit($id)
	{
		
		$us= new Servicio();
		if(Input::hasPost('Servicio'))
		{

			if($us->update(Input::post ('Servicio')))
			{	
				Flash::Valid('Operacion editar exitosa');
				return Redirect::to('Servicio/index/1/U');//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{

			$this -> Servicio = $us-> find ( (int) $id); 
		}
	}
	public function del ($id)
	{
		//$id=4;	
		$us =new Servicio();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Servicio/index/1/U');
	}
	//esto va en contrato servicio como un create
	public function contratar ($id){
		$us= new Servicio();
		$this -> Servicio = $us-> find ( (int) $id); 
	}

}
 ?>
