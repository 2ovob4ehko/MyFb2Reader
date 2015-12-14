<?
class Reading {
	public $id;
	public $title;
	public $author;
	public $user;
	public $line;
	public $db;

	function __construct($db){
		$this->db=$db;
		$result=$this->db->query("SELECT id FROM reading");
		if(empty($result)){
			$this->db->query("CREATE TABLE reading (
        id int(11) AUTO_INCREMENT,
				title text NOT NULL,
				author text NOT NULL,
				user int(11) NOT NULL,
				line int(11) NOT NULL,
				PRIMARY KEY (id))");
		}
	}
	function getByInf($title,$author,$user){
		if(!empty($title)&&!empty($author)&&!empty($user)) {
			$sql = "SELECT * FROM reading WHERE title='".$title."' AND author='".$author."' AND user='".$user."'";
			return $this->db->query($sql);
		}else return false;
	}
	function update($id,$line){
		if(!empty($id)) {
			$sql = "UPDATE reading SET line='".$line."' WHERE id='".$id."'";
			return $this->db->query($sql);
		}else return false;
	}
	function create($title,$author,$user,$line){
    $sql = "INSERT INTO reading (title,author,user,line) VALUES ('".$title."','".$author."',".$user.",".$line.")";
		if(!$this->db->query($sql)){
			echo $this->db->error;
		}else{
			return true;
		}
	}
}
?>
