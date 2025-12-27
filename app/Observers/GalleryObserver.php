<?php

namespace App\Observers;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Import Log
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryObserver
{
    public function saving(Gallery $gallery): void
    {
        // 1. Check if the image field is new/changed
        if ($gallery->isDirty('image_path') && !empty($gallery->image_path)) {
            
            $originalPath = $gallery->image_path;
            
            // Only process if it's NOT already webp
            if (pathinfo($originalPath, PATHINFO_EXTENSION) !== 'webp') {
                
                $disk = Storage::disk('public');

                // 2. SAFETY CHECK: Ensure file actually exists before touching it
                if ($disk->exists($originalPath)) {
                    
                    try {
                        // 3. Initialize Manager
                        $manager = new ImageManager(new Driver());
                        
                        // 4. Load Image
                        $image = $manager->read($disk->path($originalPath)); // Use absolute path
                        
                        // OPTIONAL: Resize huge images to prevent memory crash
                        // If width > 2000px, scale it down
                        if ($image->width() > 2000) {
                            $image->scale(width: 2000);
                        }

                        // 5. Convert to WebP
                        $encoded = $image->toWebp(80);
                        
                        // 6. Define new path
                        $newPath = preg_replace('/\.[^.]+$/', '.webp', $originalPath);
                        
                        // 7. Save WebP & Delete Original
                        $disk->put($newPath, (string) $encoded);
                        $disk->delete($originalPath);
                        
                        // 8. Update Database Record
                        $gallery->image_path = $newPath;

                    } catch (\Exception $e) {
                        // If conversion fails (memory limit, missing GD), 
                        // Log the error but ALLOW the original PNG/JPG to save.
                        // This prevents the "HTTP 500" crash.
                        Log::error("WebP Conversion Failed: " . $e->getMessage());
                    }
                }
            }
        }
    }
}