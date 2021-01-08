<?php 
	class Contrato extends ActiveRecord{
		public function getContrato($page,$ppage=20){
			$cols= "idContrato,idServicio,idAuto,fecha";
			$join= "INNER JOIN Servicio ON us idServicio= idServicio";
			$join2 = "INNER JOIN Auto ON us idAuto= idAuto";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idContrato desc');
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>