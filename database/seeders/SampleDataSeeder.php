<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Download;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Notice;
use App\Models\Program;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Banners
        Banner::create(['title' => 'Welcome to KMH Academics', 'subtitle' => 'Shaping the Future of Health Professionals', 'is_active' => true, 'sort_order' => 1]);
        Banner::create(['title' => 'New Admissions Open 2025', 'subtitle' => 'Apply Now for Undergraduate Programs', 'is_active' => true, 'sort_order' => 2]);

        // Programs
        $programs = [
            ['Bachelor of Science in Nursing (BSN)', 'undergraduate', '4 Years', 'Annual (August)', 'Pass +2 Science with Biology'],
            ['MBBS', 'undergraduate', '5.5 Years', 'Annual (January)', 'Pass +2 Science with Physics, Chemistry, Biology'],
            ['Bachelor of Pharmacy (BPharm)', 'undergraduate', '4 Years', 'Annual (August)', 'Pass +2 Science with Chemistry/Biology'],
            ['Master of Public Health (MPH)', 'postgraduate', '2 Years', 'Annual (February)', 'Bachelor in Health Sciences'],
            ['Post-Graduate Diploma in Hospital Management', 'certificate', '1 Year', 'Twice a year', 'Bachelor degree in any discipline'],
            ['Certificate in Medical Laboratory Technology', 'certificate', '2 Years', 'Annual', 'Pass SLC/SEE'],
        ];

        foreach ($programs as [$title, $cat, $dur, $intake, $elig]) {
            Program::create([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'category' => $cat,
                'duration' => $dur,
                'intake' => $intake,
                'eligibility' => $elig,
                'description' => "This program provides comprehensive education in {$title}. Students gain theoretical knowledge and practical skills to excel in the healthcare sector.",
                'is_active' => true,
                'sort_order' => 1,
            ]);
        }

        // Notices
        $notices = [
            ['Admission Open for 2025-26 Academic Session', 'admission', now()->subDays(2)->toDateString()],
            ['Result Published: Final Year BSN Examination', 'exam', now()->subDays(5)->toDateString()],
            ['Important Notice: Change of Examination Schedule', 'academic', now()->subDays(7)->toDateString()],
            ['Library Timing Update', 'general', now()->subDays(10)->toDateString()],
            ['Notice for Scholarship Applications', 'academic', now()->subDays(14)->toDateString()],
        ];

        foreach ($notices as [$title, $cat, $date]) {
            Notice::create([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'category' => $cat,
                'content' => "This is an official notice from KMH Academics regarding: {$title}. Please note the details carefully and comply accordingly. For any queries, contact the administration office.",
                'is_published' => true,
                'published_at' => $date,
            ]);
        }

        // Events
        Event::create([
            'title' => 'Annual Medical Conference 2025',
            'slug' => 'annual-medical-conference-2025',
            'type' => 'conference',
            'description' => 'Join us for the Annual Medical Conference bringing together leading healthcare professionals and researchers.',
            'location' => 'KMH Auditorium, Kathmandu',
            'organizer' => 'KMH Academics',
            'start_date' => now()->addDays(15),
            'end_date' => now()->addDays(17),
            'is_published' => true,
        ]);
        Event::create([
            'title' => 'CPR & First Aid Training Workshop',
            'slug' => 'cpr-first-aid-training-2025',
            'type' => 'training',
            'description' => 'A hands-on training workshop on CPR and First Aid techniques for all healthcare students.',
            'location' => 'Clinical Skills Lab, KMH',
            'organizer' => 'Department of Emergency Medicine',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(5),
            'is_published' => true,
        ]);
        Event::create([
            'title' => 'Health Sciences Seminar: COVID-19 Lessons',
            'slug' => 'health-sciences-seminar-covid',
            'type' => 'seminar',
            'description' => 'A retrospective seminar on lessons learned from the COVID-19 pandemic for health systems.',
            'location' => 'KMH Conference Hall',
            'organizer' => 'Department of Community Medicine',
            'start_date' => now()->subDays(30),
            'end_date' => now()->subDays(30),
            'is_published' => true,
        ]);

        // FAQs
        $faqs = [
            ['How can I apply for admission?', 'Visit our website or come in person to the admissions office with your academic documents. Applications are accepted online and offline.', 'admission'],
            ['What are the eligibility criteria for MBBS?', 'Applicants must have completed +2 Science with Physics, Chemistry and Biology with minimum 50% marks. Entrance examination is also required.', 'admission'],
            ['Is hostel accommodation available?', 'Yes, KMH Academics provides separate hostel facilities for male and female students. Contact the administration for availability.', 'facilities'],
            ['What is the academic calendar?', 'The academic year typically begins in August for most programs. Please check our website for specific program start dates.', 'academic'],
            ['Are scholarships available?', 'Yes, merit-based scholarships are available for deserving students. Contact the administration office for details.', 'financial'],
        ];

        foreach ($faqs as $i => [$q, $a, $cat]) {
            Faq::create(['question' => $q, 'answer' => $a, 'category' => $cat, 'is_active' => true, 'sort_order' => $i + 1]);
        }

        // Downloads
        $downloads = [
            ['Admission Form 2025-26', 'forms', 'Official admission application form for new students'],
            ['Academic Calendar 2025', 'academic', 'Complete academic schedule for the year 2025'],
            ['Fee Structure 2025', 'administrative', 'Fee schedule for all programs'],
            ['Scholarship Application Form', 'forms', 'Form for applying for merit scholarships'],
        ];

        foreach ($downloads as $i => [$title, $cat, $desc]) {
            Download::create([
                'title' => $title,
                'category' => $cat,
                'description' => $desc,
                'file_path' => 'downloads/sample.pdf',
                'file_name' => \Illuminate\Support\Str::slug($title).'.pdf',
                'file_size' => '245 KB',
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
