<?php 
	class ContratoServicio extends ActiveRecord{
		public function getContratoServicio($page,$ppage=20){
			$cols= "idContratoServicio,idServicio,idAuto,fecha";
			$join= "INNER JOIN Servicio ON us idServicio= idServicio";
			$join2 = "INNER JOIN Auto ON us idAuto= idAuto";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idContratoServicio desc');
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>