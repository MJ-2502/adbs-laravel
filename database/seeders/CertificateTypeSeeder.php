<?php

namespace Database\Seeders;

use App\Models\CertificateType;
use Illuminate\Database\Seeder;

class CertificateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificateTypes = [
            [
                'name' => 'Barangay Clearance',
                'description' => 'Certificate of clearance from the barangay for various purposes',
                'fee' => 50.00,
                'requirements' => [
                    'Valid ID',
                    'Proof of Residency',
                    'Cedula',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Certificate of Residency',
                'description' => 'Certificate proving residency in the barangay',
                'fee' => 30.00,
                'requirements' => [
                    'Valid ID',
                    'Proof of Residency (Utility Bill)',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Certificate of Indigency',
                'description' => 'Certificate for indigent residents',
                'fee' => 0.00,
                'requirements' => [
                    'Valid ID',
                    'Proof of Income',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Business Permit',
                'description' => 'Barangay business permit for small businesses',
                'fee' => 150.00,
                'requirements' => [
                    'Valid ID',
                    'Business Registration',
                    'Location Sketch',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Certificate of Good Moral',
                'description' => 'Certificate attesting to good moral character',
                'fee' => 40.00,
                'requirements' => [
                    'Valid ID',
                    'Proof of Residency',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($certificateTypes as $type) {
            CertificateType::create($type);
        }
    }
}
