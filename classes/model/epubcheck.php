<?php defined('SYSPATH') or die('No direct script access.');

interface Model_Epubcheckinterface extends Model {

	protected function add_output($output_content);
	protected function remove_output($id);
	protected function remove_all_outputs($filename);
	protected function list_outputs($filename);
	protected function get_output($id);

} // End of Model_Epubcheck interface
