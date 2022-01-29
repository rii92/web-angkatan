<?php

namespace App\Http\Livewire\Sambat;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ScrollView extends Component
{
    public function render()
    {
        return view('sambat.scroll-view', [
            'votes' => DB::table('sambat_votes')
                            ->join('sambat', 'sambat_votes.sambat_id', '=', 'sambat.id')
                            ->join('users', 'sambat.user_id', '=', 'users.id')
                            ->select('sambat_votes.*', 'users.name', 'sambat.*',DB::raw('(SUM(`is_upvote`) - (COUNT(*) - SUM(`is_upvote`))) as `total`'))
                            ->groupBy('sambat_id')
                            ->orderByDesc('total')
                            ->get()
        ]);
    }
}