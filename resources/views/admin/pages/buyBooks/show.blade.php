@extends('admin.layouts.includes.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right; font-weight:bold;"> عمليه الشراء رقم :
                                {{$buyBookId }} </h3>
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
                                                        #
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الاسم
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الكميه
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        سعر الشراء </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        سعر البيع </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        عمليات </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buyBooks as $key=> $buyBook)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $key+1}}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->name }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->amount }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->buyPrice }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->sellPrice }}
                                                    </td>
                                                    <td class="d-flex justify-content-center">


                                                        <button type="submit" class="btn bg-secondary">
                                                            <a href="{{ route('buyBooks.edit', $buyBook->id) }}"
                                                                class="text-white"><i class="far fa-edit"
                                                                    aria-hidden="true"></i></a>
                                                        </button>
                                                        <button type="submit" class="btn bg-secondary"
                                                            onclick="return confirm('Are you sure?')">
                                                            <a href="{{ route('buyBooks.delete', $buyBook->id) }}"
                                                                class="text-white"><i class="far fa-trash-alt"
                                                                    aria-hidden="true"></i></a>
                                                        </button>

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
        </div>
    </div>
</div>


@endsection