<?

class Model
{
	protected $pdo;

	function __construct() {
		$this->pdo = new PDOWrapper();
	}

}

?>
