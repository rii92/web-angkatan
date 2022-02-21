<?php

namespace App\Http\Livewire\Mahasiswa;

use Livewire\Component;

class Notification extends Component
{
    private $DEFAULT_TOTAL_NOTIFICATIONS = 10;

    public $totalNotifications;
    public $totalUnreadNotifications;
    public $totalDisplay = 0;

    protected $listeners = [
        'readNotifications' => 'readNotifications'
    ];

    public function mount()
    {
        $this->totalNotifications = auth()->user()->notifications()->count();
        $this->totalUnreadNotifications = auth()->user()->unreadnotifications()->count();

        // default maksimal 10, kecuali ada yang belum di read, tampilkan semua
        $this->totalDisplay = $this->totalUnreadNotifications >= $this->DEFAULT_TOTAL_NOTIFICATIONS
            ? $this->totalUnreadNotifications
            : $this->DEFAULT_TOTAL_NOTIFICATIONS;
    }

    /**
     * change notif yang belum read ke read
     *
     * @return void
     */
    public function readNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->totalUnreadNotifications = 0;
    }

    public function render()
    {
        $notif = auth()->user()->notifications()->take($this->totalDisplay)->get();
        return view('components.dashboard.header-notification', compact('notif'));
    }
}
