<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemFileController extends SystemController
{
    protected $controller_event_text = "系统文件";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemFile())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'title' => 'required|min:1',
                    'description' => 'min:0',
                    'url' => 'required|min:1',
                    'local_path' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = SystemFile::findOneByID($id);
                } else {
                    $model = new SystemFile();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->id);
                    return $this->successResponse();
                }
            } catch (\Exception $e) {
                return $this->failResponse($e->getMessage());
            }
        }
        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemFile::findOneByID($id)) {
                $this->deleteEvent($model->id);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $request){
        // 使用hasFile方法判断文件在请求中是否存在
        // 验证文件是否上传成功 使用isValid方法判断文件在上传过程中是否出错
        if ( $request->hasFile( 'images' ) && $request->file( 'images' )->isValid() ) {

            $file = $request->file( 'images' );

// 文件扩展名
            $extension = $file->getClientOriginalExtension();
            // 文件名
            $fileName = $file->getClientOriginalName();
            // 生成新的统一格式的文件名
            $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
            // 图片保存路径
            $savePath = 'images/' . $newFileName;
            // Web 访问路径
            $webPath = '/storage/' . $savePath;
            // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在，如果存在直接返回
            if (Storage::disk('public')->exists($savePath)) {
                return response()->json(['url' => Storage::disk('public')->url($webPath)]);
            }
//            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($path = $file->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
                return $this->successResponse(['url' => Storage::disk('public')->url($path)]);
            }
            return $this->failResponse('文件上传失败');
        }
        return $this->failResponse( '请选择要上传的文件');
    }
}
