<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();
        
        $products = [
            [
                'name' => 'Digital Blood Pressure Monitor',
                'description' => 'Accurate digital blood pressure monitor with LCD display and memory function. Features automatic inflation and deflation for easy one-touch operation.',
                'short_description' => 'Professional digital BP monitor with LCD display',
                'price' => 89.99,
                'sale_price' => 69.99,
                'sku' => 'BP-001',
                'stock_quantity' => 25,
                'brand' => 'MediTech',
                'category_id' => $categories->where('name', 'Diagnostic Equipment')->first()->id,
                'images' => ['/images/products/bp-monitor.svg'],
                'is_active' => true,
                'is_featured' => true,
                'meta_title' => 'Digital Blood Pressure Monitor - MediTech',
                'meta_description' => 'Professional digital blood pressure monitor with accurate readings and memory function.'
            ],
            [
                'name' => 'Stethoscope Professional',
                'description' => 'High-quality stethoscope with superior acoustic performance. Dual-head chest piece with tunable diaphragm technology.',
                'short_description' => 'Professional stethoscope with superior acoustics',
                'price' => 149.99,
                'sku' => 'STH-001',
                'stock_quantity' => 15,
                'brand' => 'CardioSound',
                'category_id' => $categories->where('name', 'Diagnostic Equipment')->first()->id,
                'images' => ['/images/products/stethoscope.svg'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Surgical Scissors Set',
                'description' => 'Complete set of surgical scissors made from high-grade stainless steel. Includes straight and curved scissors for various surgical procedures.',
                'short_description' => 'Professional surgical scissors set - stainless steel',
                'price' => 199.99,
                'sku' => 'SS-001',
                'stock_quantity' => 10,
                'brand' => 'SurgiPro',
                'category_id' => $categories->where('name', 'Surgical Instruments')->first()->id,
                'images' => ['/images/products/surgical-scissors.svg'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Pulse Oximeter',
                'description' => 'Portable fingertip pulse oximeter for measuring oxygen saturation and pulse rate. Features OLED display with multiple viewing directions.',
                'short_description' => 'Fingertip pulse oximeter with OLED display',
                'price' => 39.99,
                'sale_price' => 29.99,
                'sku' => 'PO-001',
                'stock_quantity' => 50,
                'brand' => 'OxyMeter',
                'category_id' => $categories->where('name', 'Patient Monitoring')->first()->id,
                'images' => ['/images/products/pulse-oximeter.svg'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Digital Thermometer',
                'description' => 'Fast and accurate digital thermometer with flexible tip. Suitable for oral, rectal, and underarm measurements.',
                'short_description' => 'Digital thermometer with flexible tip',
                'price' => 19.99,
                'sku' => 'TH-001',
                'stock_quantity' => 100,
                'brand' => 'TempCheck',
                'category_id' => $categories->where('name', 'Diagnostic Equipment')->first()->id,
                'images' => ['/images/products/thermometer.svg'],
                'is_active' => true,
            ],
            [
                'name' => 'Wheelchair Standard',
                'description' => 'Standard manual wheelchair with steel frame and comfortable padding. Features removable desk arms and swing-away footrests.',
                'short_description' => 'Standard manual wheelchair with steel frame',
                'price' => 299.99,
                'sale_price' => 249.99,
                'sku' => 'WC-001',
                'stock_quantity' => 5,
                'brand' => 'MobilityPlus',
                'category_id' => $categories->where('name', 'Rehabilitation Equipment')->first()->id,
                'images' => ['/images/products/wheelchair.webp'],
                'is_active' => true,
            ],
            [
                'name' => 'N95 Face Masks (Box of 20)',
                'description' => 'NIOSH-approved N95 respirator masks providing 95% filtration efficiency. Comfortable fit with adjustable nose bridge.',
                'short_description' => 'NIOSH-approved N95 masks - 20 pack',
                'price' => 49.99,
                'sku' => 'N95-001',
                'stock_quantity' => 200,
                'brand' => 'SafeGuard',
                'category_id' => $categories->where('name', 'Personal Protective Equipment')->first()->id,
                'images' => ['/images/products/n95-masks.webp'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Microscope Laboratory',
                'description' => 'Professional laboratory microscope with LED illumination and multiple magnification levels. Perfect for educational and clinical use.',
                'short_description' => 'Professional lab microscope with LED illumination',
                'price' => 599.99,
                'sku' => 'MS-001',
                'stock_quantity' => 3,
                'brand' => 'LabVision',
                'category_id' => $categories->where('name', 'Laboratory Equipment')->first()->id,
                'images' => ['/images/products/microscope.webp'],
                'is_active' => true,
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
