<?php

namespace App\Services;

use App\Models\Forehead;
use App\Models\ForeheadCarousel;
use App\Models\ViewResult;

class CarouselService
{
    public function get()
    {
        $result = new ViewResult();
        try {
            $result->data = Forehead::first();
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateOrCreateParent($forehead)
    {
        $result = new ViewResult();
        try {
            $old = Forehead::find($forehead->id);
            if ($old) {
                //update
                if ($forehead->where('id', $forehead->id)->update([
                    "title" => $forehead->title,
                    "body" => $forehead->body,
                ])) {
                    $result->success();
                }
            } else {

                if (
                    $forehead->save()
                ) {
                    $result->success();
                }
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateOrCreateChild($forehead)
    {
        $result = new ViewResult();
        try {
            $old = ForeheadCarousel::find($forehead->id);

            $maxNo = ForeheadCarousel::where('fk_group_id', $forehead->fk_group_id)->max('order');
            if ($maxNo) {
                $forehead->order = $maxNo + 1;
            } else {
                $forehead->order = 1;
            }
            if ($old) {
                //update
                $cols = [
                    "title" => $forehead->title,
                    "body" => $forehead->body,
                    'fk_group_id' => $forehead->fk_group_id,
                    'order' => $forehead->order,
                ];

                if ($old->image_url == null && $forehead->imageFile != null) {
                    $cols['image_url'] = $forehead->image_url;
                } else if ($old->image_url !== null && $forehead->imageFile != null) {
                    $forehead->image_url = $old->image_url;
                    Utility::deleteImage($old->image_url);
                    $cols['image_url'] = $forehead->image_url;
                }
                if (!$forehead->where('id', $forehead->id)->update($cols)) {
                    throw new \Exception("Error Processing Forehead", 500);
                }
                if ($forehead->imageFile != null) {
                    $imageName = explode(DIRECTORY_SEPARATOR, $forehead->image_url);
                    if (!$forehead->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                        throw new \Exception("Error Storing Image", 500);
                    }
                }
                $result->success();
            } else {
                $fk_forehead_id = Forehead::first()->id;
                $forehead->fk_forehead_id = $fk_forehead_id;
                if (!$forehead->save()) {
                    throw new \Exception("Error Processing Forehead", 500);
                }
                if ($forehead->imageFile != null) {
                    if (!$forehead->imageFile->store(Utility::$IMAGE_PATH)) {
                        throw new \Exception("Error Storing Image", 500);
                    }
                }
                $result->success();
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function reOrder($request)
    {
        $result = new ViewResult();
        try {
            foreach ($request->list as $id => $orderNo) {
                $ah = new ForeheadCarousel();
                if (!$ah::where('id', '=', $id)->update([
                    'order' => $orderNo,
                ])) {
                    throw new \Exception("Error Processing Article", 500);
                }
                error_log($id . ' - ' . $orderNo);
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function deleteCaroursel($id)
    {
        $result = new ViewResult();
        try {
            ForeheadCarousel::find($id)->delete();
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
}
