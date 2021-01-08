<?php 
	class Comparacion extends ActiveRecord{
		public function getComparacion($page,$ppage=20){
			$cols= "idComparacion,fechaDesde,fechaHasta,idPago,idCompra";
			$join= "INNER JOIN Pago ON us idPago= idPago";
			$join2 = "INNER JOIN Compra ON us idCompra= idCompra";
			return $this->paginate(	"page: $page", "per_page: $ppage", 'order: idComparacion desc');
		}
	 	protected function initialize() 
	    {
	        //$this-> validates_email_in("email");
	    }

	}
?>