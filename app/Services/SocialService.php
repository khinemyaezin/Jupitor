<?php
namespace App\Services;

use App\Models\Social;
use App\Models\ViewResult;
use Exception;

class SocialService implements GlobalService
{
    public function all($paginateCount, $request = null)
    {
        $result = new ViewResult();
        try {
            $result->list = Social::orderBy('created_at', 'desc')->paginate($paginateCount);
            foreach ($result->list as $key => $value) {
                $value->image_url  =str_replace('\\', '/', asset('storage/' .  $value->image_url));
            }
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function create($data)
    {
        $result = new ViewResult();
        try {
            if (!$data->save()) {
                throw new Exception('Fail to save [Social]');
            }

            if ($data->imageFile != null) {
                if (!$data->imageFile->store(Utility::$IMAGE_PATH)) {
                    throw new Exception("Fail to save [Image]", 500);
                }
            }
            $result->success();

        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function update($data)
    {
        $result = new ViewResult();
        try {
            $old = Social::find($data->id);
            $cols = [
                'title' => $data->title,
            ];
            if (($old->image_url == null && $data->imageFile != null) || $data->imageFile != null) {
                $cols['image_url'] = $data->image_url;
            } else if ($old->image_url !== null && $data->imageFile != null) {
                $data->image_url = $old->image_url;
            }
            Social::where('id', $data->id)->update($cols);
            if ($data->imageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $data->image_url);
                if (!$data->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new Exception("Fail to save [Image]", 500);
                }
            }
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }

    public function getById($id)
    {
        $result = new ViewResult();
        try {
            $result->data = Social::findOrFail($id);
            $result->data->image_url  =str_replace('\\', '/', asset('storage/' .  $result->data->image_url));
            $result->success();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException$e) {
            return $e;
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
            Social::find($id)->delete();
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
            return $result;
        }
        return $result;
    }

}
