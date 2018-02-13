<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;

class Image extends Controller
{
	public function upload(Request $request)
	{
		$file = $request->file('file');
		$info = $file->move(config('UPLOAD_PATH'));
		if($info && $info->getPathname()){
			return $this->success('/' . $info->getPathname());
		}else{
			return $this->error('上传失败!');
		}
	}
}