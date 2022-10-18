@extends('admin.layouts.includes.master')
@section('title') شراء زى مدرسى @endsection
@section('content')
<script src="{{ asset('public/assets/plugins/jquery/jquery.min.js') }}"></script>
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
                            <h3 class="card-title header-title">بيع زى مدرسى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{route('sellUniform.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-6 form-floating mt-3">
                                        <input type="date" class="form-control" id="date"
                                            value="<?php echo date('Y-m-d'); ?>" name="date" required>
                                        <label for="date" class="col-form-label n_ro3ya"> التاريخ </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mt-3">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{$level->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_ro3ya"> المرحلة
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mt-3">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach ($children as $child)
                                            <option value="{{ $child->id }}">{{$child->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_ro3ya"> الطفل
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mt-3"> <select type="text"
                                            class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزنه</option>
                                            @foreach($treasuries as $treasury)
                                            <option value="{{$treasury->id}}">{{$treasury->name}} </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label"> اختر الخزنه
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mt-3">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="notes"
                                            id="n"></textarea>
                                        <label for="n" class=" col-form-label n_ro3ya"> ملاحظات </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mt-3">
                                        <input type="number" class="form-control" step="0.1" id="pay"
                                            placeholder="اجمالى السعر" name="total" required readonly>
                                        <label for="pay" class="col-form-label n_ro3ya">اجمالى السعر</label>
                                    </div>

                                </div>
                                {{-- row 2 --}}
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>اختر الزى</th>
                                            <th>الكمية</th>
                                            <th>السعر</th>
                                            <th>الجملة</th>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td style="width: 25%;">
                                                <select required class="form-control items_id"
                                                    name="data[buyUniform_id][]" id="items_id0">
                                                    <option value="">اختر الزى المدرسى</option>
                                                    @foreach($buyUniforms as $key => $buyUniform)
                                                    <option value="{{$buyUniform->id}}"
                                                        price='{{$buyUniform->buy_price}}'>{{$buyUniform->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control amount" step="0.1" id="name"
                                                    placeholder="الكمية" name="data[quantity][]">
                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" myid='unitPrice0' class="form-control buyPrice"
                                                    onkeyup="result()" step="0.1" id="name" placeholder="السعر"
                                                    name="data[price][]" readonly>
                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control subTotal" step="0.1"
                                                    id="subTotal" placeholder="الجملة" name="data[subTotal][]" readonly>
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
                            <h3 class="card-title">بيع زى مدرسى</h3>
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
                                                    <td>التاريخ</td>
                                                    <td>اسم المرحلة</td>
                                                    <td>اسم الطالب</td>
                                                    <td>ملاحظات</td>
                                                    <td>اجمالى السعر</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sellUniformTotals as $sellUniformTotal)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$sellUniformTotal->date}}</td>
                                                    <td>{{$sellUniformTotal->levels->name}}</td>
                                                    <td>{{$sellUniformTotal->children->name_ar}}</td>
                                                    <td>{{$sellUniformTotal->notes}}</td>
                                                    <td>{{$sellUniformTotal->total}}</td>
                                                    <td>
                                                        <a href="{{ route('sellUniform.print', $sellUniformTotal->id) }}"
                                                            type="submit" class="btn btn-info"><i
                                                                class="fa-solid fa-print"></i></a>
                                                        <a href="{{ route('sellUniform.edit', $sellUniformTotal->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('sellUniform.destroy', $sellUniformTotal->id) }}"
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
            new_row.innerHTML =
            `<td style="width: 25%;">
                <select required class="form-control items_id"
                    name="data[buyUniform_id][]"
                    id="items_id0">
                    <option value="">اختر الزى المدرسى</option>
                    @foreach($buyUniforms as $key => $buyUniform)
                    <option value="{{$buyUniform->id}}" price='{{$buyUniform->buy_price}}'>{{$buyUniform->name}}</option>
                    @endforeach
                </select>
            </td>
            <td style=" width: 25%;">
                <input type="number" class="form-control amount" step="0.1" id="name"
                    placeholder="الكمية" name="data[quantity][]">
            </td>
            <td style=" width: 25%;">
                <input type="number" myid='unitPrice0' class="form-control buyPrice" onkeyup="result()" step="0.1" id="name"
                    placeholder="السعر" name="data[price][]" readonly>
            </td>
            <td style=" width: 25%;">
                <input type="number" class="form-control subTotal" step="0.1" id="subTotal"
                    placeholder="الجملة" name="data[subTotal][]" readonly>
            </td>
            <td>
                <button type="button" class="btn bg-danger" onclick='delet(this) ,calculate()'>
                    <i class="fas fa-trash-alt text-light"></i>
                </button>
            </td>`;
            tbody.appendChild(new_row)
        })
        function delet (ele ) {
            ele.parentElement.parentElement.remove()
        }
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="data[buyUniform_id][]"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('sell.price.ajax',['id'=>':id'])}}';
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
                            $('.buyPrice').empty();
                            $('.x').val(data);
                            $('.buyPrice').trigger('change');
                        }
                    });
                } else {
                    $('select[name="amount"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="level_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('sellUniform.children.ajax',['id'=>':id'])}}';
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
                                value: value.children.id,
                                text: value.children.name_ar,
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

<script>
    // حساب سعر الكتاب
    document.addEventListener('click',calculatePrice)
    function calculatePrice() {
        let item_id = document.querySelectorAll('.items_id'),
            buyPrice = document.querySelectorAll(".buyPrice");
        item_id.forEach((ele,index)=>{
            ele.addEventListener('click',()=>{
                    for(let i=1 ; i<ele.children.length ; i++){
                    if (ele.value*1 === ele.children[i].attributes.value.value*1){
                        buyPrice[index].value=ele.children[i].attributes.price.value
                    }
                }
            })
            ele.addEventListener('click',calculate)
        })
    }

    let pay = document.getElementById('pay'),
        price;
        pay.value = 0
    // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
    function calculate() {
        let amount = document.querySelectorAll(".amount"),
            subTotal = document.querySelectorAll(".subTotal"),
            buyPrice = document.querySelectorAll(".buyPrice");
            // حساب الاجمالي
        amount.forEach((ele,index)=>{
            ele.addEventListener('keyup', ()=>{
                subTotal[index].value =  buyPrice[index].value * 1 * ele.value * 1
            });
        })
        // حساب اجمالي السعر
        document.addEventListener('keyup', ()=>{
            price = 0
                subTotal.forEach((ele,index)=>{
                    price= price *1 + ele.value * 1
                    pay.value = price * 1
            })
        });
    }
    document.addEventListener('keyup', calculate);
</script>



<script>
    let selectValShow= document.querySelectorAll('.selectValShow');
    let selectDefault= document.querySelector('.selectDefault');
    selectValShow.forEach(el=>{
        el.style.display='none';
    })
    function consloSel(e){
        let val=e.options[e.selectedIndex].getAttribute('data-value');
        selectValShow.forEach(el=>{
        el.style.display='none';
        selectDefault.style.display='block'
    })
        if(val==0 || val==1){
            selectValShow[val].style.display='flex';
            selectDefault.style.display='none'
        }
    }
</script>
<script>
    function result(){
        totalPrice();
        discountValueFun();
        totalaBeforDiscountFun();
        totalDiscountValueFun();
        totalPriceFun();
        payFun();
        restFun();
    }
    function discountValueFun(){
        let discountRate =document.querySelectorAll('#discountRate');
        discountRate.forEach(el=>{
            let newEl=el.parentElement.parentElement;
            let priceunit=newEl.querySelector('#priceunit').value;
            let qu=newEl.querySelector('#qu').value;
            newEl.querySelector('#discountValue').value = (priceunit * qu * el.value)/100
        })
        totalPrice();
        totalDiscountValueFun();
        totalPriceFun();
        payFun();
        restFun();
    }
    function totalPrice(){
        let pricetotal= document.querySelectorAll('.pricetotal');
        pricetotal.forEach(el=>{
            let newEl=el.parentElement.parentElement;
            let priceunit=newEl.querySelector('#priceunit').value;
            let qu=newEl.querySelector('#qu').value;
            let discountValue=newEl.querySelector('#discountValue').value;

            if(priceunit && qu){
                el.value = priceunit * qu -discountValue;
            }else{
                el.value ='';
            }
        })
    }

    function discountRateFun(){
        let discountRate =document.querySelectorAll('#discountRate');
        discountRate.forEach(el=>{
            let newEl=el.parentElement.parentElement;
            let priceunit=newEl.querySelector('#priceunit').value;
            let qu=newEl.querySelector('#qu').value;
            newEl.querySelector('#discountRate').value = (100* newEl.querySelector('#discountValue').value)/(priceunit*qu);
        })
        totalPrice();
        totalDiscountValueFun();
        totalPriceFun();
        payFun();
        restFun();
    }
function totalaBeforDiscountFun(){
    let qus=document.querySelectorAll('#qu'),
    priceunits=document.querySelectorAll('#priceunit');
    let totalaBeforDiscountSum=0;
    for(let i=0;i<qus.length;i++){
        totalaBeforDiscountSum += qus[i].value*priceunits[i].value;
    }
    document.querySelector('#totalaBeforDiscount').value = totalaBeforDiscountSum;
}
function totalDiscountValueFun(){
    let discountValues = document.querySelectorAll('#discountValue');
    let discountValueSum = 0;
    discountValues.forEach(el=>{
        discountValueSum += +el.value;

    });
    document.querySelector('#Discount').value = discountValueSum;
}

function totalPriceFun(){
    let totalPrice =document.querySelectorAll('#totalPrice');
    let totalPriceSum= 0;
    totalPrice.forEach(el=>{
        totalPriceSum += +el.value;
    })
    document.querySelector('#totalaAfterDiscount').value =totalPriceSum
}
function payFun(){
    let sum=(document.querySelector('#taxavg').value * document.querySelector('#totalaAfterDiscount').value)/100
    document.querySelector('#pay').value = sum + +document.querySelector('#totalaAfterDiscount').value;
    restFun();
}
function restFun(){
    document.querySelector('#rest').value =document.querySelector('#pay').value - document.querySelector('#paid').value
}
</script>
@endsection
