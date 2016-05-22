<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
// use TeamTNT\TNTSearch\TNTSearch;

class IndexMP3s extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'index:mp3s';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Index the mp3s table.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->line('yeah man');
		$indexer = TNTSearch::createIndex('mp3s.index');
	        $indexer->query('SELECT id, name, description, price, FROM mp3s;');
	        $indexer->run();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
