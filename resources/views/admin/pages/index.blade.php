@extends('admin.layouts.includes.master')
@section('title') المستخدمين @endsection
@section('content')
@include('admin.layouts.alerts.success')
@include('admin.layouts.alerts.error')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <section class="content card pt-3  pb-3 m-2">
                    <div class="container-fluid counter_section">
                        <div class="row justify-content-center">
                            <!-- small box -->

                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn">
                                <a href="{{route('addChild.create')}}" class="student_btn"> اضافة طالب <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn bg-orange">
                                <a href="{{route('childRegistration.create')}}" class="student_btn">تسجيل طالب <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn bg-gradient-gray">
                                <a href="{{route('absence.create')}}" class="student_btn">تسجيل غياب طالب <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn bg-gradient-success">
                                <a href="{{route('sellBooks.create')}}" class="student_btn">بيع كتب<i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn bg-gradient-red">
                                <a href="{{route('sellUniform.create')}}" class="student_btn">بيع زى مدرسى<i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 m-3 main-btn bg-success">
                                <a href="{{route('educationalExpensesCollection.create')}}" class="student_btn">تحصيل رسوم دراسية<i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <!-- ./col -->
                            <hr class="container mt-3">

                            <!-- ./col -->
                        </div>
                        <h3 class="m-0 mb-3 text-info "></h3>
                        <!-- Small boxes (Stat box) -->
                        <div class="row">

                            <div class=" col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->

                                <div class="small-box bg-blue">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\User::where('delete_at', 0)->count() }}</h3>
                                        <p>المستخدمين</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag">{{ \App\Models\User::where('delete_at', 0)->count()
                                            }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-orange">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\AddChild::where('year_id', $year_id)->where('delete_at',
                                            0)->count() }}
                                        </h3>
                                        <p>الطلاب</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars">{{ \App\Models\AddChild::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-gradient-gray">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\Classroom::where('delete_at', 0)->count() }}</h3>
                                        <p>القاعات الدراسيه</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add">{{ \App\Models\Classroom::where('delete_at',
                                            0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-gradient-success">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="">
                                            {{ \App\Models\Leavel::where('delete_at', 0)->count() }}</h3>
                                        <p>المراحل التعليميه
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph">{{ \App\Models\Leavel::where('delete_at',
                                            0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-gradient-red">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\BuyBook::where('year_id', $year_id)->where('delete_at',
                                            0)->count() }}
                                        </h3>
                                        <p>الكتب الدراسيه</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph">{{ \App\Models\BuyBook::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-gradient-maroon">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\BuyUniformTotal::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}
                                        </h3>
                                        <p>الزي المدرسي </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph">{{ \App\Models\BuyUniformTotal::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\SellBook::where('year_id', $year_id)->where('delete_at',
                                            0)->count() }}
                                        </h3>
                                        <p>طلاب سددوا الكتب الدرسيه</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag">{{ \App\Models\SellBook::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">
                                            {{ \App\Models\SellUniformTotal::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}
                                        </h3>
                                        <p>طلاب سددوا الزي المدرسي</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars">{{ \App\Models\SellUniformTotal::where('year_id',
                                            $year_id)->where('delete_at', 0)->count() }}</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="#">--</h3>
                                        <p>--</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add">--</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="">---</h3>
                                        <p>---</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph">---</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner nums">
                                        <h3 class="num" data-goal="">---</h3>
                                        <p>---</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph">---</i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-gradient-info">
                                    <div class="inner nums">
                                        <h3 class="num num1" data-goal="">{{ date('l') }}</h3>
                                        <p>{{ date('Y-m-d') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">تاريخ اليوم <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
                </section>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection
