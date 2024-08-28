<?php

namespace Entryshop\Admin\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class PublishAssets extends Command
{
    protected $signature = 'admin:publish-assets';

    protected $description = 'Command description';

    public function handle()
    {
        Artisan::call('vendor:publish', [
            '--tag'   => 'admin-assets',
            '--force' => true,
        ]);
    }
}
