<?php

namespace Klarity\LibremsTest\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;

class LibremsTestCommand extends Command
{
    public $signature = 'librems-test';

    public $description = 'My command';

    public function handle(LoggerInterface $log): int
    {
        // read config that your package published
        $table = config('librems.audit_table', 'audits');

        // DB facade (works with the host app’s connection)
        $count = DB::table($table)->count();

        // Use injected helper/service from the container
        $helper = app(\Klarity\LibremsTest\Support\AuditHelper::class);
        $helper->doSomething($count);

        $log->info('librems-test ran', compact('count'));

        $this->info("Rows in {$table}: {$count}");
        return self::SUCCESS;

        $this->comment('All done');

        return self::SUCCESS;
    }

}
