var id = 1;

function addRow()
{
    let content = document.getElementById('0').cloneNode(true);
    content.getElementsByTagName('select')[0].name = 'product_id_'+String(id);
    content.getElementsByTagName('select')[0].setAttribute('onchange','getPrice('+String(id)+', this.value)');
    content.getElementsByTagName('input')[0].id = 'price_'+String(id);
    content.getElementsByTagName('input')[0].value = 0;
    content.getElementsByTagName('input')[1].name = 'buy_price_id_'+String(id);
    content.getElementsByTagName('p')[0].id = 'show_price_'+String(id);
    content.getElementsByTagName('p')[0].innerText = '0 eur';
    content.getElementsByTagName('input')[2].name = 'quantity_'+String(id);
    content.getElementsByTagName('input')[2].id = 'quantity_'+String(id);
    content.getElementsByTagName('input')[2].setAttribute('onchange','outputChange('+String(id)+')');
    content.getElementsByTagName('input')[3].name = 'damaged_'+String(id);
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

function outputChange(nr)
{
    let output = document.getElementById('sum_'+String(nr));
    let price = document.getElementById('price_'+String(nr));
    let quantity = document.getElementById('quantity_'+String(nr));
    output.innerText = String(price.value*quantity.value)+' eur';
    totalPrice();
}

function getPrice(nr, product_id)
{
    if (product_id != 'NULL') 
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:'/delivery/create/update',
            data:{id: product_id, _token: CSRF_TOKEN},
            success:function(data) {
                let price = data['price'];
                document.getElementById(String(nr)).getElementsByTagName('input')[0].value = price;
                document.getElementById(String(nr)).getElementsByTagName('p')[0].innerText = String(price)+' eur';
                document.getElementById(String(nr)).getElementsByTagName('input')[1].value = data['id'];
                outputChange(nr);
            }
        });   
    }
    else{
        document.getElementById(String(nr)).getElementsByTagName('input')[0].value = 0;
        document.getElementById(String(nr)).getElementsByTagName('p')[0].innerText = '0 eur';
        document.getElementById(String(nr)).getElementsByTagName('input')[1].value = null;
        outputChange(nr);
    }
}

function totalPrice()
{
    let sum = 0;
    for (let x = 0; x < id; x++) 
    {
        let elem = document.getElementById('sum_'+String(x)).innerText;
        elem = elem.split(' ');
        sum = sum + parseFloat(elem);
    }
    document.getElementById('total_sum').innerText = String(sum) + ' eur';
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