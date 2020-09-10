<?php
namespace App\Http\Response;
//命名空间只用来解决函数，类，常量同名的问题
trait JsonResponse {
	public function error($msg='',$data=[]){
		return 	$this->JsonResponse('-1',$msg,$data);

	}

	public function success($msg='',$data=[]){
		return	$this->JsonResponse('0',$msg,$data);
	}


	public function JsonResponse($code=0,$msg,$data=[]){
			$data=[
				'code'=>$code,
				'msg'=>$msg,
				'data'=>$data,
			];
			return response()->json($data);
	}
}



