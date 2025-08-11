<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Diagnostic Equipment',
                'description' => 'Professional diagnostic tools and equipment for medical examination',
                'is_active' => true
            ],
            [
                'name' => 'Surgical Instruments',
                'description' => 'High-quality surgical tools and instruments',
                'is_active' => true
            ],
            [
                'name' => 'Patient Monitoring',
                'description' => 'Devices for monitoring patient vital signs and health status',
                'is_active' => true
            ],
            [
                'name' => 'Laboratory Equipment',
                'description' => 'Laboratory testing and analysis equipment',
                'is_active' => true
            ],
            [
                'name' => 'Rehabilitation Equipment',
                'description' => 'Equipment for patient rehabilitation and physiotherapy',
                'is_active' => true
            ],
            [
                'name' => 'Personal Protective Equipment',
                'description' => 'Safety equipment for healthcare professionals',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
