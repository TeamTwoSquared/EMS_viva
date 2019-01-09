<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateOrReplaceTasksSvpsViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:CreateOrReplaceTasksSvpsView';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or Replace SQL View.';

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
    public function handle()
    {
        \DB::statement("
            CREATE OR REPLACE VIEW tasks_svps 
            AS
            SELECT
                service_provider_keywords.service_provider_id
                service_provider_keywords.keyword
                task_keywords.task_id
            FROM
                service_provider_keywords
                INNER JOIN task_keywords ON service_provider_keywords.keyword = task_keywords.keyword;
        ");
    }
}
