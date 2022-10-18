@extends('admin.layouts.includes.master')
@section('title') تعديل اضافة اذن @endsection
@section('content')
    <script src="{{asset('public/select/jquery.min.js')}}"></script>
    <!-- CSS forsearching -->
    <link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet"/>
    <!-- JS for searching -->
    <script src="{{asset('public/select/select2.min.js')}}"></script>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">اضافة اذن</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('permission.update' , $permissions->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$permissions->date}}" required>
                                        <label for="date" class="col-form-label">التاريخ </label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control drop js-example-basic-single" name="classroom_id"
                                            id="classroom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}" @if ($permissions->classroom_id ==
                                                $classRoom->id) selected @endif>{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="classroom_id" class="col-form-label">اختر القاعة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control js-example-basic-single" name="addChild_id" id="addChild_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach ($addChlidren as $addChlid)
                                            <option value="{{ $addChlid->id }}" @if ($permissions->addChild_id == $addChlid->id) selected @endif>{{$addChlid->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="addChild_id" class="col-form-label">اختر الطفل</label>
                                    </div>
                                    <div class="col-sm-4 mt-3 form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الاذن ..."
                                            name="permission_reason">{{$permissions->permission_reason}}</textarea>
                                        <label for="note" class="col-form-label">سبب اذن</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary"   title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('permission.create')}}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
