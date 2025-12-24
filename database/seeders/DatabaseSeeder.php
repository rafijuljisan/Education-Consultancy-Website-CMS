<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Country;
use App\Models\University;
use App\Models\Category;
use App\Models\Course;
use App\Models\Service;
use App\Models\Post;
use App\Models\GeneralSetting;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\LanguageCourse;
use App\Models\Testimonial;
use App\Models\MenuItem;
use App\Models\Career;
use App\Models\AboutSection;
use App\Models\JobApplication;
use App\Models\Slider;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Disable Foreign Key Checks (Crucial for Truncate)
        Schema::disableForeignKeyConstraints();

        // 2. Clear all existing data
        User::truncate();
        GeneralSetting::truncate();
        Country::truncate();
        University::truncate();
        Course::truncate();
        Service::truncate();
        Post::truncate();
        Gallery::truncate();
        Video::truncate();
        Testimonial::truncate();
        LanguageCourse::truncate();
        MenuItem::truncate();
        JobApplication::truncate();
        Career::truncate();
        AboutSection::truncate();
        Slider::truncate();

        // 3. RE-ENABLE FOREIGN KEY CHECKS
        Schema::enableForeignKeyConstraints();

        // --- START SEEDING ---

        // Create Super Admin
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Site Settings
        GeneralSetting::create([
            'site_name' => 'GlobalEd Consultancy',
            'site_logo' => null,
            'primary_color' => '#2563eb',
            'secondary_color' => '#f59e0b',
            'hero_title' => 'Study Abroad & Shape Your Future',
            'hero_description' => 'We guide students to top universities in UK, USA, Canada & Australia. Get expert visa counseling today.',
            'hero_button_text' => 'Find a University',
            'hero_button_url' => '/destinations',
            'contact_email' => 'info@globaled.com',
        ]);

        // Services
        $services = [
            ['Student Visa Guidance', 'Step-by-step assistance for your visa application.'],
            ['University Admissions', 'We help you apply to top-ranked universities.'],
            ['Career Counseling', 'Choose the right career path with our experts.'],
            ['Scholarship Support', 'Find and apply for funding opportunities.'],
        ];

        foreach ($services as $service) {
            Service::create([
                'title' => $service[0],
                'slug' => Str::slug($service[0]),
                'short_description' => $service[1],
                'content' => '<p>' . $service[1] . ' We provide full support...</p>',
                'is_active' => true,
            ]);
        }

        // Categories
        $categories = ['Business & Management', 'Computer Science & IT', 'Engineering', 'Health & Medicine', 'Law'];
        $catIds = [];
        foreach ($categories as $cat) {
            $createdCat = Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'is_visible' => true
            ]);
            $catIds[$cat] = $createdCat->id;
        }

        // --- United Kingdom ---
        $uk = Country::create([
            'name' => 'United Kingdom',
            'slug' => 'united-kingdom',
            'short_description' => 'Home to some of the world’s oldest and most prestigious universities.',
            'details' => '<p>The UK offers a world-class education system...</p>'
        ]);

        $uniGreenwich = University::create([
            'country_id' => $uk->id,
            'name' => 'University of Greenwich',
            'slug' => 'university-of-greenwich',
            'city' => 'London',
            'ranking' => 600,
        ]);

        Course::create([
            'university_id' => $uniGreenwich->id,
            'category_id' => $catIds['Business & Management'],
            'title' => 'MBA International Business',
            'slug' => 'mba-international-business-greenwich',
            'level' => 'Postgraduate',
            'tuition_fee' => 16500,
            'currency' => 'GBP',
            'duration' => '1 Year',
            'intake_months' => 'September, January',
            'entry_requirements' => '<li>Bachelor degree with 55%</li><li>IELTS 6.0</li>',
            'is_featured' => true,
        ]);

        // --- USA ---
        $usa = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'short_description' => 'The top destination for international students seeking innovation.',
            'details' => '<p>The USA hosts the highest number of international students...</p>'
        ]);

        $uniHarvard = University::create([
            'country_id' => $usa->id,
            'name' => 'Harvard University',
            'slug' => 'harvard-university',
            'city' => 'Cambridge, MA',
            'ranking' => 1,
        ]);

        Course::create([
            'university_id' => $uniHarvard->id,
            'category_id' => $catIds['Computer Science & IT'],
            'title' => 'MSc Data Science',
            'slug' => 'msc-data-science-harvard',
            'level' => 'Postgraduate',
            'tuition_fee' => 55000,
            'currency' => 'USD',
            'duration' => '2 Years',
            'intake_months' => 'September',
            'entry_requirements' => '<li>GRE Score required</li><li>IELTS 7.5</li>',
            'is_featured' => true,
        ]);

        // --- Canada ---
        $canada = Country::create([
            'name' => 'Canada',
            'slug' => 'canada',
            'short_description' => 'Known for its friendly environment and post-study work opportunities.',
            'details' => '<p>Canada is a land of opportunities...</p>'
        ]);

        $uniToronto = University::create([
            'country_id' => $canada->id,
            'name' => 'University of Toronto',
            'slug' => 'university-of-toronto',
            'city' => 'Toronto',
            'ranking' => 25,
        ]);

        Course::create([
            'university_id' => $uniToronto->id,
            'category_id' => $catIds['Health & Medicine'],
            'title' => 'BSc Nursing',
            'slug' => 'bsc-nursing-toronto',
            'level' => 'Undergraduate',
            'tuition_fee' => 35000,
            'currency' => 'CAD',
            'duration' => '4 Years',
            'intake_months' => 'September',
            'entry_requirements' => '<li>High School Diploma</li><li>Biology & Chemistry required</li>',
            'is_featured' => false,
        ]);

        // Blog Posts
        Post::create([
            'title' => '5 Reasons to Study in UK',
            'slug' => '5-reasons-to-study-in-uk',
            'content' => '<p>The UK is home to top universities and offers a 2-year post-study work visa...</p>',
            'published_at' => now(),
            'is_featured' => true,
        ]);

        Post::create([
            'title' => 'USA Study Visa Guide 2025',
            'slug' => 'usa-study-visa-guide-2025',
            'content' => '<p>Here is everything you need to know about the F1 Visa process...</p>',
            'published_at' => now()->subDays(5),
            'is_featured' => false,
        ]);

        // --- Gallery ---
        Gallery::create(['title' => 'Student Orientation 2024', 'image_path' => 'demo/gallery1.jpg']);
        Gallery::create(['title' => 'Campus Tour UK', 'image_path' => 'demo/gallery2.jpg']);

        // --- Videos ---
        Video::create([
            'title' => 'Student Success Story - Sarah in Canada',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'is_featured' => true,
        ]);
        // ... inside run()

        // 1. Create Parent "Gallery"
        $galleryParent = MenuItem::create([
            'label' => 'Gallery',
            'url' => '#', // No link, just a dropdown trigger
            'sort_order' => 5, // Adjust order as needed
            'is_active' => true,
        ]);

        // 2. Create "Photo Gallery" Child
        MenuItem::create([
            'parent_id' => $galleryParent->id,
            'label' => 'Photo Gallery',
            'url' => '/gallery/photos',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // 3. Create "Video Gallery" Child
        MenuItem::create([
            'parent_id' => $galleryParent->id,
            'label' => 'Video Gallery',
            'url' => '/gallery/videos',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // --- Testimonials ---
        Testimonial::create([
            'name' => 'John Doe',
            'designation' => 'MBA at Greenwich University',
            'content' => 'GlobalEd Consultancy helped me get my visa approved in just 2 weeks! Highly recommended.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'name' => 'Jane Smith',
            'designation' => 'Nursing Student in Canada',
            'content' => 'The counselors were very supportive and guided me through the entire scholarship process.',
            'rating' => 5,
        ]);

        // --- Language Courses ---
        LanguageCourse::create([
            'title' => 'IELTS Academic Prep',
            'slug' => 'ielts-academic-prep',
            'short_description' => 'Master all 4 modules: Listening, Reading, Writing, & Speaking. Target Band 7.5+.',
            'content' => '<p>Our IELTS Academic course is designed for students planning to study abroad. We cover advanced grammar, vocabulary, and exam strategies.</p><ul><li>20 Mock Tests included</li><li>One-on-one Speaking sessions</li></ul>',
            'duration' => '6 Weeks',
            'batch_type' => 'Weekend & Weekday',
            'mode' => 'Hybrid',
            'fee' => 250.00,
            'is_active' => true,
            'thumbnail' => null,
        ]);

        LanguageCourse::create([
            'title' => 'German Language - A1 Level',
            'slug' => 'german-language-a1',
            'short_description' => 'Start your journey to Germany. Learn basic German grammar and conversation.',
            'content' => '<p>The A1 course is the first step for students aiming for Germany. Includes certification preparation.</p>',
            'duration' => '8 Weeks',
            'batch_type' => 'Weekday Evenings',
            'mode' => 'Online',
            'fee' => 300.00,
            'is_active' => true,
            'thumbnail' => null,
        ]);

        LanguageCourse::create([
            'title' => 'PTE Academic',
            'slug' => 'pte-academic',
            'short_description' => 'Fast-track your English proficiency score with our intensive PTE training.',
            'content' => '<p>Computer-based testing strategies to help you score 70+ in your first attempt.</p>',
            'duration' => '4 Weeks',
            'batch_type' => 'Flexible',
            'mode' => 'Offline',
            'fee' => 200.00,
            'is_active' => true,
            'thumbnail' => null,
        ]);

        // --- Menu Items ---
        // Note: Removed "Destinations" from here to avoid duplication. It is created explicitly below.
        $menuItems = [
            [
                'label' => 'Home',
                'url' => '/',
                'sort_order' => 1,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'About Us', // Added
                'url' => '/about',
                'sort_order' => 2,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Services',
                'url' => '/services',
                'sort_order' => 4,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Careers', // Added
                'url' => '/careers',
                'sort_order' => 5,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Language Prep',
                'url' => '/languages',
                'sort_order' => 6,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Gallery',
                'url' => '/gallery',
                'sort_order' => 7,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Blog',
                'url' => '/blog',
                'sort_order' => 8,
                'new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Contact',
                'url' => '/contact',
                'sort_order' => 9,
                'new_tab' => false,
                'is_active' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }

        // --- Destinations Menu with Children ---

        // 1. Create Parent Item (Destinations)
        $destinations = MenuItem::create([
            'label' => 'Destinations',
            'url' => '/destinations',
            'sort_order' => 3, // Placed between About and Services
            'new_tab' => false,
            'is_active' => true,
        ]);

        // 2. Create Children for Destinations
        MenuItem::create([
            'parent_id' => $destinations->id,
            'label' => 'Study in UK',
            'url' => '/destinations/united-kingdom',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        MenuItem::create([
            'parent_id' => $destinations->id,
            'label' => 'Study in USA',
            'url' => '/destinations/united-states',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        MenuItem::create([
            'parent_id' => $destinations->id,
            'label' => 'Study in Canada',
            'url' => '/destinations/canada',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // --- Careers / Jobs Content ---
        Career::create([
            'title' => 'Senior Education Counselor',
            'slug' => 'senior-education-counselor',
            'location' => 'New York, USA (Hybrid)',
            'type' => 'Full Time',
            'description' => '
                <h3>About the Role</h3>
                <p>We are looking for an experienced Education Counselor to guide students in selecting the right universities in the UK and USA. You will be responsible for end-to-end admission support.</p>
                <h3>Requirements</h3>
                <ul>
                    <li>Minimum 3 years of experience in Study Abroad consultancy.</li>
                    <li>Strong knowledge of UK/USA visa regulations.</li>
                    <li>Excellent communication skills.</li>
                </ul>
                <h3>Perks</h3>
                <p>Health insurance, Annual performance bonus, and Travel allowance.</p>
            ',
            'salary_range' => 60000.00,
            'is_active' => true,
            'is_filled' => false,
        ]);

        Career::create([
            'title' => 'Digital Marketing Intern',
            'slug' => 'digital-marketing-intern',
            'location' => 'Remote',
            'type' => 'Internship',
            'description' => '
                <p>Join our marketing team to manage social media campaigns and write content for our blog. This is a paid internship with a chance for full-time employment.</p>
                <p><strong>Duration:</strong> 6 Months</p>
            ',
            'salary_range' => 12000.00,
            'is_active' => true,
            'is_filled' => false,
        ]);

        Career::create([
            'title' => 'Visa Filing Officer',
            'slug' => 'visa-filing-officer',
            'location' => 'London Branch',
            'type' => 'Full Time',
            'description' => '<p>Responsible for checking financial documents and filing student visas.</p>',
            'salary_range' => 45000.00,
            'is_active' => true,
            'is_filled' => true, // Mark as Hired
        ]);

        // --- About Section Content ---
        // 1. Mission (Image Left)
        AboutSection::create([
            'title' => 'Our Mission',
            'subtitle' => 'Why We Exist',
            'content' => '<p>To bridge the gap between ambitious students and global education opportunities. We believe that borders shouldn\'t limit potential, and we strive to make international education accessible, transparent, and hassle-free for everyone.</p>',
            'layout_type' => 'image_left',
            'sort_order' => 1,
            'image' => null,
        ]);

        // 2. Vision (Image Right)
        AboutSection::create([
            'title' => 'Our Vision',
            'subtitle' => 'Looking Ahead',
            'content' => '<p>We envision a world where every student has the guidance they need to succeed globally. By 2030, we aim to have placed over 50,000 students in top-tier universities across the UK, USA, Canada, and Australia.</p>',
            'layout_type' => 'image_right',
            'sort_order' => 2,
            'image' => null,
        ]);

        // 3. Values (Centered)
        AboutSection::create([
            'title' => 'Core Values',
            'content' => '<p>Integrity, Transparency, and Student-Centricity. These aren\'t just words to us; they are the pillars of our consultancy. We don\'t just process visas; we build careers.</p>',
            'layout_type' => 'centered_card',
            'sort_order' => 3,
        ]);
        // --- Sliders ---
        Slider::create([
            'subtitle' => 'Welcome to GlobalEd',
            'title' => 'Shape Your Future Abroad',
            'description' => 'We guide you to the top universities in UK, USA, & Canada with 100% visa success rate.',
            'image_path' => 'sliders/slider1.jpg', // Ensure you have this image in public/sliders/
            'button_text' => 'Start Your Journey',
            'button_link' => '/contact',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'subtitle' => 'Expert Guidance',
            'title' => 'Scholarships & Financial Aid',
            'description' => 'Don\'t let finances stop you. We help you find the best scholarships available.',
            'image_path' => 'sliders/slider2.jpg',
            'button_text' => 'View Scholarships',
            'button_link' => '/services',
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }
}