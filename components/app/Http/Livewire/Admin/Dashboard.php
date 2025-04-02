<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public function render()
    {
        //Meta
        $title = __('Dashboard') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

		$today        = History::where('created_at', '>=', Carbon::today())->count() ?? 0;
		$thisWeek     = History::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek() ])->count() ?? 0;
		$last30Days   = History::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth() ])->count() ?? 0;
		$allTime      = History::count() ?? 0;
		$getAllDays   = History::select( DB::raw('DATE(created_at) as date') )->groupBy('date')->get()->toArray();
		$toolPerDay   = History::select( DB::raw('DATE(created_at) as date'), DB::raw('count(*) as history') )->groupBy('date')->get()->toArray();
		$countPerTool = History::select( 'tool_name', DB::raw('count(*) as count') )->groupBy('tool_name')->orderBy('count', 'DESC')->paginate(15);
		$users        = User::orderBy('id', 'DESC')->paginate(15);

        return view('livewire.admin.dashboard', [
			'today'        => $today,
			'thisWeek'     => $thisWeek,
			'last30Days'   => $last30Days,
			'allTime'      => $allTime,
			'getAllDays'   => $getAllDays,
			'toolPerDay'   => $toolPerDay,
			'countPerTool' => $countPerTool,
			'users'        => $users
        ])->layout('layouts.admin', [
			'breadcrumbs' => [
			    ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
			    ['title' => __( 'Dashboard' ), 'url' => null]
			]
        ]);
    }
}
