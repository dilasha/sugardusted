<?php
class Item{
	protected $id;
	protected $quantity;
	protected $details;
	protected $category;

	public function __construct(){
		//connection to dbnot required for this class
	}

//SETTERS

	public function setId($id){
		$this->id=$id;
	}
	public function setQuantity($quantity){
		$this->quantity=$quantity;
	}
	public function setCategory($category){
		$this->category=$category;
	}
	public function setDetails($details){
		$this->details=$details;
	}

//GETTERS

	public function getQuantity(){
		return $this->quantity;
	}
	public function getCategory(){
		return $this->category;
	}
	public function getDetails(){
		return $this->details;
	}
}

?>