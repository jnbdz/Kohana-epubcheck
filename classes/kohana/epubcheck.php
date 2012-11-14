<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @author Jean-Nicolas Boulay
 * @version 0.2
 * @description
 */

class Kohana_Epubcheck {

	private static $config;
	private static $output_filename = null;
	private static $filename = null;
	private static $model_epubcheck = null;

	function __construct()
	{
		// Get the configurations, and Model that will used across the methods
		self::$config = Kohana::config('epubcheck');
		self::$model_epubcheck = Model::factory(self::$config->db + '_epubcheck');
	}

	public function Validate($filename, $save=null)
	{
		$save = ($save == null)?self::$config->save:$save;

		self::$filename = $filename;
		self::$output_filename = rtrim(self::$config->output_directory, '/').
					 '/'.
					 sha1($filename.microtime().rand(1000, 9999)).
					 '.xml';

		if(file_exists(self::$filename))
		{
			self::$file_exist = TRUE;

			$to_exec = 'java -jar '.
				   self::$config->epubcheck_jar.
				   ' -out '.
				   self::$config->output_directory.
				   ' '.
				   self::$filename;

			passthru($to_exec, $out_exec);

			if(file_exists(self::$output_filename))
			{
				$output_content = file_get_contents(self::$output_filename);
				unlink(self::$output_filename);
			}
			else
			{
				$no_output_file = __('Epubcheck: There is no output file.');
				Kohana::$log->add(Log::ERROR, $no_output_file);
				throw Exception($no_output_file);
			}
		}
		else
		{
			$no_epub_found = __('Epubcheck: The epub was not found.');
			Kohana::$log->add(Log::ERROR, $no_epub_found);
			throw Exception($no_epub_found);
		}

		if($save) {
			self::$model_epubcheck->add_output($output_content);
		}

		return $output_content;
	}

	public function list_outputs($filename)
	{
		self::$model_epubcheck->list_outputs($filename);
	}

	public function get_output($id)
	{
		self::$model_epubcheck->get_output($id);
	}

	public function remove_all_outputs($filename)
	{
		self::$model_epubcheck->remove_all_outputs($filename);
	}

	public function remove_output($id)
	{
		self::$model_epubcheck->remove_output($id);
	}

} // End of Kohana_Epubcheck
