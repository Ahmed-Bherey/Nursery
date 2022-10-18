<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- css file-->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/portrate.css') }}" />

    <title>استمارة اطفال</title>


    <link rel="stylesheet" href="{{ asset('public/assets/dist/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/dist/fontawesome/css/all.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/dist/bootstrap/css/bootstrap.css') }}" />
</head>

<body>

    <style>
        img {
            max-width: 100%;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- start card --}}
                <div class="row mt-1">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card card-info">
                            <div class="card-header header-bg">
                                <h3 class="card-title" style="float: right">استمارة طفل</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('admin.layouts.alerts.success')
                            @include('admin.layouts.alerts.error')
                            <form action="{{ route('childRegistration.info.show') }}" method="GET">
                                <div class="card-body">
                                    {{-- row 1 --}}
                                    <div class="row mb-3">
                                        <div class="col-md-6 form-floating mb-3">
                                            <select required class="form-control" name="student_level"
                                                id="student_level">
                                                <option value="">اختر المرحلة</option>
                                                @foreach ($levels as $key => $level)
                                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="student_level" class="col-form-label n_right2">اختر
                                                المرحلة</label>
                                        </div>
                                        <div class=" col-md-6 form-floating mb-3">
                                            <select required class="form-control" name="child_id" id="child_id">
                                                <option value="">اختر الطفل</option>
                                                @foreach ($children as $key => $child)
                                                    <option value="{{ $child->id }}">{{ $child->name_ar }}</option>
                                                @endforeach
                                            </select>
                                            <label for="child_id" class="col-form-label n_right2">اختر الطفل</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn bg-success-2 mr-3">
                                            <i class="fa fa-check text-light" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn bg-secondary" onclick="history.back()" type="submit">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </div>
                                    <button class="btn bg-info me-auto" onclick="window.print() "
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="اطبع الملف"><i
                                            class="fa-solid fa-file-pdf"></i></button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>

                @isset($childRegistrations)

                    <div class="book">
                        <!--start page1-->
                        <div class="hadana">
                            {{-- <div class="col-sm-12 col-lg-12">
                            <div class="card card-info">
                                <!-- /.card-header -->
                                <div class="card-body d-flex">
                                    <button onclick="window.print()">Print this page</button>
                                </div>F
                            </div>
                        </div> --}}

                            <div class="page">
                                <div class="subpage">
                                    <!--start header-->
                                    <section class="header">
                                        <div class="row justify-content-around">
                                            <div class="col-4">
                                                <div class="head1">
                                                    {{ $daycareSettieng->name_ar }}
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="per">
                                                    @isset($childRegistrations->children->img)
                                                        <img
                                                            src=" {{ asset('/public/' . Storage::url($childRegistrations->children->img)) }}">
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="content">
                                        <div class="sec2">
                                            <table class="table">
                                                <tr class="color1">
                                                    <th colspan="2">بيانات الطفل</th>
                                                </tr>
                                                <tr>
                                                    <td class="w-30">اسم الطفل الرباعي</td>
                                                    <td>
                                                        @isset($childRegistrations->children->name_ar)
                                                            <p>{{ $childRegistrations->children->name_ar }}</p>
                                                        @endisset
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-30">تاريخ الميلاد</td>
                                                    <td>
                                                        @isset($childRegistrations->born_date)
                                                            <p>{{ $childRegistrations->born_date }}</p>
                                                        @endisset
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-30">العنوان</td>
                                                    <td>
                                                        @isset($childRegistrations->children->address)
                                                            <p>{{ $childRegistrations->children->address }}</p>
                                                        @endisset
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-30">النوع</td>
                                                    <td>
                                                        @isset($childRegistrations->gender)
                                                            <p>{{ $childRegistrations->gender }}</p>
                                                        @endisset
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-30">الديانة</td>
                                                    <td>
                                                        @isset($childRegistrations->children->religion)
                                                            <p>
                                                                @if ($childRegistrations->children->religion == 1)
                                                                    مسلم
                                                                @else
                                                                    مسيحى
                                                                @endif
                                                            </p>
                                                        @endisset
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="sec3">
                                            <div class="sec2">
                                                <table class="table">
                                                    <tr class="color1">
                                                        <th colspan="2">بيانات الاب </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30">اسم الاب</td>
                                                        <td>
                                                            @isset($childRegistrations->children->father_name)
                                                                <p>{{ $childRegistrations->children->father_name }}</p>
                                                            @endisset
                                                        </td>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> تيليفون الاب </td>
                                                        <td>
                                                            @isset($childRegistrations->children->father_tel)
                                                                <p>{{ $childRegistrations->children->father_tel }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="sec4">
                                            <div class="sec2">
                                                <table class="table">
                                                    <tr class="color1">
                                                        <th colspan="2">بيانات الام </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30">اسم الام</td>
                                                        <td>
                                                            @isset($childRegistrations->children->mother_name)
                                                                <p>{{ $childRegistrations->children->mother_name }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> تيليفون الام </td>
                                                        <td>
                                                            @isset($childRegistrations->children->mother_tel)
                                                                <p>{{ $childRegistrations->children->mother_tel }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="sec5">
                                            <div class="sec2">
                                                <table class="table">
                                                    <tr class="color1">
                                                        <th colspan="2">بيانات التسجيل </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> تاريح القبول</td>
                                                        <td>
                                                            @isset($childRegistrations->acceptance_date)
                                                                <p>{{ $childRegistrations->acceptance_date }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> تاريح الميلاد </td>
                                                        <td>
                                                            @isset($childRegistrations->born_date)
                                                                <p>{{ $childRegistrations->born_date }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> السن عند القبول </td>
                                                        <td>
                                                            @isset($childRegistrations->age)
                                                                <p>{{ $childRegistrations->age }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="sec6">
                                            <div class="sec2">
                                                <table class="table">
                                                    <tr class="color1">
                                                        <th colspan="2">المرحله الدراسية</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30"> اسم المرحلة</td>
                                                        <td>
                                                            @isset($childRegistrations->levels->name)
                                                                <p>{{ $childRegistrations->levels->name }}</p>
                                                            @endisset
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-30">العام الدراسى</td>
                                                        <td>
                                                            @foreach ($educationalYears as $key => $educationalYear)
                                                                <p>{{ $educationalYear->name }}</p>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="sec7 pt-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h3>توقيع ولي الامر</h3>
                                                    <p>......................</p>
                                                </div>
                                                <div class="col-2"></div>
                                                <div class="col-4 ico">
                                                    <i class="fa-solid fa-person-shelter"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="footer pt-5">
                                        <div class="foot1">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-baseline">
                                                    <i class="fa-solid fa-phone-flip"></i>
                                                    <p>{{ $daycareSettieng->tel1 }} / {{ $daycareSettieng->tel2 }}</p>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <i class="fa-solid fa-house"></i>
                                                    <p>{{ $daycareSettieng->address }}</p>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    <p>{{ $daycareSettieng->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!--end page1-->
                        </div>
                    </div>
                @endisset


            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
</body>

</html>
