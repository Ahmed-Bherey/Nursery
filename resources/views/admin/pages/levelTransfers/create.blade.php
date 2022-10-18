@extends('admin.layouts.includes.master')
@section('title')
نقل طفل من مرحلة لاخرى
@endsection
@section('content')
<script src="{{ asset('public/select/jquery.min.js') }}"></script>
<!-- CSS forsearching -->
<link href="{{ asset('public/select/select2.min.css') }}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{ asset('public/select/select2.min.js') }}"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">نقل طفل من مرحلة لاخرى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('levelTransfer.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{ date('Y-m-d') }}" required>
                                        <label for="date" class="col-form-label n_ro3ya">التاريخ</label>
                                    </div>
                                    <div
                                        class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3 selectValShow">
                                        <select required class="form-control drop"
                                            name="levelFrom_id" id="levelFrom_id">
                                            <option value="">التحويل من</option>
                                            @foreach ($levelsFrom as $levelFrom)
                                            <option value="{{ $levelFrom->id }}">{{ $levelFrom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="levelFrom_id" class="col-form-label n_right2">
                                            التحويل من</label>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" multiple name="data[child_id][]"
                                            id="child_id">
                                            <option value="">اختر طفل</option>
                                        </select>
                                        <label for="child_id" class="col-form-label n_ro3ya">اختر طفل </label>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control drop"
                                            name="levelTo_id" id="levelTo_id">
                                            <option value=""> التحويل الي </option>
                                            @foreach ($levelsTo as $levelTo)
                                            <option value="{{ $levelTo->id }}">{{ $levelTo->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="levelTo_id" class="col-form-label n_ro3ya">التحويل الي</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
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
                            <h3 class="card-title">نقل طفل من مرحلة لاخرى</h3>
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
                                                    <td>#</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التاريخ </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اسم الطفل</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التحويل من</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التحويل الى</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($levelTransfers as $key => $levelTransfer)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $levelTransfer->date }}</td>
                                                    <td>{{ $levelTransfer->children->name_ar }}</td>
                                                    <td>{{ $levelTransfer->levels_from->name }}</td>
                                                    <td>{{ $levelTransfer->levels_to->name }}</td>
                                                    <td>
                                                        <a href="{{ route('levelTransfer.edit', $levelTransfer->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('levelTransfer.destroy', $levelTransfer->id) }}"
                                                            hidden type="submit"
                                                            onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.content-header -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var $drops = $('.drop');
        $drops.change(function() {
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


<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="levelFrom_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('level.childTransfer.ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#child_id').empty();
                            $.each(data, function(key, value) {
                                $('#child_id').append($(`<option>`, {
                                    value: value.add_chlids.id,
                                    text: value.add_chlids.name_ar,
                                }));
                            });
                            $('#child_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="child_id"]').empty();
                }
            });
        });
</script>

@endsection
