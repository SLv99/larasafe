<?php namespace Hernandes\Larasafe\Commands;

use Hernandes\Larasafe\Parser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class BackupCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a backup of your laravel app.';

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
        $database = new Parser\Database();


        $this->output->writeln("\n\nLaraSafe  - Easy Laravel Backups\n\n");

        $this->info(date('Y-m-d h:i:s')." - Starting DATABASE Backup");
        $this->comment("    ---Please wait a moment...");
        passthru($database->getDumpString() . " > teste.sql");
        $this->info(date('Y-m-d h:i:s')." --- DATABASE Backup Finished ");

        $this->comment("\n\n");

        $this->info(date('Y-m-d h:i:s')." - Starting FILES Backup");
        $this->comment("    ---Please wait a moment...");
        passthru($database->getDumpString() . " > teste.sql");
        $this->info(date('Y-m-d h:i:s')." --- FILES Backup Finished ");


        //$this->info($database->getDumpString());
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
        //    array('example', InputArgument::REQUIRED, 'An example argument.'),
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
         //   array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

} 