<?php

namespace App\Observers;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Use 'Imagick' if your server supports it

class GalleryObserver
{
    /**
     * Handle the Gallery "saving" event.
     * This runs before Create or Update operations commit to the DB.
     */
    public function saving(Gallery $gallery): void
    {
        // 1. Check if the 'image_path' field has changed (new upload)
        if ($gallery->isDirty('image_path') && !empty($gallery->image_path)) {
            
            $originalPath = $gallery->image_path;
            
            // 2. Only process if it is NOT already a webp file
            if (pathinfo($originalPath, PATHINFO_EXTENSION) !== 'webp') {
                
                // Define Disk (Ensure this matches your Filament default disk)
                $disk = Storage::disk('public'); 

                if ($disk->exists($originalPath)) {
                    
                    // 3. Initialize Image Manager
                    $manager = new ImageManager(new Driver());
                    
                    // 4. Read the uploaded image file
                    $image = $manager->read($disk->get($originalPath));
                    
                    // 5. Encode to WebP (Quality: 80% is a great balance)
                    $encoded = $image->toWebp(80);
                    
                    // 6. Generate New Path (Swap extension to .webp)
                    $newPath = preg_replace('/\.[^.]+$/', '.webp', $originalPath);
                    
                    // 7. Save the new WebP file to storage
                    $disk->put($newPath, (string) $encoded);
                    
                    // 8. Delete the original large file to save space
                    $disk->delete($originalPath);
                    
                    // 9. Update the model's attribute to the new path
                    $gallery->image_path = $newPath;
                }
            }
        }
    }
}