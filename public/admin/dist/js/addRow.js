let rowCount = 0;

// function selectValue(id, index) {
//     let select = document.getElementById(id);

//     let valueSelect = select.options[select.selectedIndex].className;
//     document.getElementById(`quantity${index}`).value = valueSelect;
//     console.log(valueSelect)
// }
let add = document.getElementById("add");
add.addEventListener("click", () => {
    trData = document.querySelector("#tbody tr"),
        tbody = document.getElementById("tbody");
    let newRow = trData.innerHTML
        .replace(`id="add"`, `onclick='delet(this)'`)
        .replace("svg-inline--fa fa-square-plus", "svg-inline--fa fas fa-trash");

    let selectId = "";
    rowCount++;
    selectId = newRow
        .replace(
            `onchange="selectValue('items_id0',0)"`,
            `onchange="selectValue('items_id${rowCount}',${rowCount})"`
        )
        .replace('id="items_id0"', `id="items_id${rowCount}"`)
        .replace(`id="quantity0"`, `id="quantity${rowCount}"`)
        .replace(`myid="unitPrice0"`, `myid="unitPrice${rowCount}"`)
        .replace(`id="unitesName0"`, `id="unitesName${rowCount}"`)
        .replace(`id="purchasing_price0"`, `id="purchasing_price${rowCount}"`)
        .replace(`myid="sellPrice0"`, `myid="sellPrice${rowCount}"`);
    var new_row = document.createElement("tr");
    new_row.innerHTML = selectId;
    tbody.appendChild(new_row);
});



function delet(ele) {
    ele.parentElement.parentElement.remove();
}
// `<td>
//     <input type="number" class="form-control" id="" placeholder="الكود"
//         name="">
// </td>
// <td style=" width: 30%; ">
//     <select class="form-control" name="items_id" id="namestore">
//         <option> اختر الصنف</option>
//         @foreach ($items as $item)
//             <option value="{{ $item->id }}">{{ $item->name }}</option>
//         @endforeach
//     </select>
// </td>
// <td>
//     <input type="number" class="form-control" id="qu" placeholder="الكمية"
//         name="quantity">
// </td>
// <td>
//     <input type="number" class="form-control" placeholder="السعر">
// </td>
//     <button type="button" class="btn bg-danger" onclick='delet(this)'>
//         <i class="fas fa-trash-alt text-light"></i>
//     </button>
// </td>`
