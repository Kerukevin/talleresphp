<?php 
Load:: models('ContratoServicio');
class ContratoServicioController extends AppController{
	public function index ($page=1){
		$cl = new ContratoServicio();
		$this->listContratoServicio= $cl->getContratoServicio($page);	
	
	}
	public function contratar ($id)
	{			
		//$cp= new ContratoServicio();
		//$Ncp= new ContratoServicio();
		//$Ncp= $cp->find_by_sql("Select nombre from Servicio INNER JOIN ContratoServicio ON Servicio WHERE Servicio.idServicio = $id");
		if(Input::hasPost('ContratoServicio'))
		{
			$us = new ContratoServicio(Input::post('ContratoServicio'));
			if($us->create())
			{
				//Flash::Valid($us->nombreCliente);
				Flash::Valid('Operacion Exitosa');
				Input::delete();//Limpia los campos del input
				return Redirect::to("ContratoServicio/index/");
			}else
			{
				Flash::Error('Fallo en la Operacion');
				return Redirect::to("ContratoServicio/create/");
			}

		}
	}	
}
?>