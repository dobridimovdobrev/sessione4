<?php

namespace App\Console\Commands;

use App\Models\ImageFile;
use Illuminate\Console\Command;

class UpdateImageUrls extends Command
{
    protected $signature = 'images:update-urls';
    protected $description = 'Aggiorna tutti gli URL delle immagini rimuovendo /public/ dal percorso';

    public function handle()
    {
        $this->info('Inizio aggiornamento URL immagini...');
        
        $images = ImageFile::all();
        $count = 0;
        
        foreach ($images as $image) {
            $oldUrl = $image->url;
            $newUrl = str_replace('/public/storage/', '/storage/', $oldUrl);
            
            if ($oldUrl !== $newUrl) {
                $image->url = $newUrl;
                $image->save();
                $count++;
                
                $this->info("Aggiornato: {$oldUrl} -> {$newUrl}");
            }
        }
        
        $this->info("\nCompletato! {$count} immagini aggiornate.");
    }
}
