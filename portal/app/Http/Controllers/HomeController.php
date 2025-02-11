<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Custom;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Maintainer;
use App\Models\MaintenanceRequest;
use App\Models\NoticeBoard;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            $result['totalNote'] = NoticeBoard::where('parent_id', parentId())->count();
            $result['totalContact'] = Contact::where('parent_id', parentId())->count();


            if (\Auth::user()->type == 'tenant') {
                $tenant=Tenant::where('user_id',\Auth::user()->id)->first();
                $result['totalInvoice']=Invoice::where('property_id',$tenant->property)->where('unit_id',$tenant->unit)->count();
                $result['unit']=PropertyUnit::find($tenant->unit);

                return view('dashboard.tenant', compact('result','tenant'));
            }

            if (\Auth::user()->type == 'maintainer') {
                $maintainer=Maintainer::where('user_id',\Auth::user()->id)->first();
                $result['totalRequest']=MaintenanceRequest::where('maintainer_id',\Auth::user()->id)->count();
                $result['todayRequest']=MaintenanceRequest::whereDate('request_date', '=', date('Y-m-d'))->where('maintainer_id',\Auth::user()->id)->count();

                return view('dashboard.maintainer', compact('result','maintainer'));
            }

            $result['totalProperty'] = Property::where('parent_id', parentId())->count();
            $result['totalUnit'] = PropertyUnit::where('parent_id', parentId())->count();
            $result['totalIncome'] = InvoicePayment::where('parent_id', parentId())->sum('amount');
            $result['totalExpense'] = Expense::where('parent_id', parentId())->sum('amount');
            $result['recentProperty'] = Property::where('parent_id', parentId())->orderby('id', 'desc')->limit(5)->get();
            $result['recentTenant'] = Tenant::where('parent_id', parentId())->orderby('id', 'desc')->limit(5)->get();
            $result['incomeExpenseByMonth'] = $this->incomeByMonth();
            $result['settings']=settings();


            return view('dashboard.index', compact('result'));
        } else {
            if (!file_exists(setup())) {
                header('location:install');
                die;
            } else {
                $landingPage=getSettingsValByName('landing_page');
                if($landingPage=='on'){
                    return view('layouts.landing');
                }else{
                    return redirect()->route('login');
                }
            }

        }

    }




    public function incomeByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $payment = [];
        while ($currentdate <= $end) {
            $payment['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $payment['income'][] = InvoicePayment::where('parent_id', parentId())->whereMonth('payment_date', $month)->whereYear('payment_date', $year)->sum('amount');
            $payment['expense'][] = Expense::where('parent_id', parentId())->whereMonth('date', $month)->whereYear('date', $year)->sum('amount');
            $currentdate = strtotime('+1 month', $currentdate);
        }

        return $payment;

    }

}
