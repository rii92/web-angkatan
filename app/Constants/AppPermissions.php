<?php

namespace App\Constants;

class AppPermissions
{
    const DASHBOARD_ACCESS = 'dashboard_access';
    const ADMIN_ACCESS = 'admin_access';
    const MEETING_MANAGEMENT = 'manage_meeting';
    const ANNOUNCEMENT_MANAGEMENT = 'manage_announcement';

    public static function allPermissions()
    {
        return [
            self::DASHBOARD_ACCESS => 'Dashboard Access',
            self::ADMIN_ACCESS => 'Admin Access',
            self::MEETING_MANAGEMENT => 'Manage Meetings',
            self::ANNOUNCEMENT_MANAGEMENT => 'Manage Announcements'
        ];
    }
}
