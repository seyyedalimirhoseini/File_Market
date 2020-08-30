@extends('Admin.layout.master')
@section('title')
صفحه ویرایش دسته بندی
@endsection
@section('content')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>ویرایش دسته بندی</h5>
                </div>
                <div class="widget-content ">
                 <div class="control-group">
                    <form  method="post" action="{{route('admin.category.update',$category->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
                        @csrf

                        <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">ویرایش نام دسته بندی:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{$category->name}}" required>
                                <span class="text-danger" id="chCategory_name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">دسته بندی اصلی:</label>
                            <div class="controls" style="width: 245px;">
                                <select name="parent_id" id="parent_id">
                                    {{--@foreach($cate_levels as $key=>$value)
                                        <option value="{{$key}}" {{($edit_category->parent_id==$key)?' selected':''}}>{{$value}}</option>
                                    @endforeach--}}

                                    @foreach($categories as $key=>$value)
                                        <option value="{{$key}}"{{($category->parent_id==$key)?' selected':''}}>{{$value}}</option>
                                        <?php
                                        if($key!=0){
                                            $subCategory=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                            if(count($subCategory)>0){
                                                foreach ($subCategory as $subCate){
                                                    echo '<option value="'.$subCate->id.'">&nbsp;&nbsp;--'.$subCate->name.'</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group{{$errors->has('status')?' has-error':''}}">
                            <label class="control-label">فعال :</label>
                            <div class="controls">
                                <input type="checkbox" name="status" id="status" value="1" {{$category->status==1 ? "checked":''}}>
                                <span class="text-danger">{{$errors->first('status')}}</span>
                            </div>
                        </div>


                        <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls">
                                <input type="submit" value="بروزرسانی" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
