<?php

namespace App\Constants;

class AppPermissions
{
    const DASHBOARD_ACCESS = 'dashboard_access';
    const ADMIN_ACCESS = 'admin_access';
    const MEETING_MANAGEMENT = 'manage_meeting';
    const ANNOUNCEMENT_MANAGEMENT = 'manage_announcement';
    const MAKE_KONSULTASI = "make_konsultasi";
    const REPLY_KONSULTASI_AKADEMIK = 'reply_konsultasi_akademik';
    const REPLY_KONSULTASI_UMUM = 'reply_konsultasi_umum';

    public static function allPermissions()
    {
        return [
            self::DASHBOARD_ACCESS => 'Dashboard Access',
            self::ADMIN_ACCESS => 'Admin Access',
            self::MEETING_MANAGEMENT => 'Manage Meetings',
            self::ANNOUNCEMENT_MANAGEMENT => 'Manage Announcements',
            self::MAKE_KONSULTASI => "Make Konsultasi",
            self::REPLY_KONSULTASI_AKADEMIK => "Reply Konsultasi Akademik",
            self::REPLY_KONSULTASI_UMUM => "Reply Konsultasi Umum"
        ];
    }
}
