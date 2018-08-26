<?php
class ProductList{
	private $db;
	public function __construct(){
		$this->db=Db::connect();
	}

	//function to check if product is in user's list
	public function checkList($prodId){
		$userId=$_SESSION['uid'];
		$prodId;
		$query="SELECT prodId FROM list WHERE userId=? and prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ii',$userId,$prodId);
		$result=$stmt->execute();
		//var_dump($result);die;
		$stmt->bind_result($prodId);
		while ($stmt->fetch()) {
			return 1;
		}
		return 0;
	}

	//function to add product to user's list
	public function addToList($prodId, $userId){
		$query="INSERT INTO list (prodId, userId) VALUES (?,?)";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ii',$prodId,$userId);
		$result=$stmt->execute();
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	//function to access details of products in the user's list
	public function viewList(){
		$userId=$_SESSION['uid'];
		$query="SELECT prodId FROM list WHERE userId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i',$userId);
		$result=$stmt->execute();
		$stmt->bind_result($prodId);
		$prodList=false;
		if($result){
			while ($stmt->fetch()) {
				$prodList[]= array('prodId'=> $prodId);
			}
		}
		return $prodList;
	}

	//function to remove product from user's list
	public function remove($pid, $uid){
		$query="DELETE FROM list WHERE userId=? and prodId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ii',$uid,$pid);
		$result=$stmt->execute();
		if($result){
			$url="index.php?action=viewList";
			echo "<script>window.location='".$url."'</script>";
		}
	}
}
?>