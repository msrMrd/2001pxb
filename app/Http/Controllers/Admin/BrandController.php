<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        $brand_url=request()->brand_url;
        if($brand_url){
            $where[]=['brand_url','like',"%$brand_url%"];
        }
        // dump(request()->all());
        $brand=Brand::where($where)->orderBy('brand_id','desc')->paginate(2);
        if(request()->ajax()){
            return view('admin.brand.ajaxpage',['res'=>$brand,'query'=>request()->all()]);
        }
        // dd($brand);
        return view('admin.brand.index',['res'=>$brand,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function upload(Request $request){
    //     // $file=$request->file;
    //     // dd($file);

    //     if ($request->hasFile('file') && $request->file('file')->isValid()) {
    //         $photo = $request->file;

    //         $store_result = $photo->store('upload');
    //         return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);

    //         }
    //         return json_encode(['code'=>2,'msg'=>'上传失败']);
            
    //         }
    public function upload(Request $request){

        // dd($file);
        // echo 123;
        // $file = $request->file;
        // dd($file);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo=$request->file;
        $store_result = $photo->store('upload');
        $data=env('UPLOAD_URL').$store_result;
        // dd($data);
        return json_encode(['code'=>0,'msg'=>'上传成功',"data"=>$data]);
        }
       return json_encode(['code'=>2,'msg'=>'上传失败']);

        }

    public function chang(Request $request){
            $brand_name=$request->brand_name;
            $id=$request->id;
            // dump($id);
            // dump($brand_name);
            if(!$brand_name || !$id){
                // return response()->json(['code'=>3,'msg'=>'缺少参数']);
                return $this->error('缺少参数');
            }
            $res=Brand::where('brand_id',$id)->update(['brand_name'=>$brand_name]);
            if($res){
                // return response()->json(['code'=>0,'msg'=>'修改成功']);
                return $this->success('修改成功'); 
            }
    }
    public function create()
    {
        //
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
            ],[
                'brand_name.required'=>'名字不能为空',
                'brand_name.unique'=>'名字已存在',
                'brand_url.required'=>'网站不能为空'
            ]);


        // echo 1231321;
        $post=request()->except('_token','file');  //except 去除那个  
        // dd($post);
        $brand=Brand::insert($post);
        // dd($brand);
        if($brand){
            return redirect('admin/brand/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::find($id);
        // dd($brand);
        return view('admin.brand.edit',['data'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            // echo $id;
         // $request->validate([
         //    'brand_name' => 'required|unique:brand',
         //    'brand_url' => 'required',
         //    ],[
         //        'brand_name.required'=>'名字不能为空',
         //        'brand_name.unique'=>'名字已存在',
         //        'brand_url.required'=>'网站不能为空'
         //    ]);


        // echo 1231321;
        $post=request()->except('_token','file');  //except 去除那个  
        // dd($post);
        $brand=Brand::where('brand_id',$id)->update($post);
        // dd($brand);
        if($brand){
            return redirect('admin/brand/index');
        }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // echo $id;die;
        $de=Brand::destroy($id);
        // // dd($de);
        if(request()->ajax()){
            return response()->json(['code'=>0,'msg'=>'删除成功！']);
        }
        if($de){
            return redirect('admin/brand/index');
        }
    }
    public function del(){
        $data = request()->all();
        $da = $data["ids"];

        foreach ($da as $k => $v) {
            $de=Brand::destroy($v);

        }
        if($da){
            return $message = [
                "code"=>00001,
                "message"=>"删除成功",
                "success"=>true,
            ];
        }
    }
}
