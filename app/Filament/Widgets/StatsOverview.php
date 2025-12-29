<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use App\Models\Appointment;
use App\Models\JobApplication;
use App\Models\Course;
use App\Models\Post;
use App\Models\Country;
use App\Models\Scholarship;
use App\Models\WorkPermit;
use App\Models\LanguageCourse;
use App\Models\University;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Video;
use App\Models\Gallery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // Optional: Auto-refresh data every 15 seconds
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // --- ROW 1: CRITICAL INBOX (Leads) ---
            Stat::make('Total Inquiries', Inquiry::count())
                ->description('All time inquiries')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('success')
                ->chart([7, 12, 10, 3, 15, 4, 17]), // Example trend chart

            Stat::make('Appointments', Appointment::count())
                ->description('Booked consultations')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart([2, 5, 8, 4, 10, 12, 15]),

            Stat::make('Job Applications', JobApplication::count())
                ->description('CVs received')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info'),

            // --- ROW 2: CORE OFFERINGS (Database) ---
            Stat::make('Partner Universities', University::count())
                ->description('Global partnerships')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('primary'),

            Stat::make('Academic Courses', Course::count())
                ->description('Listed programs')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),

            Stat::make('Language Courses', LanguageCourse::count())
                ->description('IELTS / Spoken')
                ->descriptionIcon('heroicon-m-language')
                ->color('info'),

            // --- ROW 3: CONTENT & MEDIA ---
            Stat::make('Blog Posts', Post::count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('gray'),

            Stat::make('Services', Service::count())
                ->description('Service pages')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success'),

            Stat::make('Media Gallery', Gallery::count() + Video::count())
                ->description('Photos & Videos')
                ->descriptionIcon('heroicon-m-photo')
                ->color('gray'),

            // --- ROW 4: DESTINATIONS & PERMITS ---
            Stat::make('Active Countries', Country::where('is_active', true)->count())
                ->description('Destinations')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('success'),

            Stat::make('Scholarships', Scholarship::count())
                ->description('Financial aid opportunities')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Work Permits', WorkPermit::count())
                ->description('Permit types')
                ->descriptionIcon('heroicon-m-document-check')
                ->color('warning'),
        ];
    }
    protected function getColumns(): int
{
    return 4; // Shows 3 cards per row (Resulting in 4 nice rows)
}
}