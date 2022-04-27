<?php

namespace App\Services;

use App\Models\Information;
use App\Models\User;
use App\Models\ViewResult;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SystemService
{
    public function createCompanyInfo(Information $data)
    {
        $result = new ViewResult();
        try {
            $data->save();
            if ($data->imageFile != null) {
                if (!$data->imageFile->store(Utility::$IMAGE_PATH)) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateCompanyInfo(Information $data)
    {
        $result = new ViewResult();
        try {
            $old = Information::first();
            $cols = [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'linkin' => $data->linkin,
                'facebook' => $data->facebook,
                'instagram' => $data->instagram,
                'weekdays' => $data->weekdays,
                'office_start_time'=> $data->office_start_time,
                'office_end_time' => $data->office_end_time
            ];
            if ($old->image_url == null && $data->imageFile != null) {
                $cols['image_url'] = $data->image_url;
            } else if ($old->image_url !== null && $data->imageFile != null) {
                Utility::deleteImage($old->image_url);
                $cols['image_url'] = $data->image_url;
                
            }
            $data->where('id', $old->id)->update($cols);

            if ($data->imageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $data->image_url);
                if (!$data->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function getCompanyInfo()
    {
        $result = new ViewResult();
        try {
            $result->data = Information::first();
            if ($result->data) {
                $result->data->image_url = str_replace('\\', '/', asset('storage/' . $result->data->image_url));
            }

            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function getAccountInfo()
    {
        $result = new ViewResult();
        try {
            $result->data = User::first();
            if ($result->data && $result->data->ismy_url) {
                $result->data->image_url = str_replace('\\', '/', asset('storage/' . $result->data->image_url));
            }

            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function resetAccount()
    {
        $result = new ViewResult();
        try {
            $result->success =  User::truncate();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateAccount($request)
    {
        $result = new ViewResult();
        try {
            $cols = [
                'email' => $request->email,
                'name' => $request->name
            ];
            $user = new User();
            if ($request->hasFile('image_url')) {
                $user->imageFile = $request->file('image_url');
                $user->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $user->imageFile->hashName();
            }

            $old =  User::first();
            if ($old->image_url == null && $user->imageFile != null) {
                $cols['image_url'] = $user->image_url;
            } else if ($old->image_url !== null && $user->imageFile != null) {
                Utility::deleteImage($old->image_url);
                $cols['image_url'] = $user->image_url;
                
            }
            if ($user->imageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $user->image_url);
                if (!$user->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            //ddd($cols);
            $result->success = $user->where('id',$old->id)->update($cols);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function changePassword($oldPassword,$newPassword)
    {
        $result = new ViewResult();
        try {
            $user = User::find(Auth::id());
            if (!Hash::check($oldPassword, $user->password)) {
                throw new Exception('Invalid current password',Utility::$ERROR_DEFCODE);
            }
            $cols = [
                'password' => Hash::make($newPassword)
            ];
            $result->success = $user->update($cols);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
}
