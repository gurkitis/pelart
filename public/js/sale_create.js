var id = 1;
function addRow()
{
    let content = document.getElementById('0').cloneNode(true);
    content.getElementsByTagName('select')[0].name = 'product_id_'+String(id);
    content.getElementsByTagName('select')[0].setAttribute('onchange','getOptions('+String(id)+', this.value)');
    content.getElementsByTagName('select')[1].name = 'sell_type_id_'+String(id);
    content.getElementsByTagName('select')[1].setAttribute('onchange','getPrice('+String(id)+', this.value)');
    content.getElementsByTagName('select')[1].innerHTML = '<option value="NULL"></option>';
    content.getElementsByTagName('p')[0].id = 'price_'+String(id);
    content.getElementsByTagName('p')[0].innerText = '0 eur';
    content.getElementsByTagName('input')[0].name = 'quantity_'+String(id);
    content.getElementsByTagName('input')[0].setAttribute('oninput','outputChange('+String(id)+')');
    content.getElementsByTagName('p')[1].id = 'sum_'+String(id);
    content.getElementsByTagName('p')[1].innerText = '0 eur';
    let parent = document.getElementById('append_here');
    let child = document.createElement('div');
    child.setAttribute('id', String(id));
    child.innerHTML = content.innerHTML;
    parent.appendChild(child);
    document.getElementById('input_count').setAttribute('value', String(id+1));
    id = id + 1;
}

function deleteRow()
{
    if (id > 1) 
    {
        document.getElementById(String(id-1)).remove();   
        id = id - 1;
        document.getElementById('input_count').setAttribute('value', String(id-1));
        totalPrice();
    }else
    {
        alert("Cannot delete 1st row");
    }
}

function getPrice(nr)
{
    let content = document.getElementById(nr);
    let p_nr = content.getElementsByTagName('select')[0].value;
    let type = content.getElementsByTagName('select')[1].value;
    if (p_nr != 'NULL' && type != 'NULL') 
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:'/sale/create/getPrice',
            data:{product_id: p_nr, price_type_id: type, _token: CSRF_TOKEN},
            success:function(data) {
                let price = data['price'];
                content.getElementsByTagName('p')[0].innerText = String(price)+' eur';
                outputChange(nr);
            }
        });   
    }else
    {
        content.getElementsByTagName('p')[0].innerText = '0 eur';
        outputChange(nr);
    }
}

function outputChange(nr)
{
    let content = document.getElementById(nr);
    let p_nr = content.getElementsByTagName('select')[0].value;
    let type = content.getElementsByTagName('select')[1].value;
    let output = document.getElementById('sum_'+String(nr));
    if (p_nr != 'NULL' && type != 'NULL')
    {
        let price = document.getElementById('price_'+String(nr)).innerText;
        price = parseFloat(price.split(' ')[0]);
        let quantity = content.getElementsByTagName('input')[0].value;
        output.innerText = String((price*quantity).toFixed(2))+' eur';
    }else
    {
        output.innerText = '0 eur';
    }
    totalPrice();
}

function totalPrice()
{
    let sum = 0.00;
    for (let x = 0; x < id; x++) 
    {
        let elem = document.getElementById('sum_'+String(x)).innerText;
        elem = parseFloat(elem.split(' ')[0]);
        sum = sum + elem;
    }
    document.getElementById('total_sum').innerText = 'Grand total : ' + String(parseFloat(sum).toFixed(2)) + ' eur';
    return sum;
}

function getOptions(nr)
{
    var content = document.getElementById(String(nr));
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:'/sale/create/getOptions',
            data:{product_id: content.getElementsByTagName('select')[0].value, _token: CSRF_TOKEN},
            success:function(data) {
                let type_names = data['type_names'];
                let select = content.getElementsByTagName('select')[1];
                select.innerHTML = '<option value="NULL"></option>';
                type_names.forEach(element => {
                    let option = document.createElement('option');
                    option.value = element['id'];
                    option.innerText = element['name'];
                    select.appendChild(option);
                });
                outputChange(nr);
            }
        });   
}