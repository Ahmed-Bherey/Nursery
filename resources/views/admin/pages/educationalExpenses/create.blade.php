@extends('admin.layouts.includes.master')
@section('title') الرسوم الدراسية @endsection
@section('content')

<script src="{{asset('public/select/jquery.min.js')}}"></script>
<!-- CSS forsearching -->
<link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{asset('public/select/select2.min.js')}}"></script>

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
                        <form class="form-horizontal" action="{{route('educationalExpenses.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control" name="year_id">
                                            <option value="">اختر السنة الدراسية</option>
                                            @foreach($educationalyears as $key => $educationalyear)
                                            <option value="{{$educationalyear->id}}">{{$educationalyear->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="year_id" class="col-form-label n_ro3ya">اختر السنة الدراسية</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <input required type="text" class="form-control" id="name" placeholder="التاريخ"
                                            name="name">
                                        <label for="name" class="col-form-label n_ro3ya">اسم الرسم</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="note"
                                            id="note"></textarea>
                                        <label for="note" class=" col-form-label n_ro3ya">ملاحظات </label>
                                    </div>
                                    <div class="form-check col-sm-4">
                                        <label class="switch switch-2-5" for="switch-2-5">
                                            <input type="checkbox" checked value="1" name="active" id="switch-2-5">
                                            <span class="slider round slider-2-5"></span>
                                        </label>
                                        <label class="form-check-label" for="switch-2-5">
                                            تفعيل
                                        </label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>اختر المرحلة</th>
                                            <th>المبلغ</th>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td style="width: 25%;">
                                                <select required class="form-control drop " name="data[leavel_id][]">
                                                    <option value="">اختر المرحلة</option>
                                                    @foreach($leavels as $key => $leavel)
                                                    <option value="{{$leavel->id}}">{{$leavel->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control" id="name" placeholder="المبلغ"
                                                    name="data[amount][]">

                                            </td>
                                            <td>
                                                <button type="button" class="btn bg-success" id="add">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" type="reset">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            {{-- start card table --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">الرسوم الدراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        # </th>

                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الرسوم</th>

                                                    <td>المرحلة</td>
                                                    <td>المبلغ</td>
                                                    <td class="text-center">حالة التفعيل</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        ملاحظات</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($educationalExpenses as $educationalExpense)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $educationalExpense->name }}</td>
                                                    <td>{{ $educationalExpense->leavels->name }}</td>
                                                    <td>{{ $educationalExpense->amount }}</td>
                                                    <td @if($educationalExpense->active == 1) class="text-center"
                                                        @endif>
                                                        <span
                                                            style="background: #00ad818f;color: #fff;border-radius: 8px ; padding: 10px 20px;">
                                                            @if($educationalExpense->active == 1)
                                                            مفعل
                                                            @else
                                                            غير مفعل
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>{{ $educationalExpense->notes }}</td>

                                                    <td>
                                                        <a href="{{ route('educationalExpenses.edit', $educationalExpense->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('educationalExpenses.destroy', $educationalExpense->id) }}"
                                                            type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
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
            <select class="form-control  drop"
                name="data[leavel_id][]"
                >
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
        function delet (ele) {
            ele.parentElement.parentElement.remove()
        }
</script>
<script>
    var $drops = $('.drop');

    $drops.change(function () {
        $drops.find("option").show();
        $drops.each(function(index, el) {
            var val = $(el).val();
            if (val) {
                var $other = $drops.not(this);
                $other.find("option[value=" + $(el).val() + "]").hide();
            }
        });
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@endsection
