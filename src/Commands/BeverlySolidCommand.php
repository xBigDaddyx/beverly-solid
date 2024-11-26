<?php

namespace Xbigdaddyx\BeverlySolid\Commands;

use Illuminate\Console\Command;

class BeverlySolidCommand extends Command
{
    public $signature = 'beverly-solid';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
