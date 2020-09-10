@extends('admin.layui.left')
@section('content')
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
      <legend><span class="layui-breadcrumb">
      <a href="/">首页</a>
      <a href="/demo/">商品品牌</a>
      <a><cite>添加品牌</cite></a>
      </span></legend>
    </fieldset>
@if ($errors->any())
        <div class="alert alert-danger" style="padding-bottom: 20px;padding-left: 20px">
        <ul>
        @foreach ($errors->all() as $error)
        <li style="margin-top: 10px;color: #ff0000;">{{ $error }}</li>
        @endforeach
        </ul>
        </div>
      @endif
<form class="layui-form" action="{{url('admin/brand/store')}}" method="post">
      @csrf
      <div class="layui-form-item">
        <label class="layui-form-label">品牌名称:</label>
        <div class="layui-input-block">
          <input type="text" name="brand_name" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌网址:</label>
        <div class="layui-input-block">
          <input type="text" name="brand_url" lay-verify="title" autocomplete="off" placeholder="请输入品牌网址" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌logo:</label>
        <div class="layui-input-block">
         <div class="layui-upload-drag" id="test10">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
              <hr>
              <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
          </div>
          <input type="hidden" name="brand_logo">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌简介:</label>
        <div class="layui-input-block">
          <textarea name="brand_desc" placeholder="请输入品牌简介" class="layui-textarea"></textarea>
        </div>
      </div>
      <div class="layui-form-item" align="center">
        <button type="submit" class="layui-btn layui-btn-normal">添加</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
    </form>
    <script src="/static/admin/layui/layui.js"></script>

   
@endsection
