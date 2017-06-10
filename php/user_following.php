<?php
/**
* 
*/

require_once('user_info.php');

class userFollowingClass extends userInfoClass
{
	private $followingListTable = "following_list";
	public $errorMsg = "";

	function checkFollowingList($username , $friendUsername)
	{
		$sql = "SELECT * FROM ".$this->followingListTable." WHERE username = '".$username."' AND friendUsername ='".$friendUsername."'";
		$this->dataConnect();
		$response = $this->conection->query($sql);
		if($response->num_rows==1)
		{
			$this->dataClose();
			return ture;
		}
		else
		{
			$this->dataClose();
			return false;
		}
	}

	function getFollowingList($username)
	{
		$sql = "SELECT friendUsername FROM ".$this->followingListTable." WHERE username = '".$username."'";
		$this->dataConnect();
		$response = $this->conection->query($sql);
		if($response->num_rows>0)
		{
			$rowData=array();
			$cnt=0;
			while ($resData = $response->fetch_assoc())
			{
				$rowData[$cnt] = $resData['friendUsername'] ; 
				$cnt++;
			}
			$this->dataClose();
			return $rowData;
		}
		else
		{
			$this->dataClose();
			return false;
		}
	}
	function getFollowingListHandles($username)
	{
		$sql = "SELECT friendUsername FROM ".$this->followingListTable." WHERE username = '".$username."'";
		$this->dataConnect();
		$response = $this->conection->query($sql);
		if($response->num_rows>0)
		{
			$rowData=array();
			$cnt=0;
			while ($resData = $response->fetch_assoc())
			{
				$friendUsername = $resData['friendUsername'];
				$infoData = $this->getUserInfor($friendUsername);
				$rowData[$cnt] = array('username' => $friendUsername, 'codeforcesuser'=> $infoData['codeforcesuser'], 'uvauser'=> $infoData['uvauser']); 
				$cnt++;
			}
			$this->dataClose();
			return $rowData;
		}
		else
		{
			$this->dataClose();
			return false;
		}
	}

	function addToFollowingList($username , $friendUsername)
	{
		if($this->checkUsername($friendUsername)&& $username!==$friendUsername )
		{
			if($this->checkFollowingList($username,$friendUsername)===false)
			{
				$sql= "INSERT INTO ".$this->followingListTable." (username,friendUsername) VALUES ('".$username."', '".$friendUsername."' ) ";
				//echo $sql;
				$this->dataConnect();
				if($this->conection->query($sql)===true)
				{
					$this->dataClose();
					return ture;
				}
				else
				{
					$this->dataClose();
					$this->errorMsg = $this->errorMsg."Insertion error!;";
					return false;
				}
			}
			else
			{
				$this->errorMsg = $this->errorMsg."Username already in the following list;";
				return false;
			}
		}
		else
		{
			$this->errorMsg = $this->errorMsg."Wrong username;";
			return false;
		}
	}
	function deleteFromFollowingList($username , $friendUsername)
	{
		if($this->checkFollowingList($username,$friendUsername))
		{
			$sql= "DELETE FROM ".$this->followingListTable." WHERE username='".$username."' AND friendUsername ='".$friendUsername."' ";
			//echo $sql;
			$this->dataConnect();
			if($this->conection->query($sql)===true)
			{
				$this->dataClose();
				return ture;
			}
			else
			{
				$this->dataClose();
				$this->errorMsg = $this->errorMsg."Deletion error!;";
				return false;
			}
		}
		else
		{
			$this->errorMsg = $this->errorMsg."Username already deleted from the following list;";
			return false;
		}
	}
}
?>