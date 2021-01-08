<?php 
Load:: models('Auto');
class AutoController extends AppController{
	public function index ($page=1){
		$cl = new Auto();
		$this->listAuto= $cl->getAuto($page);	
	
	}
	public function create ()
	{			
		$var = new Auto();
		/*Aqui se recuperan los datos id y nombre de la base de datos. Y se graban en la
		lista listvar*/
		$this ->listvar = $var->find_by_sql("Select Cliente.idCliente, nombreCliente from Cliente 
			LEFT OUTER JOIN Auto ON Cliente.idCliente = Auto.idCliente "); 
		if(Input::hasPost('Auto'))
		{
			$us = new Auto(Input::post('Auto'));
			if($us->anio<1900 || $us->anio>2020){
				Flash::error("Anio incorrecto");
			}else{
				if($us->create())
				{

					Flash::Valid('Operacion Exitosa');
					Input::delete();//Limpia los campos del input
					return Redirect::to("Auto/index");
				}else
				{
					Flash::Error('Fallo en la Operacion');
				}
			}
			

		}
	}

	public function Edit($id)
	{

		$var = new Compra();
		$this ->listvar = $var->find_by_sql("Select Cliente.idCliente, nombreCliente from Cliente 
		LEFT OUTER JOIN Auto ON Cliente.idCliente = Auto.idCliente ");
		$us= new Auto();

		if(Input::hasPost('Auto'))
		{

			if($us->update(Input::post ('Auto')))
			{	
				Flash::Valid('Operacion editar exitosa');

				return Redirect::to("Auto/index/");//Me envia al index
			}else
			{

				Flash::Error('Error en la operacion Editar');
			}
		}else
		{

			$this -> Auto = $us-> find ( (int) $id); 
		}
		
		
	}
	public function del ($id)
	{
		//$id=4;	
		$us =new Auto();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Auto/index/');
	}
			//$id=5;
		/*settype($id, 'string');
		Flash::Valid($id);*/
}
?>