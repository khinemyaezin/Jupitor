<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QuotationExport;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Services\QuotationService;
use App\Services\Utility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'fname' => 'max:50',
            'fphone' => 'numeric',
            'fcreated_at' => ['date_format:Y-m-d'],
        ], [
            'max' => 'The :attribute is invalid.',
            'numeric' => 'The :attribute is invalid.',
            'date_format' => 'The :attribute is invalid.',
        ],[
            'fname' => 'given user name',
            'fphone' => 'given phone number',
            'fcreated_at' => 'given created date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        return view('admin\quotation', [
            'result' => resolve(QuotationService::class)->all(Utility::$PAGINATION_COUNT, request()),
        ]);
    }
    public function getById($id)
    {
        return view('admin\quotation_detail',[
            'data'=> Quotation::findOrFail($id)
        ]);
    }
    public function changeStatus($id)
    {
        $request = request();
        DB::beginTransaction();
        $validator = validator($request->all(), [
            'biz_status' => 'required',
        ]);
        if ($validator->fails()) {
            response()->json(Utility::jsonError($validator));
        }
        $result = resolve(QuotationService::class)->updateStatus(request(), $id);
        if ($result->completeTransaction()) {
            $result->message = 'Status changes Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        $result = resolve(QuotationService::class)->delete($id);
        if ($result->completeTransaction()) {
            $result->message = 'Deleted Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function export() 
    {
        return Excel::download(new QuotationExport, 'quotation_request.xlsx');
    }

}
