<aside class="main-sidebar sidebar-dark-primary elevation-4 d-print-none" style="background-color: rgb(68,67,69)">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('public/assets/dist/img/logo1.png') }}" alt="najezedu"
            class=" brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">ناجز </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.edit', Auth::user()->id) }}" class="d-block">
                    {{ auth()->user()->name_ar }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column p-0" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link bg-origin">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p>
                            الرئيسيه
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('educationalYear.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('daycareSettieng.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('user.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('leavel.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('classroom.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('educationalExpenses.create') ? 'menu-is-opening menu-open' : '' }}

                    {{ request()->routeIs('generalExpensese.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الاعدادات العامة
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('educationalYear.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('educationalYear.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>السنة الدراسية</p>
                            </a>
                        </li>
                        <li class="nav-item  @if (request()->routeIs('daycareSettieng.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('daycareSettieng.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>بيانات الحضانة</p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('user.create') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs text-green"></i>
                                <p>
                                    المستخدمين
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item @if (request()->routeIs('user.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('user.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>اضافة مستخدم</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>صلاحيات المستخدمين </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (request()->routeIs('leavel.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('leavel.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة مرحلة</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('classroom.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('classroom.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافه قاعه دراسيه</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('educationalExpenses.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('educationalExpenses.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>الرسوم الدراسية</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('generalExpensese.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('generalExpensese.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>المصروفات العامة</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('addChild.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('children.name.search') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('children.search') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('childTransfer.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('childRoom.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('childRegistration.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('childRegistration.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('addChild.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('levelTransfer.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الطلاب
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('addChild.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('addChild.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة طفل</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('childRegistration.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('childRegistration.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تسجيل طفل</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('childRoom.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('childRoom.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة طفل الى قاعة</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('childTransfer.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('childTransfer.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>نقل طفل الى قاعة</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('levelTransfer.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('levelTransfer.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>نقل طفل من مرحلة لاخرى</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('children.search') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('children.search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>بحث الاطفال</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('children.name.search') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('children.name.search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>بحث بالاسم</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('absence.create') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('holiday.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الحضور والغياب
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('absence.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('absence.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تسجيل غياب واستأذان</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('permission.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة اذن</p>
                            </a>
                        </li> --}}
                        <li class="nav-item @if (request()->routeIs('holiday.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('holiday.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة اجازة</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('buyBooks.create') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('sellBooks.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الكتب الدراسيه
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('buyBooks.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('buyBooks.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>شراء كتب</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('sellBooks.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('sellBooks.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>بيع كتب</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('buyUniform.create') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('sellUniform.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الزى المدرسى
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('buyUniform.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('buyUniform.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>شراء زى مدرسى</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('sellUniform.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('sellUniform.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>بيع زى مدرسى</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('IndebtednessLevels.create') ? 'menu-is-opening menu-open' : '' }}
                {{ request()->routeIs('educationalExpensesCollection.create') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('treasury.create') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('employeeSalary.create') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('generalAccount.create') ? 'menu-is-opening menu-open' : '' }}"
                    {{ request()->routeIs('treasuryTransfer.create') ? 'menu-is-opening menu-open' : '' }}>
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الحسابات
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li
                            class="nav-item {{ request()->routeIs('user.create') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs text-green"></i>
                                <p>
                                    اعدادات عامة
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item @if (request()->routeIs('treasury.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('treasury.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>اضافة خزينة</p>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('treasuryTransfer.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('treasuryTransfer.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>التحويل من خزينة لاخرى</p>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('generalAccount.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('generalAccount.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>مصروفات العامة</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (request()->routeIs('IndebtednessLevels.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('IndebtednessLevels.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافه مديونيات لمرحله</p>
                            </a>
                        </li>
                        <li class="nav-item  @if (request()->routeIs('educationalExpensesCollection.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('educationalExpensesCollection.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تحصيل المصروفات الدراسية</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('employeeSalary.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('employeeSalary.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>صرف رواتب الموظفين</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('employee.create') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('employeeAbcencePermission.create') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            الموظفين
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (request()->routeIs('employee.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('employee.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>اضافة موظف</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('employeeAbcencePermission.create') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('employeeAbcencePermission.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تسجيل غياب واستأذان</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"
                    {{ request()->routeIs('childLevel.info.index') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('childRegistration.info.index') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('childRegistration.data.show') ? 'menu-is-opening menu-open' : '' }}
                    {{ request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '' }}>
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs text-green"></i>
                        <p>
                            التقارير
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"
                        {{ request()->routeIs('childRegistration.info.index') ? 'menu-is-opening menu-open' : '' }}
                        {{ request()->routeIs('childRegistration.data.show') ? 'menu-is-opening menu-open' : '' }}
                        {{ request()->routeIs('childLevel.info.index') ? 'menu-is-opening menu-open' : '' }}
                        {{ request()->routeIs('classRoom.Students.info.index') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '' }}>
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs text-green"></i>
                                <p>
                                    تقارير شئون الطلبة
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item @if (request()->routeIs('childRegistration.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('childRegistration.info.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>استمارة طفل</p>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('childRegistration.data.show') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('childRegistration.data.show') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>عرض جميع الطلاب</p>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('childLevel.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('childLevel.info.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>اطفال كل مرحلة</p>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('classRoom.Students.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('classRoom.Students.info.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>اطفال كل قاعه</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '' }}{{ request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs text-green"></i>
                                <p>
                                    تقارير الحسابات
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item @if (request()->routeIs('childDontPaid.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                                    <a href="{{ route('childDontPaid.info.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>تقرير سداد الرسوم</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('tressury.process.info.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon green-1"></i>
                                        <p>يومية الخزينة</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (request()->routeIs('absence.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('absence.info.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تقرير غياب الاطفال</p>
                            </a>
                        </li>
                        <li class="nav-item @if (request()->routeIs('employee.absence.info.index') ? 'menu-is-opening menu-open' : '') bg-success @endif">
                            <a href="{{ route('employee.absence.info.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon green-1"></i>
                                <p>تقرير غياب الموظفين</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
