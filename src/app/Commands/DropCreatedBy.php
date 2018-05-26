<?php

namespace LaravelEnso\Contacts\app\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCreatedBy extends Command
{
    protected $signature = 'enso:contacts:drop-created-by';

    protected $description = 'This command will drop the obsolete `created_by` column from the `contacts` table';

    public function handle()
    {
        if (!Schema::hasColumn('contacts', 'created_by')) {
            $this->info('The `created_by` column was already dropped.');

            return;
        }

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        $this->info('The `created_by` column was successfully dropped.');
    }
}
