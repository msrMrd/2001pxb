@foreach($res as $k=>$v)
      <tr>
        <td class="check">
          <input type="checkbox" value="{{$v->brand_id}}" id="xuan" name="likel" >
        </td>
        <td>{{$v->brand_id}}</td>
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
              <!-- <button class="butt">点击批删</button> -->
      	</td>
      </tr>