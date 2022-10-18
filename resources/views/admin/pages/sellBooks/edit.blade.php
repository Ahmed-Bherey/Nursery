@extends('admin.layouts.includes.master')
@section('title') تعديل شراء كتب مدرسية @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title"> تعديل بيع الكتب الدراسيه </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{route('sellBooks.update',$sellBooks->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 form-floating">
                                        <input type="date" class="form-control" id="date" value="{{$buyBook->date}}"
                                            name="date" readonly>
                                        <label for="date" class="col-form-label"> التاريخ </label>
                                    </div>

                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" id="date"
                                            value="{{$buyBook->levels->name}}" name="level_id" readonly>
                                        <label for="namestore" class="col-form-label"> المرحله
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" id="date"
                                            value="{{$buyBook->childs->name_ar}}" name="child_id" readonly>
                                        <label for="namestore" class="col-form-label"> اسم الطفل
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" id="date"
                                            value="{{$buyBook->books->name}}" name="book_id" readonly>
                                        <label for="namestore" class="col-form-label"> اسم الكتاب
                                        </label>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4 form-floating mt-3">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="note"
                                            id="n"> {{$buyBook->note}}</textarea>
                                        <label for="n" class=" col-form-label"> ملاحظات </label>
                                    </div>
                                    <div class="col-md-4 form-floating mt-3">
                                        <input type="number" class="form-control amount" step="0.1"
                                            value="{{$buyBook->amount}}" name="amount">
                                        <label for="pay" class="col-form-label">الكميه</label>
                                    </div>
                                    <div class="col-md-4 form-floating mt-3">
                                        <input type="number" class="form-control" step="0.1" value="{{$buyBook->price}}"
                                            name="price">
                                        <label for="pay" class="col-form-label">السعر</label>
                                    </div>
                                    <div class="col-md-4 form-floating mt-3">
                                        <input type="number" class="form-control" step="0.1"
                                            value="{{$buyBook->subTotal}}" name="subTotal">
                                        <label for="pay" class="col-form-label">الاجمالى</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select type="text" class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزنه</option>
                                            @foreach($treasuries as $treasury)
                                            <option value="{{$treasury->id}}" @if($treasury->id == $buyBook->treasury_id
                                                ) selected @endif>{{$treasury->name}} </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label"> اختر الخزنه
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('sellBooks.create')}}"></a>
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

{{-- <script>
    let   pay = document.getElementById('pay'),
            price;
            pay.value = 0
            // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
            function calculate() {
                let amount = document.querySelectorAll(".amount"),
                    buyPrice = document.querySelectorAll(".buyPrice");
                price = 0
                for (let i = 0; i < amount.length; i++) {
                    price = price + amount[i].value * 1 * buyPrice[i].value * 1
                    pay.value = price * 1
                }
                console.log(444)
            }
            document.addEventListener('keyup', calculate);

        let add = document.getElementById('add'),
            tbody = document.getElementById('tbody');

            add.addEventListener(('click'), () => {
                var new_row = document.createElement('tr')
                new_row.innerHTML =
                    `
                    <td>
                    <select required class="form-control item_id "
                        name="data[book_id][]"
                        id="book_id" >
                        <option value="">اختر الكتاب</option>
                            @foreach($buyBooks as $buyBook)
                            <option value="{{$buyBook->id}}">{{$buyBook->name}}    ---  السعر :{{$buyBook->sellPrice}}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                        <input type="number" class="form-control amount" step="0.1"
                        placeholder="الكميه" name="data[amount][]"  required>
                        </td><td>
                        <input type="number" class="form-control buyPrice" step="0.1"
                        placeholder="السعر " name="data[price][]">
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
</script> --}}

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
        let item_id = document.querySelectorAll('.item_id'),
            amount = document.querySelectorAll(".amount"),
            subTota = document.querySelectorAll(".sub-Total"),
            buyPrice = document.querySelectorAll(".buyPrice");

        amount.forEach((ele,index)=>{
            document.addEventListener('keyup', ()=>{
                subTota[index].value =  buyPrice[index].value * 1 * ele.value * 1
            });
        })
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

   // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
    let   pay = document.getElementById('pay'),
        price;
        pay.value = 0
        function calculate() {
            let amount = document.querySelectorAll(".amount"),
                buyPrice = document.querySelectorAll(".buyPrice");
            price = 0
            for (let i = 0; i < amount.length; i++) {
                price = price + amount[i].value * 1 * buyPrice[i].value * 1
                pay.value = price * 1
            }

        }
        document.addEventListener('keyup', calculate);
// add new row
    let add = document.getElementById('add'),
        tbody = document.getElementById('tbody');
        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            new_row.innerHTML =
                `
                <td>
                    <select required class="form-control item_id " name="data[book_id][]"
                        id="book_id">
                        <option value="">اختر الكتاب</option>
                        @foreach($buyBooks as $buyBook)
                        <option value="{{$buyBook->id}}" price='{{$buyBook->sellPrice}}'>{{$buyBook->name}}</option>

                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control amount" step="0.1"
                        placeholder="الكميه" name="data[amount][]" required>
                </td>
                <td>
                    <input type="number" class="form-control buyPrice" step="0.1"
                        placeholder="السعر " name="data[price][]">
                </td>
                <td>
                                                <input type="number" class="form-control sub-Total" step="0.1"
                                                    placeholder="الاجمالي " name="data[subTotal][]" readonly>
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
            $('select[name="data[book_id][]"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('sellBooks.sellPrice.book.ajax',['id'=>':id'])}}';
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
                            $('.buyPrice').val(data);
                            $('.buyPrice').trigger('change');
                        }
                    });
                } else {
                    $('select[name="amount"]').empty();
                }
            });
        });
</script>

@endsection
