<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mysql_Epubcheck implements Model_Epubcheckinterface {

	protected function add_output($filename, $output_content) {
		$created_date;
		return DB::insert('epubcheck-outputs', array('epubname', 'content', 'created_date'))
					->values(array($filename, $output_content, $created_date))
					->as_object()
					->execute();
	}

	protected function remove_output($id) {
		return DB::delete('epubcheck-outputs')->where('id', '=', $id)
						      ->as_object()
						      ->execute();
	}

	protected function remove_all_outputs($filename) {
		return DB::delete('epubcheck-outputs')->where('epubname', '=', $filename)
						      ->as_object()
						      ->execute();
	}

	protected function list_outputs($filename) {
		return DB::select()->from('epubcheck-outputs')
				   ->where('epubname', '=', $filename)
				   ->as_object()
				   ->execute();
	}

	protected function get_output($id) {
		return DB::select()->from('epubcheck-outputs')
				   ->where('id', '=', $id)
				   ->as_object()
				   ->execute();
	}

} // End of Model_Mysql_Epubcheck
