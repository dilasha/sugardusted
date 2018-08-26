<?php
class User{
	private $db;

	public function __construct() {
		//connection to database
		$this->db = Db::connect();

	}

	//function to self register as customer
	public function register($username, $email, $password, $role){

		$username=$this->db->real_escape_string($username);
		$email=$this->db->real_escape_string($email);
		$password=$this->db->real_escape_string($password);
		$role=$this->db->real_escape_string($role);

		$query="INSERT INTO user (username, email, password, role) VALUES (?,?,?,?)";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('sssi',$username,$email,$password,$role);
		$result=$stmt->execute();

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	//function to login
	public function login($email, $password, $role){

		$email=$this->db->real_escape_string($email);
		$password=$this->db->real_escape_string($password);
		$role=$this->db->real_escape_string($role);

		$query="SELECT userId, username, email, password, role FROM user WHERE email=? and password=? and role=?;";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ssi',  $email, $password, $role);
		$stmt->execute();
		$stmt->bind_result($userId, $username, $email, $password, $role);
		while ($stmt->fetch()) {
			$_SESSION['uid']=$userId;
			$_SESSION['user']= $username;
			$_SESSION['role']= $role;
		}

		//echo "<script>alert('".$_SESSION['role'].$_SESSION['user'].$_SESSION['uid']."')</script>";
		if(isset($_SESSION['uid'])){
			if ($_SESSION['role'] == 0) {
				$url="index.php?action=profile";
			}else{
				$url="admin_index.php?action=dashboard";
			}
			echo "<script>window.location='".$url."'</script>";
		}
		return false;
	}

	//function to logout
	public function logout(){
		global $config;
		session_unset();
		session_destroy();
		$url=$config['base_url']."index.php?action=home";
		echo "<script>window.location='".$url."'</script>";
	}

	//function to check if username already exists in the database
	public function availableUsername($usr, $uid){

		$usr=$this->db->real_escape_string($usr);

		$query="SELECT userId FROM user WHERE username=? and userId!=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('si', $usr, $uid);
		$stmt->execute();
		$stmt->store_result();
		$num=$stmt->num_rows;
		$stmt->bind_result($userId);

		return $num;
	}
		
	//function to check if email already exists in the database
	public function availableEmail($eml,$uid){

		$usr=$this->db->real_escape_string($eml);

		$query="SELECT userId FROM user WHERE email=? and userId!=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('si', $eml,$uid);
		$stmt->execute();
		$stmt->store_result();
		$num=$stmt->num_rows;
		$stmt->bind_result($userId);

		return $num;
	}

	//function to reset password
	public function passwordReset($password, $uid){

		$password=$this->db->real_escape_string($password);
		$uid=$this->db->real_escape_string($uid);

		$query="UPDATE user set password=? where userId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('si',$password, $uid);
		$result=$stmt->execute();

		if($result){
			return true;
		}else{
			return false;
		}
	}

	//function to retrieve a user's details
	public function userDetails($uid){

		$uid=$this->db->real_escape_string($uid);

		$query="SELECT userId, username, email, password, role FROM user WHERE userId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i', $uid);
		$stmt->execute();
		$stmt->bind_result($userId, $username, $email, $password, $role);

		$details=false;

		while ($stmt->fetch()) {
			//stored as array
			$details= array("userId" => $userId, "username" => $username, "email" => $email, "password" => $password, "role" => $role);
		}

		return $details;		
	}

	//function to retrieve details of all customers 
	//ADMIN DETAILS ARE NOT ACCESSED
	public function listUser(){

		$query="SELECT * FROM USER where role=0 order by userId";
		$stmt=$this->db->prepare($query);
		$stmt->execute();
		$stmt->bind_result($userId, $username, $email, $password, $role);

		$sn=0;
		$userList=false;
		
		while ($stmt->fetch()) {
			//stored as array
			$userList[]=array("userId" => $userId, "username" => $username, "email" => $email, "password" => $password, "role" => $role);
		}
		return $userList;
	}

	//function to edit/update user details
	public function editUser($uid, $username, $email){

		$uid=$this->db->real_escape_string($uid);
		$username=$this->db->real_escape_string($username);
		$email=$this->db->real_escape_string($email);

		$query="UPDATE  user SET username=?, email=? WHERE userId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('ssi',$username,$email,$uid);
		$result=$stmt->execute();

		if($result){
			return true;
		}else{
			return false;
		}
	}

	//function to delete userdata from table
	public function deleteUser($uid){	

		//prepare statement to reduce parsing time
		$query="DELETE FROM user where userId=?";
		$stmt=$this->db->prepare($query);
		$stmt->bind_param('i',$uid);
		$result=$stmt->execute();
		
		if($result){
			return true;
		}else{
			return false;
		}


	}
}
?>