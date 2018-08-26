<?php
class Product{
	private $db;
	public function __construct(){
		$this->db=Db::connect();
	}

	//function to add product
	public function addProduct($prodName, $prodImg, $prodRate,$prodCat){
		//escape string to prevent SQL injection
		$prodName=$this->db->real_escape_string($prodName);
		$prodImg=$this->db->real_escape_string($prodImg);
		$prodRate=$this->db->real_escape_string($prodRate);
		$prodCat=$this->db->real_escape_string($prodCat);

		//prepare statement to reduce parsing time
		$query="INSERT INTO product (prodName, prodImg, prodRate, prodCat) VALUES (?,?,?,?)";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ssds',$prodName,$prodImg,$prodRate,$prodCat);
		$result=$stmt->execute();

		if($result){
			return true;
		}else{
			return false;
		}
	}

	//function to get details of a single product
	public function productDetails($pid){
		$pid=$this->db->real_escape_string($pid);

		//prepare statement to reduce parsing time
		$query="SELECT prodId, prodName, prodImg, prodRate, prodCat FROM product WHERE prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i', $pid);
		$stmt->execute();
		$stmt->bind_result($prodId, $prodName, $prodImg, $prodRate, $prodCat);

		$details=false;

		while ($stmt->fetch()) {
			$details= array('prodId'=> $prodId,'prodName' => $prodName ,'prodImg' => $prodImg, 'prodRate' => $prodRate, 'prodCat' => $prodCat);
		}
		return $details;	
	}

	//function to access all products in the databse
	public function listProduct(){

		$query="SELECT prodId, prodName, prodImg, prodRate, prodCat FROM product ORDER BY prodId desc";
		$stmt=$this->db->prepare($query);
		$stmt->execute();
		$stmt->bind_result($prodId, $prodName, $prodImg, $prodRate, $prodCat);

		$prodList=false;

		while ($stmt->fetch()) {
			$prodList[]= array('prodId'=> $prodId,'prodName' => $prodName ,'prodImg' => $prodImg, 'prodRate' => $prodRate, 'prodCat' => $prodCat);
		}
		return $prodList;
	}

	//function to edit product
	public function editProduct($pid, $prodName, $prodImg, $prodRate, $prodCat){
		
		$pid=$this->db->real_escape_string($pid);
		$prodName=$this->db->real_escape_string($prodName);
		$prodImg=$this->db->real_escape_string($prodImg);
		$prodRate=$this->db->real_escape_string($prodRate);
		$prodCat=$this->db->real_escape_string($prodCat);


		//prepare statement to reduce parsing time
		$query="UPDATE product SET prodName=?, prodImg=?, prodRate=?, prodCat=? WHERE prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ssisi', $prodName, $prodImg, $prodRate, $prodCat, $pid);
		$result=$stmt->execute();

		if($result){
			return true;
		}else{
			return false;
		}

	}

	//function to delete product
	public function deleteProduct($pid){

		//prepare statement to reduce parsing time
		$query="DELETE FROM product where prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i',$pid);
		$result=$stmt->execute();
		
		if($result){
			return true;
		}else{
			return false;
		}

	}

	//function used for searching/browsing products (subset of a data in the products table)
	public function browseProduct($cat, $key, $sort){

		$cat=$this->db->real_escape_string($cat);
		$key=$this->db->real_escape_string($key);
		$sort=$this->db->real_escape_string($sort);
		

		//prepare statement to reduce parsing time
		$query="SELECT prodId, prodName, prodImg, prodRate, prodCat FROM product where 1 ";

		//category
		if($cat!=""){
			$query.="and prodCat=? ";
		}else{
			$cat=1;
			$query.="and ?";
		}

		//keyword search
		if ($key!=""){
			$key="%".$key."%";
			$query.=" and prodName LIKE ? ";
		}else{
			$key=1;
			$query.=" and ?";
		}

		//sorting order
		if ($sort!="") {
			if($sort=="nameA"){
				$query.=" ORDER BY prodName";
			}elseif ($sort=="nameZ") {
				$query.=" ORDER BY prodName desc";
			}elseif ($sort=="dateO") {
				$query.=" ORDER BY prodId asc";
			}elseif ($sort=="dateN") {
				$query.=" ORDER BY prodId desc";
			}
		}else{
			$query.=" ORDER BY prodId desc";
		}

		//prepare statement to reduce parsing time
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ss', $cat, $key);
		$result=$stmt->execute();
		$stmt->bind_result($prodId, $prodName, $prodImg, $prodRate, $prodCat);

		$prodFilter=false;

		if($result){
			while ($stmt->fetch()) {
				$prodFilter[]= array('prodId'=> $prodId,'prodName' => $prodName ,'prodImg' => $prodImg, 'prodRate' => $prodRate, 'prodCat' => $prodCat);
			}	
		}

		return $prodFilter;
	}

	//function to access products added to 'favorites' list by user
	public function getList($pid){

		//prepare statement to reduce parsing time
		$query="SELECT prodName, prodImg, prodRate, prodCat FROM product where prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i',$pid);
		$result=$stmt->execute();
		$stmt->bind_result($prodName, $prodImg, $prodRate, $prodCat);

		$prodView=false;
		
		if($result){
			while ($stmt->fetch()) {
				$prodView[]= array('prodName' => $prodName ,'prodImg' => $prodImg, 'prodRate' => $prodRate, 'prodCat' => $prodCat);
			}	
		}
		
		return $prodView;
	}
}
?>