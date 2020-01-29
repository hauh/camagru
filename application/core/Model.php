<?

require_once "SQL.php";

class Model
{
	protected $pdo;

	function __construct()
	{
		$this->pdo = new SQL();
	}

	public function getData() {}
}

?>
