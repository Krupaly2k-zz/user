<?php
	if(!empty($_REQUEST["id"])){
		$conn = mysqli_connect("localhost", "root", "", "user");
		
		$condition = "";
		if(!empty($_REQUEST["id"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " id = '" . base64_decode($_REQUEST["id"]) . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "select * from tbl_registered_users " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		if(!empty($user)) {


        $sql = "update table tbl_registered_users set password =".md5($newpass)." where email ='".$user['email']."'";
        
        $db->exec($sql);
        
        $database->closeConnection();
       
