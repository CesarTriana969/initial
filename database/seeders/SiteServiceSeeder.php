<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\SiteService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $smallQuote = Quote::firstOrCreate(['name' => 'Small (200 - 300 ft)']);
        $mediumQuote = Quote::firstOrCreate(['name' => 'Medium (301 - 500 ft)']);
        $largeQuote = Quote::firstOrCreate(['name' => 'Large (501 ft or more)']);
        
        $services = [
            [
                'title' => 'Landscaping',
                'subtitle' => 'Enhancing Your Outdoor Space',
                'meta_title' => 'Professional Landscaping Services for Your Home',
                'meta_description' => 'Discover expert landscaping services to transform your garden into a stunning outdoor oasis. From design to maintenance, we cover it all.',
                'slug' => 'professional-landscaping-services',
                'status' => 1,
                'parent_id' => null,
                'quote' => 1,
            ],
            [
                'title' => 'Boulders and stones',
                'subtitle' => 'Natural Elegance in Landscaping',
                'meta_title' => 'Boulders and Stones for Landscape Design',
                'meta_description' => 'Elevate your garden\'s look with our range of boulders and stones, perfect for creating natural, eye-catching landscape designs.',
                'slug' => 'landscape-boulders-stones',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' => 'Edging',
                'subtitle' => 'Defining Beauty in Your Garden',
                'meta_title' => 'Garden Edging Solutions for a Neat Outdoor Look',
                'meta_description' => 'Achieve a perfectly manicured garden with our durable and stylish edging solutions. Easy to install and maintain.',
                'slug' => 'garden-edging-solutions',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' => 'Mulching',
                'subtitle' => 'Protection and Nourishment for Your Plants',
                'meta_title' => 'Quality Mulching for Healthy Gardens',
                'meta_description' => 'Keep your plants healthy and your garden beds tidy with our premium mulching services. A natural way to enhance soil fertility.',
                'slug' => 'premium-garden-mulching',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' => 'Planting trees and beds',
                'subtitle' => 'Bringing Life to Your Outdoor Spaces',
                'meta_title' => 'Expert Tree and Flower Bed Planting Services',
                'meta_description' => 'Transform your garden with our tree and flower bed planting services. Expert advice and care for a vibrant outdoor space.',
                'slug' => 'tree-flower-bed-planting',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' => 'Rock gardens',
                'subtitle' => 'Creating Artistic Natural Landscapes',
                'meta_title' => 'Designing Beautiful Rock Gardens',
                'meta_description' => 'Explore the art of rock gardening. Our team specializes in creating unique and low-maintenance rock gardens for any space.',
                'slug' => 'rock-garden-designs',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' =>  'Shrub planting',
                'subtitle' => 'Add Structure and Greenery to Your Yard',
                'meta_title' => 'Shrub Planting Services for Lush Gardens',
                'meta_description' => 'Enhance your garden with our shrub planting services. Choose from a variety of shrubs for year-round color and texture.',
                'slug' => 'garden-shrub-planting',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
            [
                'title' => 'Sod laying',
                'subtitle' => 'Instantly Beautiful Lawns',
                'meta_title' => 'Professional Sod Laying Services for Perfect Lawns',
                'meta_description' => 'Get a lush, green lawn instantly with our sod laying services. High-quality grass and expert installation for stunning results.',
                'slug' => 'professional-sod-laying',
                'status' => 1,
                'parent_id' => 1,
                'quote' => 0,
            ],
// 
            [
                'title' => 'Tree Services',
                'subtitle' => 'Expert Care for Your Trees',
                'meta_title' => 'Comprehensive Tree Services for Healthy, Beautiful Trees',
                'meta_description' => 'Offering professional tree services including pruning, health assessment, and removal. Ensure the safety and beauty of your trees with our expert care.',
                'slug' => 'professional-tree-services',
                'status' => 1,
                'parent_id' => null,
                'quote' => 0,
            ],
            [
                'title' => 'Tree and stump pruning',
                'subtitle' => 'Maintaining Tree Health and Aesthetics',
                'meta_title' => 'Expert Tree and Stump Pruning Services',
                'meta_description' => 'Professional tree and stump pruning to enhance the health and appearance of your trees. Safe, efficient, and reliable service for all tree types.',
                'slug' => 'tree-stump-pruning-services',
                'status' => 1,
                'parent_id' => 9,
                'quote' => 0,
            ],
            [
                'title' => 'Tree removal',
                'subtitle' => 'Safe and Efficient Tree Removal',
                'meta_title' => 'Professional Tree Removal Services',
                'meta_description' => 'Expert tree removal services for hazardous or unwanted trees. We ensure a safe, clean, and efficient process with minimal impact on your property.',
                'slug' => 'expert-tree-removal',
                'status' => 1,
                'parent_id' => 9,
                'quote' => 0,
            ],

            // 
            [
                'title' => 'Lawn Maintenance',
                'subtitle' => 'Keeping Your Lawn Green and Healthy',
                'meta_title' => 'Professional Lawn Maintenance Services',
                'meta_description' => 'Expert lawn maintenance services to keep your lawn lush, green, and healthy. From mowing to fertilization, we provide complete care for your lawn.',
                'slug' => 'professional-lawn-maintenance',
                'status' => 1,
                'parent_id' => null,
                'quote' => 0,
            ],
            [
                'title' => 'Lawn mowing',
                'subtitle' => 'Precision Mowing for a Perfect Lawn',
                'meta_title' => 'Expert Lawn Mowing Services',
                'meta_description' => 'Reliable and precise lawn mowing services to ensure your lawn looks its best. Regular mowing schedules tailored to your lawn’s needs.',
                'slug' => 'expert-lawn-mowing',
                'status' => 1,
                'parent_id' => 12,
                'quote' => 0,
            ],
            [
                'title' => 'Fertilizer maintenance',
                'subtitle' => 'Nourishing Your Lawn for Optimal Growth',
                'meta_title' => 'Professional Fertilizer Maintenance Services',
                'meta_description' => 'Enhance your lawn’s health and appearance with our specialized fertilizer maintenance services. Customized solutions for every lawn type.',
                'slug' => 'fertilizer-maintenance-services',
                'status' => 1,
                'parent_id' => 12,
                'quote' => 0,
            ],

            // 
            [
                'title' => 'Hardscaping',
                'subtitle' => 'Crafting Your Outdoor Masterpiece',
                'meta_title' => 'Professional Hardscaping Services',
                'meta_description' => 'Elevate your outdoor space with our hardscaping services. From fire pits to patios, we create stunning, durable outdoor features.',
                'slug' => 'professional-hardscaping-services',
                'status' => 1,
                'parent_id' => null,
                'quote' => 0,
            ],
            [
                'title' => 'Fire Pits',
                'subtitle' => 'Warmth and Elegance for Your Backyard',
                'meta_title' => 'Custom Fire Pit Installation Services',
                'meta_description' => 'Add a cozy and inviting touch to your outdoor area with our custom fire pit designs. Perfect for gatherings and relaxation.',
                'slug' => 'custom-fire-pit-installation',
                'status' => 1,
                'parent_id' => 15,
                'quote' => 0,
            ],
            [
                'title' => 'Patios',
                'subtitle' => 'Creating Your Perfect Outdoor Living Space',
                'meta_title' => 'Professional Patio Design and Installation',
                'meta_description' => 'Transform your outdoor space with our beautifully designed patios. Tailored to your style, perfect for relaxation and entertainment.',
                'slug' => 'professional-patio-design',
                'status' => 1,
                'parent_id' => 15,
                'quote' => 0,
            ],
            [
                'title' => 'Retaining Walls',
                'subtitle' => 'Strength and Style for Your Landscape',
                'meta_title' => 'Durable Retaining Wall Construction Services',
                'meta_description' => 'Enhance your landscape with our strong and stylish retaining walls. Designed for both functionality and aesthetics.',
                'slug' => 'retaining-wall-construction',
                'status' => 1,
                'parent_id' => 15,
                'quote' => 0,
            ],
            [
                'title' => 'Sidewalks',
                'subtitle' => 'Paving the Way to a Beautiful Home',
                'meta_title' => 'Custom Sidewalk and Walkway Design Services',
                'meta_description' => 'Create welcoming pathways to your home with our custom sidewalk and walkway designs. Combining functionality with elegance.',
                'slug' => 'custom-sidewalk-design',
                'status' => 1,
                'parent_id' => 15,
                'quote' => 0,
            ],
            

            // 
            [
                'title' => 'Fence Insta & Repairs',
                'subtitle' => 'Secure and Enhance Your Property',
                'meta_title' => 'Expert Fence Installation and Repair Services',
                'meta_description' => 'Professional fence installation and repair services to secure and beautify your property. From vinyl to wood, we cover all your fencing needs.',
                'slug' => 'fence-installation-repairs',
                'status' => 1,
                'parent_id' => null,
                'quote' => 0,
            ],
            [
                'title' => 'Fence Vinyl',
                'subtitle' => 'Durable and Stylish Vinyl Fencing',
                'meta_title' => 'High-Quality Vinyl Fence Solutions',
                'meta_description' => 'Choose vinyl fencing for a durable, low-maintenance solution. Our high-quality vinyl fences offer beauty and privacy with minimal upkeep.',
                'slug' => 'vinyl-fence-solutions',
                'status' => 1,
                'parent_id' => 20,
                'quote' => 0,
            ],
            [
                'title' => 'Fence Wood',
                'subtitle' => 'Classic Wood Fencing for Timeless Elegance',
                'meta_title' => 'Custom Wood Fence Installation Services',
                'meta_description' => 'Enhance your property with our custom wood fencing. Offering a range of styles for a natural, timeless look with lasting durability.',
                'slug' => 'wood-fence-installation',
                'status' => 1,
                'parent_id' => 20,
                'quote' => 0,
            ],
            [
                'title' => 'Chain-link fence',
                'subtitle' => 'Functional and Secure Chain-Link Fencing',
                'meta_title' => 'Reliable Chain-Link Fence Installation',
                'meta_description' => 'Secure your property effectively with our chain-link fencing. Ideal for both residential and commercial properties, offering durability and security.',
                'slug' => 'chain-link-fence-installation',
                'status' => 1,
                'parent_id' => 20,
                'quote' => 0,
            ],
            // 
            [
                'title' => 'Seasonal Cleanup',
                'subtitle' => 'Preparing Your Space for Every Season',
                'meta_title' => 'Comprehensive Seasonal Cleanup Services',
                'meta_description' => 'Expert seasonal cleanup services to prepare your outdoor space for any season. From leaf removal in fall to snow clearing in winter, we handle it all.',
                'slug' => 'seasonal-cleanup-services',
                'status' => 1,
                'parent_id' => null,
                'quote' => 0,
            ],
            [
                'title' => 'Fall Cleanup',
                'subtitle' => 'Get Your Garden Ready for Winter',
                'meta_title' => 'Professional Fall Cleanup Services',
                'meta_description' => 'Complete fall cleanup services to tidy up your garden and prepare it for the winter. Leaf removal, garden waste clearance, and more.',
                'slug' => 'fall-cleanup-services',
                'status' => 1,
                'parent_id' => 24,
                'quote' => 0,
            ],
            [
                'title' => 'Spring Cleanup',
                'subtitle' => 'Revitalize Your Garden for Spring',
                'meta_title' => 'Expert Spring Cleanup Services',
                'meta_description' => 'Kickstart your garden this spring with our thorough cleanup services. Pruning, mulching, and cleaning to bring your garden back to life.',
                'slug' => 'spring-cleanup-services',
                'status' => 1,
                'parent_id' => 24,
                'quote' => 0,
            ],
            [
                'title' => 'Snow Removal',
                'subtitle' => 'Efficient Snow Clearing for Safety and Access',
                'meta_title' => 'Reliable Snow Removal Services',
                'meta_description' => 'Quick and efficient snow removal to ensure your property is safe and accessible throughout the winter. Trust us for all your snow clearing needs.',
                'slug' => 'snow-removal-services',
                'status' => 1,
                'parent_id' => 24,
                'quote' => 0,
            ],
        ];
        

        foreach ($services as $serviceData) {
            $service = SiteService::create($serviceData);
            $service->quotes()->attach([$smallQuote->id, $mediumQuote->id, $largeQuote->id]);
        }
    }
}
