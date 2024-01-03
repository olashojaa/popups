<?php

namespace App\Console\Commands;

use App\Http\Controllers\AnalyticsController;
use Illuminate\Console\Command;
use App\Models\Popup;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Models\Page;
class CheckPopups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'popups:check {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check  popups on specific pages and fill it in cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current page URL
        $relativeUrl = $this->argument('url');

           // Retrieve the scheduled popup for the current page
           $popupData = Popup::whereJsonContains('scheduled_pages', $relativeUrl)
           ->inRandomOrder() // Display a random popup if multiple match
           ->first();

            // Pass the data to the Cache
            Cache::put('popupData', $popupData, now()->addHours(1));

            if ($popupData) {
                $this->info('Popup displayed:');
                $this->info('Type: ' . $popupData->type);
                $this->info('Content: ' .  $popupData->content);
            } else {
                $this->info('No popup available for this page.');
            }
    }
}
