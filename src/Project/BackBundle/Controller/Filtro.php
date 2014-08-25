<?php

namespace Project\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;

class Filtro  {

    public $dql;
    public $where;
    public $nombreClase;
    public $em;
    public $query;

    public function __construct($nombreClase,$em)
    {
        $this -> dql ="";
        $this -> where = false;
        $this -> nombreClase = $nombreClase;
        $this -> em = $em;
    }

	public function setDQLInicial() {
		$this -> dql = "SELECT o FROM ProjectUserBundle:".$this ->nombreClase." o ";
	}
	public function setDataTexto($nombreElemento,$elemento) {
		
		if (!(trim($elemento) == "")) {
			if ($this->where == false) {
				$this->dql .= 'WHERE ';
				$this->where = true;
			} else {
				$this->dql .= 'AND ';
			}
			$this->dql .= " o.".$nombreElemento." like :".$nombreElemento." ";
		}
	}
	public function setDataBoolean($nombreElemento,$elemento) {
		
		if ($elemento >=0 ) {
			if ($this->where == false) {
				$this->dql .= 'WHERE ';
				$this->where = true;
			} else {
				$this->dql .= 'AND ';
			}
			$this->dql .= " o.".$nombreElemento." = :".$nombreElemento." ";
		}
	}
	public function setDataObjeto($nombreElemento,$elemento) {
		
		if ($elemento != null) {
			if ($this->where == false) {
				$this->dql .= 'WHERE ';
				$this->where = true;
			} else {
				$this->dql .= 'AND ';
			}
			$this->dql .= " o.".$nombreElemento." = :".$nombreElemento." ";
		}
	}
	public function setQuery(){
		$this->query = $this-> em -> createQuery($this->dql);
	}
	public function getQuery(){
		return $this->query;
	}
	public function setParametroTexto($nombreElemento,$elemento){
		if (!(trim($elemento) == "")) {
		    $this->query -> setParameter($nombreElemento,  '%' . $elemento. '%');
		}
	}
	public function setParametroBoolean($nombreElemento,$elemento){
		if ($elemento>=0) {
		    $this->query -> setParameter($nombreElemento,  $elemento );
		}
	}
	public function setParametroObjeto($nombreElemento,$elemento){
		if ($elemento != null) {
		    $this->query -> setParameter($nombreElemento,  $elemento->getId() );
		}
	}
	public function setDataFecha(){
		/*if (!($data -> getUpdated() == null)) {

			if ($where == false) {
				$dql .= 'WHERE ';
				$where = true;
			} else {
				$dql .= 'AND ';
			}
			$dql .= " o.updated BETWEEN :fechaInicial and :fechaFinal ";*/
			return false;
	}
	public function setOrder(){
		return $this->dql .="  order by o.id DESC ";
	}
	public function getDQL(){
		return $this->dql;
	}
}