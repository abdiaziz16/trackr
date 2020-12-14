<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Requests;
use App\Models\Status;
//use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $newRequests = Requests::where('requestStatus','=',1)->get();

        $newRequests = $this->getNewRequests('new');
        $approvedRequets = $this->getNewRequests('approved');
        $reviewedRequests = $this->getNewRequests('reviewed');

        $changeTypes = $this->getAllChangeTypes();

        return view('home',['newRequests'=>$newRequests,'approvedRequests'=>$approvedRequets,'reviewedRequests'=>$reviewedRequests,'changeTypes'=>$changeTypes]);
    }

    public function reports(){
        $statuses = DB::table('status_types')->get();

        return view('reports',['statuses'=>$statuses]);
    }

    public function create(Request $request){

        try{
            $request = $request->all();

            $newRequest = new Requests();
            $newRequest->created_at = $request['date'];;
            $newRequest->requestorID = \Auth::user()->id;
            $newRequest->department = $request['department'];
            $newRequest->requestType = isset($request['requestType']) ? $request['requestType'] : 0 ;
            $newRequest->changeType = isset($request['changeType']) ? $request['changeType'] : 0;
            $newRequest->description = $request['descriptionInput'];
            $newRequest->riskAssessment =$request['riskInput'];
            $newRequest->functions = $request['functionInput'];
            $newRequest->requestStatus = 1;
            $newRequest->save();
            Session::flash('message', 'Request Added Succesfully!');
            Session::flash('alert-class', 'alert-success');
        }catch(\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }

        return Redirect::back();

    }

    public function createLog(Request $request){

        try{
            $request = $request->all();

            $newLog = new Logs();
            $newLog->date = $request['date'];
            $newLog->changeType = $request['changeType'];
            $newLog->logMessage = $request['logMessage'];

            $newLog->save();

            Session::flash('message', 'Log was successfully created');
            Session::flash('alert-class', 'alert-success');
        }catch(\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }

        return Redirect::back();
    }

    public function getNewRequests($reqType){
        $newID = DB::table('status_types')
            ->select('id')
            ->where('status', '=', $reqType)->first();

        $newRequests =DB::table('requests')
            ->select('requests.*','users.name','change_types.change_type')
            ->join('users','users.id','=','requests.requestorID')
            ->join('change_types','change_types.id','=','requests.ChangeType')
            ->where('requests.requestStatus','=',$newID->id)->get();

        return $newRequests;
    }

    public function approve(Request $request, $id)
    {
        try {
            switch ($request['action']) {
                case 'approve':
                    $approveID = $this->getStatusID('approved');
                    Session::flash('message', 'Request approved successfully!');
                    Session::flash('alert-class', 'alert-success');
                    break;
                case 'reject':
                    $approveID = $this->getStatusID('rejected');
                    Session::flash('message', 'Request rejected!');
                    Session::flash('alert-class', 'alert-danger');
                    break;
                default:
                    # code...
                    break;
            }

            DB::table('requests')
                ->where('id', $id)
                ->update(['requestStatus' => $approveID->id,'approverID'=>\Auth::user()->id]);

        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function review(Request $request, $id)
    {
        try {

            switch ($request['action']) {
                case 'approve':
                    $reviewedID = $this->getStatusID('reviewed');
                    Session::flash('message', 'Review Completed Successfully!');
                    Session::flash('alert-class', 'alert-success');
                    break;
                case 'reject':
                    $reviewedID = $this->getStatusID('new');
                    Session::flash('message', 'Approval Denied');
                    Session::flash('alert-class', 'alert-danger');
                    break;
                default:
                    # code...
                    break;
            }

            DB::table('requests')
                ->where('id', $id)
                ->update(['requestStatus' => $reviewedID->id,'reviewerID'=>\Auth::user()->id]);
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function generateReport(Request $request){
        try {
            switch ($request['action']) {
                case 'generate':
                    Session::flash('message', 'Report Generated Successfully!');
                    Session::flash('alert-class', 'alert-success');
                    break;
                case 'export':
                    return \Route::dispatch(\Request::create('download', 'GET'));
                    Session::flash('message', 'Report Exported Successfully!');
                    Session::flash('alert-class', 'alert-success');
                    break;
                    break;
                default:
                    # code...
                    break;
            }
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function complete(Request $request, $id)
    {
        try {
            switch ($request['action']) {
                case 'approve':
                    $completedID = $this->getStatusID('complete');
                    Session::flash('message', 'Sign off completed Successfully!');
                    Session::flash('alert-class', 'alert-success');
                    break;
                case 'reject':
                    $completedID = $this->getStatusID('approved');
                    Session::flash('message', 'Sign off Denied');
                    Session::flash('alert-class', 'alert-danger');
                    break;
                default:
                    # code...
                    break;
            }

            DB::table('requests')
                ->where('id', $id)
                ->update(['requestStatus' => $completedID->id,'completedBy'=>\Auth::user()->id]);
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function getStatusID($status){
        $id = DB::table('status_types')
            ->select('id')
            ->where('status', '=', $status)->first();

        return $id;
    }

    public function getAllChangeTypes (){
        $changeTypes = DB::table('change_types')->get();
        return $changeTypes;
    }

    public function getAllRequests(){
        $requests = DB::table('requests')->get();
        return view('request_report',compact('requests'));

    }
    public function downloadReport(){

        $statusID = $this->getStatusID('rejected');


        $requests = DB::table('requests')
            ->where('requestStatus','!=',$statusID->id)
            ->get();
        $pdf = PDF::loadVIew('request_report',compact('requests'));

        return $pdf->download('requests.pdf');
    }


}
