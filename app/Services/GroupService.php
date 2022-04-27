<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Type;
use App\Models\ViewResult;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use stdClass;

class GroupService
{
    public function getForPage($typecode)
    {
        $result = new ViewResult();
        try {
            $result->list = Group::join('type', 'type.id', '=', 'group.fk_type_id')
                ->where('group.biz_status', Utility::$BIZ_STATUS['active'])
                ->where('type.code', $typecode)->orderBy('group.order', 'asc')
                ->get('group.*');
            if (!$result->list) {
                throw new ModelNotFoundException();
            }
            foreach ($result->list as $key => $value) {

                $value->articles;
                $value->articlesCount = $value->articles->count();
                $value->type;
                $value->theme;
                $value->groupTheme;
                if ($value->image_url) {
                    $value->image_url = str_replace('\\', '/', asset('storage/' . $value->image_url));
                }
                foreach ($value->articles as $key => $a) {
                    $a->theme;
                    if ($a->image_url) {
                        $a->image_url = str_replace('\\', '/', asset('storage/' . $a->image_url));
                    }
                }
            }

            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;

        return $result;
    }
    public function getAll()
    {
        $result = new ViewResult();
        $result->list = Group::orderBy('order', 'asc')->get();
        foreach ($result->list as $key => $value) {
            $value->type;
            $value->theme;
        }
        $result->success();
        return $result;
    }
    public function getForNavbar()
    {
        $result = new ViewResult();
        $result->list = Group::where('biz_status', Utility::$BIZ_STATUS['active'])
            ->where('on_navbar', true)
            ->orderBy('order', 'asc')->get();
        foreach ($result->list as $key => $value) {
            $value->articles;
        }
        $result->success();
        return $result;
    }
    public function getForHome()
    {
        $result = new ViewResult();
        $result->list = Group::where('on_home', true)
            ->where('biz_status', Utility::$BIZ_STATUS['active'])
            ->where('status', Utility::$ROW_STATUS['normal'])
            ->orderBy('order', 'asc')->get();
        foreach ($result->list as $key => $value) {
            if ($value->show_all) {
                $value->articles;
            } else {
                $articles = $value->articles()->select([
                    'id', 'title', 'body', 'fk_group_id', 'image_url', 'btn_detail', 'fk_theme_id'
                ]);
                $value->articlesCount = $articles->count();
                $value->articles = $articles->limit($value->max_items)->get();
            }
            $value->type;
            $value->theme;
            $value->groupTheme;
            if ($value->image_url) {
                $value->image_url = str_replace('\\', '/', asset('storage/' . $value->image_url));
            }
            foreach ($value->articles as $key => $a) {
                $a->theme;
                if ($a->image_url) {
                    $a->image_url = str_replace('\\', '/', asset('storage/' . $a->image_url));
                }
            }
        }
        return $result;
    }

    public function getServices()
    {
        $result = new ViewResult();
        $result->list = Group::join('type', 'type.id', '=', 'group.fk_type_id')
            ->where('type.code', 'service')
            ->where('group.on_navbar', true)
            ->get('group.*');
        $result->success();
        return $result;
    }
    public function getAbout()
    {
        return $this->getForPage('about');
    }
    public function getAllWithArticles()
    {
        $result = new ViewResult();
        $result->list = Group::orderBy('order', 'asc')->get();
        foreach ($result->list as $key => $value) {
            $value->articles;
            $value->type;
            $value->theme;
            $value->groupTheme;
            foreach ($value->articles as $key => $a) {
                if ($a->image_url) {
                    $a->image_url = str_replace('\\', '/', asset('storage/' . $a->image_url));
                }
            }
        }
        return $result;
    }

    public function getById($id)
    {
        $result = new ViewResult();
        $result->data = Group::findOrFail($id);
        $result->data->image_url = str_replace('\\', '/', asset('storage/' . $result->data->image_url));
        foreach ($result->data->articles as $key => $a) {
            $a->theme;
            if ($a->image_url) {
                $a->image_url = str_replace('\\', '/', asset('storage/' . $a->image_url));
            }
        }
        $result->success();
        return $result;
    }

    public function create(Group $group): ViewResult
    {
        $result = new ViewResult();
        try {
            //check
            $group->max_items = $group->show_all ? 0 : $group->max_items;
            $temp = new stdClass();
            $temp->type_id = $group->fk_type_id;
            $temp->group_id = null;
            $iden = $this->checkSystemPageDuplicate($temp);

            if ($iden->data && $iden->isSuccess()) {
                return $this->update($group, $iden->data);
            }
            $maxNo = Group::max('order');
            if ($maxNo) {
                $group->order = $maxNo + 1;
            } else {
                $group->order = 1;
            }

            if (!$group->save()) {
                throw new \Exception("Error Processing Group", 500);
            }
            if ($group->imageFile != null) {
                if (!$group->imageFile->store(Utility::$IMAGE_PATH)) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->success();
            $result->data = $group;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }

    public function update(Group $group, $iden = null): ViewResult
    {
        $result = new ViewResult();
        try {
            //check
            $group->max_items = $group->show_all ? 0 : $group->max_items;
            $old = null;
            if ($iden) {
                $group->id = $iden->id;
                $group->articles()->delete();
            } else {
                $temp = new stdClass();
                $temp->type_id = $group->fk_type_id;
                $temp->group_id = $group->id;
                $iden = $this->checkSystemPageDuplicate($temp);
                if ($iden->data && $iden->isSuccess()) {
                    $deleteResult = $this->delete($iden->data->id);
                    if (!$deleteResult->isSuccess()) {
                        throw new \Exception("Error delete duplicate data", 500);
                    }
                }
            }

            $old = Group::find($group->id);

            $cols = [
                'title' => $group->title,
                'highlight' => $group->highlight,
                'fk_type_id' => $group->fk_type_id,
                'fk_group_theme_id' => $group->fk_group_theme_id,
                'on_home' => $group->on_home,
                'on_navbar' => $group->on_navbar,
                'dropdown_on_navbar' => $group->dropdown_on_navbar,
                'show_all' => $group->show_all,
                'max_items' => $group->max_items,
                'has_title' => $group->has_title
            ];

            if ($old->image_url == null && $group->imageFile != null) {
                $cols['image_url'] = $group->image_url;
            } else if ($old->image_url !== null && $group->imageFile != null) {
                Utility::deleteImage($old->image_url);
                $cols['image_url'] = $group->image_url;
            }

            $group->where('id', $group->id)
                ->update($cols);

            if ($group->imageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $group->image_url);
                if (!$group->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->data = Group::find($group->id);
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
            return $result;
        }
        return $result;
    }

    public function delete($id)
    {
        $result = new ViewResult();
        try {
            if (Group::find($id)->delete()) {
                $result->success();
            } else {
                throw new \Exception("Error deleting group", 500);
            }
            $result->success();
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
                $ah = new Group();
                if (!$ah::where('id', '=', $id)->update([
                    'order' => $orderNo,
                ])) {
                    throw new \Exception("Error Processing Sorting", 500);
                }
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }

    public function checkSystemPageDuplicate($data)
    {
        $result = new ViewResult();
        try {
            $db = Group::join('type', 'type.id', '=', 'group.fk_type_id')
                ->where('type.id', '=', $data->type_id)
                ->where('type.is_unique', true);
            if ($data->group_id) {

                $db->where('group.id', '!=', $data->group_id);
            }
            $result->data = $db->first('group.*');

            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function updateStatus($request, $groupid)
    {
        $result = new ViewResult();
        try {
            Group::where('id', $groupid)->update([
                $request->col_key => $request->action,
            ]);
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
}
