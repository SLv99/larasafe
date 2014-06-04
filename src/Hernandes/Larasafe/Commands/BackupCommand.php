<?php namespace Hernandes\Larasafe\Commands;

use Hernandes\Larasafe\Parser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Mail;


class BackupCommand extends Command
{


    protected $database;

    protected $files;

    protected $targets;

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
        $this->database = new Parser\Database();
        $this->files = new Parser\Files();
        $this->targets = new Parser\Targets();

        parent::__construct();
    }


    protected function init()
    {
        $this->output->writeln("\n\nLaraSafe  - Easy Laravel Backups\n\n");
        $this->prepareTmp();



    }


    protected function databaseBackup()
    {
        $this->output->writeln("===============================================================");
        $this->info(date('Y-m-d h:i:s')." - DATABASE Backup Started ");
        $this->output->writeln("===============================================================");
        $this->comment("  --> Please wait a moment...");

        if (!file_exists(base_path().'/.larasafe/database')) {
            mkdir(base_path().'/.larasafe/database', 0755, true);
        }

        $this->output->writeln($this->database->getDumpString());

        passthru($this->database->getDumpString() . " > ".base_path()."/.larasafe/database/database_dump.sql");

        $this->output->writeln("===============================================================");
        $this->info(date('Y-m-d h:i:s')." - DATABASE Backup Finished ");
        $this->output->writeln("===============================================================");


    }


    protected function filesBackup()
    {


        $this->output->writeln("===============================================================");
        $this->info(date('Y-m-d h:i:s')." - FILES Backup Started ");
        $this->output->writeln("===============================================================");
        $this->comment(" --> Please wait a moment...");




        foreach($this->files->getSources() as $source) {

            $source_path = base_path().'/'.$source;
            $target_path = base_path().'/.larasafe/files/'.$source;
            $this->output->writeln("Copying: " . $source_path);
            if (file_exists($source_path) and !file_exists($target_path) and is_dir($source_path)) {
                mkdir($target_path, 0775, true);
                sleep(1);
                $source_path = base_path().'/'.$source . '/';
            } else if( is_file(base_path().'/'. $source) ) {
                if(!file_exists(base_path().'/.larasafe/files/'.dirname($source))) {
                    sleep(1);
                    mkdir(base_path().'/.larasafe/files/'.dirname($source), 0775, true);
                }

            }

            exec("rsync -az ". $this->files->getExcludes() . ' ' . $source_path
                . " " .
                base_path()."/.larasafe/files/".$source);
        }
        $this->output->writeln("===============================================================");
        $this->info(date('Y-m-d h:i:s')." --- FILES Backup Finished ");
        $this->output->writeln("===============================================================");
    }


    protected function localBackup()
    {
        $file_name = date('Y-m-d_h-i-s');
        $target = $this->targets->getLocalPath();

        passthru("cd ".base_path()."/.larasafe/ && tar -czf $file_name.tar.gz database files");
        passthru("cd ".base_path()."/.larasafe/ && mv $file_name.tar.gz $target/");

        $backup_email_data = $this->targets->getBackupEmailData();


        if( ! empty($backup_email_data['email'])) {
           
            Mail::send($backup_email_data['view'], array(), function($message) use ($backup_email_data, $file_name, $target)
            {
                $message->subject($backup_email_data['subject']);

                $message->from($backup_email_data['email'], $backup_email_data['from']);

                $message->to($backup_email_data['email']);

                $message->attach($target."/$file_name.tar.gz");
            });
        }
    }

    protected function remoteBackup()
    {
        $file_name  = date('Y-m-d_h-i-s');
        $target     = $this->targets->getRemotePath();
        $connection = $this->targets->getRemoteConnection();
        $sshKeyPath = $this->targets->getSshKeyPath();

        passthru("cd ".base_path()."/.larasafe/ && tar -czf $file_name.tar.gz database files");
        passthru("rsync -avz -e \"ssh -i ".$sshKeyPath."\" ".base_path()."/.larasafe/".$file_name.".tar.gz  ".$connection.":".$target);
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $this->init();

        if ($this->database->isEnabled()) {
            $this->databaseBackup();
        } else {
            $this->output->writeln("===============================================================");
            $this->comment("DATABASE backups are disabled");
            $this->output->writeln("===============================================================");
        }

        if ($this->files->isEnabled()) {
            $this->filesBackup();
        } else {
            $this->output->writeln("===============================================================");
            $this->comment('FILES backups are disabled');
            $this->output->writeln("===============================================================");
        }


        if ($this->targets->localEnabled()) {
            $this->localBackup();
        }

        if ($this->targets->remoteEnabled()) {
            $this->remoteBackup();
        }


        $this->removeTmp();
    }



    protected function prepareTmp()
    {
        $this->comment("Creating Temporary Backup Files\n");

        if(!file_exists(base_path()."/.larasafe")) {
            mkdir(base_path() . '/.larasafe');
        }
    }

    protected function removeTmp()
    {
        $this->comment("\nRemoving Temporary Backup Files\n");
        if(file_exists(base_path()."/.larasafe") && is_dir(base_path()."/.larasafe")) {
            passthru("rm -rf ".base_path() . '/.larasafe');
        }
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