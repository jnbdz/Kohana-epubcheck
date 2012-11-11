<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cassandra_Epubcheck implements Model_Epubcheckinterface {

	protected function add_output($filename, $output_content) {
		$created_date;
	}

	protected function remove_output($id) {}

	protected function remove_all_outputs($filename) {}

	protected function list_outputs($filename) {}

        protected function get_output($id) {}

} // End of Model_Cassandra_Epubcheck
