@extends('admin.layui.left')
@section('content')
  <form action="">
    <input type="text" placeholder="请输入品牌名称" name="brand_name" >
    <input type="text" placeholder="请输入品牌网址" name="brand_url" >
    <button class="layui-btn layui-btn-normal">搜索</button>
  </form>
    <div style="padding: 15px;">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>
    <a href="/">品牌</a>
  <a href="admin/brand/store">品牌添加</a>
  <a><cite>导航元素</cite></a>
</legend>

<table class="layui-table">
    <colgroup>
      <col width="150">
      <col width="150">
      <col width="200">
      <col>
    </colgroup>
    <thead>
      <tr>
        <th id="checkAll"><input type="checkbox" name="likels" lay-skin="primary"></th>
        <th>序号</th>
        <th>品牌名称</th>
        <th>品牌url</th>
        <th>品牌logo</th>
        <th>品牌简介</th>
        <th>操作    
              <button class="butt">点击批删</button>
    </th>

      </tr> 
    </thead>
    <tbody>
      @foreach($res as $k=>$v)
      <tr>
        <td class="check">
          <input type="checkbox" value="{{$v->brand_id}}" id="xuan" name="likel" >
        </td>
        <td class="aaa" brand_id="{{$v->brand_id}}">{{$v->brand_id}}</td>
        <td id="{{$v->brand_id}}"><span class="brand_name">{{$v->brand_name}}</span></td>
        <td>{{$v->brand_url}}</td>
        <td>@if($v->brand_logo)
          <img src="{{$v->brand_logo}}">
      @endif
        </td>
        <td>{{$v->brand_desc}}</td>
        <td>
              <a href="{{url('admin/brand/edit/'.$v->brand_id)}}" class="layui-btn layui-btn-primary" >修改</a>

              <!-- <a href="{{url('admin/brand/delete/'.$v->brand_id)}}" class="layui-btn layui-btn-danger">删除</a> -->
        <!-- <a href="jacascript:void(0)" onclick="if(confirm('确认删除记录')){location.href='{{url('admin/brand/delete/'.$v->brand_id)}}';}" class="layui-btn layui-btn-danger">删除</a> -->
            <a href="jacascript:void(0)" onclick="deleteByID({{$v->brand_id}},this)" class="layui-btn layui-btn-danger">删除</a>
        </td>
      </tr>
      @endforeach
      
      <tr>
        <td colspan="7">
              {{$res->appends($query)->links('vendor.pagination.adminshop')}}  
        </td>
      </tr>
    </tbody>
    
  </table>  
  <script src="/static/admin/layui/layui.js"></script>

	<script src="/static/admin/js/jquery.js"></script>
  <script>
  //JavaScript代码区域
  layui.use(['element','form'], function(){
        var element = layui.element;
      var form=layui.form;

    });
    //即点即改
    $(document).on('click','.brand_name',function(){
      // alert(12131);
      var brand_name=$(this).text();
      var id=$(this).parent().attr('id');
      $(this).parent().html('<input type=text class="changename input_name'+id+'" value='+brand_name+'>');
      $('.input_name'+id).val('').focus().val(brand_name);
    });
    $(document).on('blur','.changename',function(){
      // alert(1111);
      var nename=$(this).val();
      var id=$(this).parent().attr('id');   
      var obj=$(this);
      // $.ajax({
      //  type:'get',
      //  data:{id:id,brand_name:nename},
      //  url:'/admin/brand/chang/',
      //  success:function(res){
      //    alert(res.msg);
        // history.go(0);
      //  }
      // })
      $.get('/admin/brand/chang/',{id:id,brand_name:nename},function(res){
        // alert(123);
        alert(res.msg);
        if(res.code==0){
          obj.parent().html('<span class="brand_name">'+nename+'</span>');
        }
      },'json')

    });
    //批量删除
    $("#checkAll input").click(function(){
      var ad=$(this).prop("checked");
      // alert(ad);
      if(ad){
        $(".check input").prop("checked",true);
      }else{
      $(".check input").prop("checked",false);
      }
    })
    $(document).on('click','.butt',function(){
      // var _this=$(this)
      // var checked=$("#xuan:checked");
      // var brand_id="";
      // checked.each(function(index){
      //  brand_id+=_this.next().next().children().children(".aaa").attr("brand_id")+",";
      // })
      // alert(brand_id);
      var ids=[];
      $("input[name='likel']:checked").each(function(){
        ids.push($(this).val());  
      });
      var data = {};
      data.ids = ids;
        $.ajax({
          type:'get',
          data:data,
          url:'/admin/brand/del/',
          success:function(res){
            if(res.success==true){
              alert(res.message);
              history.go(0);

            }
            
          }
        })
      })
      //ajax 删除
      function  deleteByID(brand_id,obj) {
        if(!brand_id){
          return ;
        }    
        $.get('/admin/brand/delete/'+brand_id,function(res){
          alert(res.msg);
          // console.log(res)
          // $(obj).parents('tr').remove();
          location.reload();
        },'json')
      }

      //ajax分页
      // $('.layui-laypage a').click(function(){
      $(document).on('click','.layui-laypage a',function(){ 
        // alert(12321);
        var url=$(this).attr('href');
         $.get(url,function(res){
          // alert(res);
          $('tbody').html(res);
          layui.use(['element','form'], function(){
          var element = layui.element;
        var form=layui.form;
        form.render();
        });
          })
        // alert(url);
        return false;
      })
  </script>

@endsection
