<?php

namespace App\Services;

use App\Models\Type;
use App\Models\ViewResult;

class TypeService
{
    public function all($paginateCount =  null)
    {
        $result = new ViewResult();
        try {
            $types =  Type::where('biz_status', Utility::$BIZ_STATUS['active'])
                ->where('status', Utility::$ROW_STATUS['normal'])->orderBy('id', 'asc');
            if ($paginateCount)
                $result->list =  $types->paginate($paginateCount);
            else
                $result->list = $types->get();
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }

        return $result;
    }
    
    public function nearestTypesById($id)
    {
        $result = new ViewResult();
        try {
            $prevCount = ($id - 3) - 1;
            $up = Type::orderBy('id', 'asc')->skip($prevCount < 0 ? 0 : $prevCount)->take(3 + 1);
            $down = Type::orderBy('id', 'asc')->skip($id)->take(3);
            $result->list = $down->union($up)->orderBy('id', 'asc')->get();
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }

        return $result;
    }
    public function create($type)
    {
        $result = new ViewResult();
        try {
            $type->id = Type::max('id') + 1;
            $type->save();
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function update($type)
    {
        $result = new ViewResult();
        try {
            Type::where('id', $type->id)->update([
                'code' => $type->code,
                'title' => $type->title,
                'body' => $type->body,
                'allow_detail' => $type->allow_detail,
                'allow_body' => $type->allow_body,
                'is_unique' => $type->is_unique,
                'allow_pagination' => $type->allow_pagination
            ]);
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = new ViewResult();
        try{
            $result->success = Type::findOrFail($id)->delete();
        }catch(\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
}
