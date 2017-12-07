<?php

class Database {
/* BEGIN STATE 01 */
	private $db_resource;
	private $last_error = null;
	private $last_result;
/* END STATE 01 */

/* BEGIN STATE 02 */
	public function __construct($host, $login, $password, $db) {
		$this->db_resource = mysqli_connect($host, $login, $password, $db);
		mysqli_set_charset($this->db_resource, "utf8");

		if (!$this->db_resource) {
			$this->last_error = mysqli_connect_error();
		}
	}
/* END STATE 02 */

/* BEGIN STATE 03 */
	public function executeQuery($sql, $data = []) {
		$this->last_error = null;
		$stmt = db_get_prepare_stmt($this->db_resource, $sql, $data);

		if (mysqli_stmt_execute($stmt) && $r = mysqli_stmt_get_result($stmt)) {
			$this->last_result = $r;
			$res = true;
		}
		else {
			$this->last_error = mysqli_error($this->db_resource);
			$res = false;
		}

		return $res;
	}
/* END STATE 03 */

/* BEGIN STATE 04 */
	public function getLastError() {
		return $this->last_error;
	}
/* END STATE 04 */

/* BEGIN STATE 05 */
	public function getResultAsArray() {
		return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
	}
/* END STATE 05 */

/* BEGIN STATE 06 */
	public function getLastId() {
		return mysqli_insert_id($this->db_resource);
	}

	public function getNumRows() {
		return mysqli_num_rows($this->last_result);
	}
/* END STATE 06 */
}