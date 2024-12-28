<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        // Generate a random color for the background
        $backgroundColor = imagecolorallocate(imagecreate(500, 500), rand(0, 255), rand(0, 255), rand(0, 255));

        // Create a new image with a random background color
        $image = imagecreate(500, 500); // Create an image of 500x500
        imagefill($image, 0, 0, $backgroundColor); // Fill with random color

        // Get the company name to add it as text in the image
        $companyName = $this->faker->company;

        // Add company name as text in the center of the image
        $textColor = imagecolorallocate($image, 255, 255, 255); // White color for text
        $font = public_path('fonts/Poppins-Bold.ttf'); // Specify your font path
        $fontSize = 20;
        $bbox = imagettfbbox($fontSize, 0, $font, $companyName); // Get text bounding box
        $x = (500 - ($bbox[2] - $bbox[0])) / 2; // Calculate X position
        $y = (500 - ($bbox[1] - $bbox[7])) / 2; // Calculate Y position
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $companyName); // Add text

        // Save the image to storage
        $logoPath = 'company_logos/' . uniqid() . '.png'; // Generate random logo path
        $storagePath = storage_path('app/public/' . $logoPath);
        imagepng($image, $storagePath); // Save the image as PNG

        // Clean up image resource
        imagedestroy($image);

        return [
            'logo' => $logoPath, // Return the storage path for logo
            'name' => $companyName,  // Using the generated company name
            'address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'user_id' => \App\Models\User::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
