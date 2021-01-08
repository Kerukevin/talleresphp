<?php 
Load:: models('Contrato');
class ContratoController extends AppController{
	public function index ($page=1){
		$cl = new Contrato();
		$this->listContrato= $cl->getContrato($page);	
	
	}
	public function contratar ($id)
	{	
		$date = new Date();		
		$var1= new Contrato();
		$var2= new Contrato();

		$this ->listvar1 = $var1->find_by_sql("Select Servicio.idServicio, Servicio.nombre from Servicio 
			LEFT OUTER JOIN Contrato ON  Servicio.idServicio = Contrato.idServicio Where Servicio.idServicio= '$id' ");
		$this ->listvar2 = $var2->find_by_sql("Select Auto.idAuto, matricula from Auto 
			LEFT OUTER JOIN Contrato ON Auto.idAuto = Contrato.idAuto ");
		/*
		VAN TODAS LAS VALIDACIONES DE COMPRA CONTROLLER  
		*/
		if(Input::hasPost('Contrato'))
		{
			$us = new Contrato(Input::post('Contrato'));
			if($us->fecha>$date || $us->fecha<'1990-01-01'){
				Flash::Error('Error fecha ');
			}else{
				if($us->create())
				{
					//Flash::Valid($us->nombreCliente);
					Flash::Valid('Operacion Exitosa');
					Input::delete();//Limpia los campos del input
					return Redirect::to("Contrato/index/");
				}else
				{
					Flash::Error('Fallo en la Operacion');
					return Redirect::to("Contrato/create/");
				}
			
			

			}
		}
	}
	public function del ($id)
	{
		//$id=4;	
		$us =new Contrato();
		
		if($us-> delete((int) $id ))
		{

			Flash::Valid('Operacion de eliminado exitosa');

		}else
		{
			Flash::Error('Fallo de la operacion eliminar');

		}
		return Redirect::to('Contrato/index/');
	}		
}
?>