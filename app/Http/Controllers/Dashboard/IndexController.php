<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{

    protected $currentDate;

    protected $startDate;

    protected $endDate;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function initDate(Request $request){
        $this->currentDate = Carbon::now();
        $this->startDate = $this->currentDate->clone();
        $this->endDate = $this->currentDate->clone();

        if($request->has('start_date') && !empty($request->has('start_date'))){
            $this->startDate = Carbon::createFromFormat('d-m-Y', $request->get('start_date'));
        }
        if($request->has('end_date') && !empty($request->has('end_date'))){
            $this->endDate = Carbon::createFromFormat('d-m-Y', $request->get('end_date'));
        }

    }


    public function index(Request $request){

        $this->initDate($request);

        return view('dashboard.pages.index', [
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate'   => $this->endDate->format('d-m-Y'),
            'currentDate' => $this->currentDate->format('d-m-Y')
        ]);
    }

}
