<? php

/*
 * capture errors and pass to the logger
 */

class errorHandler {
	private $notices = array();

	function push($message) {
		array_push($notices, $message);
	}

	function getNotices() {
		return $notices;
	}
}
