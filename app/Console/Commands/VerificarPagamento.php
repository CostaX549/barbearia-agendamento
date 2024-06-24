<?php

namespace App\Console\Commands;

use App\Jobs\VerificarPagamento as JobsVerificarPagamento;
use Illuminate\Console\Command;

class VerificarPagamento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verificar-pagamento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        JobsVerificarPagamento::dispatch();
    }
}
