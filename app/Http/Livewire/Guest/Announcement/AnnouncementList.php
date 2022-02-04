<?php

namespace App\Http\Livewire\Guest\Announcement;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class AnnouncementList extends Component
{
  use WithPagination;

  public function render()
  {
    return view('guest.announcement.list', [
      'announcements' => Announcement::where('published_at', '<=',  now())->orderby('published_at', 'DESC')->paginate(9),
    ]);
  }
}
