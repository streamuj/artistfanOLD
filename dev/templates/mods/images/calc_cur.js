
function teaser_calc_amount() {  
      var amount_obj = document.getElementById('teaser_amount');      
      var currency_obj = document.getElementById('teaser_currency'); 
      
/*
      for (i=0; i<teaser_currency_list.length; i++){
          name = teaser_currency_list[i]+'_block';
          if (currency_obj.value.toLowerCase() == teaser_currency_list[i].toLowerCase())
            document.getElementById(name).style.display = 'none';
          else  
            document.getElementById(name).style.display = 'block';
      }     
*/
      var val_amount = amount_obj.value; 
      if (val_amount=='10 лимонов'){
        val_amount = 10000000;
      }    
      if (val_amount>10000000){
        amount_obj.value = '10 лимонов';
      }  
      var regex = /(^\d\d*\.\d*$)|(^\d\d*$)|(^\.\d\d*$)/;
      for (i=0; i<teaser_currency_list.length; i++){
      var calc_amount = 0;
      if (val_amount != '' && regex.test(val_amount) && teaser_exchange_rate[currency_obj.value]>0) {     
         var currency_str = new String(currency_obj.value);
         //if (currency_str.toLowerCase() != currency_obj.value.toLowerCase() ) var calc_amount = val_amount*teaser_exchange_rate[currency_obj.value]/teaser_exchange_rate[teaser_currency_list[i]];
         //else calc_amount = val_amount;
         var calc_amount = val_amount*teaser_exchange_rate[currency_obj.value]/teaser_exchange_rate[teaser_currency_list[i]];
         //var calc_amount = val_amount*exchange_rate[from_currency]/exchange_rate[currency_obj.value];
      }
      name = 'currency_'+teaser_currency_list[i];
      document.getElementById(name).innerHTML = Math.floor(calc_amount*100)/100;
      }
  }
