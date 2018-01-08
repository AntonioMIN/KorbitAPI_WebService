var currency_pair="btc_krw";
var play=true;
var maker_fee, taker_fee;
var isRefreshing=false;
function get_balance()
{
    $.ajax({
        url:'/api/balance',
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $('#wallet_container').html('');
            $.each(result['result'], function(index, value){
                if(Number(value.available)>0 || Number(value.trade_in_use)>0 || Number(value.withdrawal_in_use)>0)
                {
                    $('#wallet_container').append("<div class=\"card\"><div class=\"content\"><div class=\"header\">"+index.toUpperCase()+"</div><div class=\"meta\">"+index.toUpperCase()+" Wallect</div><div class=\"description\">Available : "+Number(value.available)+"<br>Trade in use : "+Number(value.trade_in_use)+"<br>Withdraw in use : "+Number(value.withdrawal_in_use)+"</div></div></div>");
                }
            });
        }
    });
}
function get_ticker()
{
    $.ajax({
        url:'/api/ticker/'+currency_pair,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $('#ticker').html(krw_string(result['result'].last)+" KRW");
            $('#ticker').fadeOut(10);
            $('#ticker').fadeIn(500);
        }
    });
}
function get_transactions()
{
    $.ajax({
        url:'/api/transactions/'+currency_pair,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $('#transactions_container').html('');
            for(var i=0;i<result['result'].length;i++)
            {
                var item=result['result'][i];
                var price=krw_string(item.price);
                var time=new Date(item.timestamp);
                $('#transactions_container').append("<tr><td>"+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds()+"</td><td>"+numeral(item.amount).format('0,0.00000000')+"</td><td>"+price+"</td></tr>");
            }
        }
    });
}
function get_orderbook()
{
    $.ajax({
        url:'/api/orderbook/'+currency_pair,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $('#orderbook_ask').html('');
            $('#orderbook_bid').html('');
            for(var i=0;i<result['result']['bids'].length;i++)
            {
                var item=result['result']['bids'][i];
                var price=krw_string(item[0]);
                $('#orderbook_bid').append("<tr><td>"+numeral(item[1]).format('0,0.00000000')+"</td><td>"+price+"</td></tr>");
            }
            for(var i=0;i<result['result']['asks'].length;i++)
            {
                var item=result['result']['asks'][i];
                var price=krw_string(item[0]);
                $('#orderbook_ask').append("<tr><td>"+price+"</td><td>"+numeral(item[1]).format('0,0.00000000')+"</td></tr>");
            }
        }
    });
}
function get_user_orders()
{
    $.ajax({
        url:'/api/userorders/'+currency_pair,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $('#userorder_container').html('');
            for(var i=0;i<result['result'].length;i++)
            {
                var item=result['result'][i];
                if(item['status']!="filled") continue;
                var side,time,avg_price,filled_total,result_str,class_str;
                if(item['side']=="ask")
                {
                    side="매도";
                    result_str=krw_string(Number(item['filled_total'])-Number(item['fee']))+" KRW";
                    class_str="positive";
                }
                else
                {
                    side="매수";
                    result_str=numeral(Number(item['filled_amount'])-Number(item['fee'])).format('0,0.000000000');
                    class_str="negative";
                }
                time=new Date(item['created_at']);
                time_str=time.getFullYear()+"-"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds();
                avg_price=krw_string(item['avg_price']);
                filled_total=krw_string(item['filled_total']);
                
                $('#userorder_container').append("<tr class=\""+class_str+"\"><td>"+side+"</td><td>"+time_str+"</td><td>"+item['order_amount']+"</td><td>"+item['filled_amount']+"</td><td>"+avg_price+"</td><td>"+filled_total+"</td><td>"+item['fee']+"</td><td>"+result_str+"</td></tr>");
            }
        }
    });
}
function get_user_volume()
{
    $.ajax({
        url:'/api/uservolume/'+currency_pair,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            maker_fee=result['result'][currency_pair]['maker_fee'];
            taker_fee=result['result'][currency_pair]['taker_fee'];
            $('#calc_fee').html('Maker Fee : '+maker_fee+'% Taker Fee : '+taker_fee+"%");
        }
    });
}
function krw_string(price)
{
    return new Intl.NumberFormat('ko-kr').format(price);
}
function changeCurrency(index)
{
    switch(currency_pair)
    {
        case "btc_krw":
            $('#menu_btc').removeClass('active');
            break;
        case "bch_krw":
            $('#menu_bch').removeClass('active');
            break;
        case "eth_krw":
            $('#menu_eth').removeClass('active');
            break;
        case "xrp_krw":
            $('#menu_xrp').removeClass('active');
            break;
    }
    switch(index)
    {
        case 0:
            $('#menu_btc').addClass('active');
            currency_pair="btc_krw";
            break;
        case 1:
            $('#menu_bch').addClass('active');
            currency_pair="bch_krw";
            break;
        case 2:
            $('#menu_eth').addClass('active');
            currency_pair="eth_krw";
            break;
        case 3:
            $('#menu_xrp').addClass('active');
            currency_pair="xrp_krw";
            break;
    }
    get_user_orders();
    get_user_volume();
}
function ticker_play()
{
    play=true;
}
function ticker_pause()
{
    play=false;
}
function refresher()
{
    if(play==true && isRefreshing==false)
    {
        isRefreshing=true;
        get_ticker();
        get_transactions();
        get_orderbook();
        isRefreshing=false;
    }
}
$(document).ready(function(){
    get_balance();
    get_user_orders();
    get_user_volume();
    setInterval(refresher,2000);

    $('select.dropdown').dropdown();
    $('#calc_container').change(function(){
        var fee;
        if($('#calc_ordertype').val()=="Maker") fee=maker_fee;
        else fee=taker_fee;
        var order_amount=$('#calc_order_amount').val();
        var order_price=$('#calc_order_price').val();
        var sell_price=$('#calc_sell_price').val();
        var result=(order_amount-order_amount*fee)*sell_price-((order_amount-order_amount*fee)*sell_price)*fee-order_amount*order_price;
        $('#calc_outcome').html('손이익 : '+numeral(result).format('0,0.0000'));
    });
});