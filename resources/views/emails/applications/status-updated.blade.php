<x-mail::message>
# Hello {{ $application->user->first_name }},

This is an update regarding your application for the **{{ $application->jobPosting->title }}** position at Evergreen Solutions.

Your application status has been updated to: **{{ $application->status }}**

@if ($application->status === 'Interview Scheduled')
You will receive a separate communication regarding scheduling shortly.
@endif

You can view your application status at any time by logging into your dashboard.

<x-mail::button :url="route('dashboard')">
View My Dashboard
</x-mail::button>

Thank you for your interest in joining our team.

Regards,<br>
The Team at {{ config('app.name') }}
</x-mail::message>