<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ObservationModel;
use Storage;
use App\Services\ObservationsService;
use Log;

class ObservationsServiceCommand extends Command
{
    public $observationsService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observations:generate {quantity=500 : The quantity of observations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a test file of representative data for use in simulation and testing;';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ObservationsService $observationsService)
    {
        $this->observationsService = $observationsService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $quantity = $this->argument('quantity');
        $file = 'file.csv';
        Storage::put($file, "");
        $path = storage_path("app/$file");

        $this->createFile($quantity, $path);
        $this->insertFile($path);
    }

    private function createFile(int $quantity, string $path)
    {
        $progressBar = $this->output->createProgressBar($quantity);
        $start = microtime(true);
        $progressBar->start();

        $fileOpened = fopen($path, 'w');
        for ($count = 1; $count <= $quantity; $count++) {
            $data = $this->getFakeObservation();
            fwrite($fileOpened, $data);
            $progressBar->advance();
        }
        fclose($fileOpened);

        $progressBar->finish();
        $this->info("\n");
        $this->info('Time to generate file: ' .  (microtime(true) - $start));
    }

    private function insertFile($path)
    {
        $file = file($path);
        $errors = [];
        $progressBar = $this->output->createProgressBar(count($file));
        $start = microtime(true);
        $progressBar->start();
        foreach ($file as $item) {
            $obs = $this->observationsService->validateData([trim(preg_replace('/\s\s+/', ' ', $item))]);
            if($obs != false) {
                $this->observationsService->store($obs);
            }else{
                Log::error($item);
                $errors[] = $item;
            }
            $progressBar->advance();
        }
        $progressBar->finish();
        $this->info("\n");
        $this->info('Errors: ' .  count($errors));
        $this->info('Time to insert file: ' .  (microtime(true) - $start));
    }

    private function getFakeObservation(): string
    {
        $observation = factory(ObservationModel::class)->make()->toArray();
        shuffle($observation);
        return implode('|', $observation) . "\n";
    }
}
