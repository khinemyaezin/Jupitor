<?php
namespace App\Services;

use App\Models\Quotation;
use App\Models\ViewResult;

class QuotationService
{
    public function create($data)
    {
        $result = new ViewResult();
        try {
            if ($data->save()) {
                $result->success();
            }

        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    
    public function all($paginateCount, $request)
    {
        $result = new ViewResult();
        try {
            $query = Quotation::sortable();
            if ($request->fname) {
                $query->where('name', 'ilike', '%' . $request->fname . '%');
            }
            if ($request->femail) {
                $query->where('email', 'like', '%' . $request->femail . '%');
            }
            if ($request->fphone) {
                $query->where('phone', 'like', '%' . $request->fphone . '%');
            }
            if ($request->fcreated_at) {
                $query->whereRaw('DATE(created_at) = ?', [$request->fcreated_at]);
            }
            if ($request->fbiz_status && $request->fbiz_status != '-1') {
                $query->where('biz_status', intval($request->fbiz_status));
            }
            $result->list = $query->orderBy('created_at', 'desc')->paginate($paginateCount);
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateStatus($request, $id)
    {
        $result = new ViewResult();
        try {
            Quotation::where('id', $id)->update([
                'biz_status' => $request->biz_status,
            ]);
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = new ViewResult();
        try {
            Quotation::find($id)->delete();
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);

        }
        return $result;
    }
}
