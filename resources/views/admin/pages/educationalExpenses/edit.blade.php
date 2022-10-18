@extends('admin.layouts.includes.master')
@section('title') تعديل الرسوم الدراسية @endsection
@section('content')
<script src="{{ asset('public/assets/plugins/jquery/jquery.min.js') }}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-info">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">الرسوم الدراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{route('educationalExpenses.update', $educationalExpenses->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input required type="text" class="form-control"
                                            value="{{$educationalExpenses->name}}" id="name" placeholder="التاريخ"
                                            name="name">
                                        <label for="name" class="col-form-label">اسم الرسم</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="notes"
                                            id="note">{{$educationalExpenses->notes}}</textarea>
                                        <label for="note" class=" col-form-label">ملاحظات </label>
                                    </div>
                                    <div class="form-check col-sm-4">
                                        <label class="switch switch-2-5" for="switch-2-5">
                                            <input type="checkbox" name="active" value="1"
                                                @if($educationalExpenses->active ==
                                            1)
                                            checked @endif id="switch-2-5">
                                            <span class="slider round slider-2-5"></span>
                                        </label>
                                        <label class="form-check-label" for="switch-2-5">
                                            تفعيل
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control items_id js-example-basic-single"
                                            name="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($leavels as $key => $leavel)
                                            <option value="{{$leavel->id}}" @if($educationalExpenses->level_id ==
                                                $leavel->id) selected @endif>{{$leavel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <input type="number" class="form-control"
                                            value="{{$educationalExpenses->amount}}" id="name" placeholder="المبلغ"
                                            name="amount">
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a
                                        href="{{route('educationalExpenses.create')}}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            {{-- end card table --}}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<script>
    let add = document.getElementById('add'),
            tbody = document.getElementById('tbody');

        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            // new_row.classList.add('row')
            // new_row.classList.add('mb-3')
            // new_row.classList.add('align-items-center')
            new_row.innerHTML =
                `
    <td style=" width: 25%;">
            <select class="form-control items_id"
                onchange="selectValue('items_id0',0)" name="data[leavel_id][]"
                id="items_id0">
                <option>اختر المرحلة</option>
                @foreach($leavels as $key => $leavel)
                <option value="{{$leavel->id}}">{{$leavel->name}}</option>
                                                    @endforeach
                </select>
            </td>
            <td style=" width: 25%;">
                <input type="name" class="form-control" id="name" placeholder="المبلغ"
            name="data[amount][]">
                </select>
            </td>
                    <td>
                        <button type="button" class="btn bg-danger" onclick='delet(this)'>
                            <i class="fas fa-trash-alt text-light"></i>
                        </button>
                    </td>`;
            tbody.appendChild(new_row)
        })

        function delet(ele) {
            ele.parentElement.parentElement.remove()
        }
</script>
@endsection
