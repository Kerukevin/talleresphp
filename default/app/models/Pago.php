<?php 
	class Pago extends ActiveRecord{
		public function getPago($page,$ppage=20){
			$cols= "idPago,idCliente,idContraro, totalPago, fecha, idServicio";
			$join= "INNER JOIN Cliente ON us idCLiente= idCliente";
			$join2 = "INNER JOIN Contrato ON us idContrato= idContrato";
			$join3 = "INNER JOIN Servicio ON us idServicio= idServicio";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idPago desc');
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>