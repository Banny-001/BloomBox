
@extends('Dashboard')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="crf-token" content={{csrf_token()}}>
    <title>Laravel Daraja</title>
</head>

<body>
    <div class="container">
      <div class="card mt-5">
        <div class=" ">
                <div class="card-header" style="success"> Transactions</div>
                <div class="card-body">
                    <div id="c2b_response"></div>
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" id="account" class="form-control">
                        </div>
                        <button id='stkpush' class="btn btn-primary">Complete payment</button>
                    </form>

                </div>
            </div>
      </div>
        </div>
    </div>
</body>

</html>
    <script>
    document.getElementById ('stkpush').addEventListener('click',(event)=> {
        event.preventDefault()
    
        const requestBody={
           amount: document.getElementById('amount').value,
           account: document.getElementById('account').value,
           phone: document.getElementById('phone').value
        }
        axios.post('/api/stkpush',requestBody)
        .then((response)=>{
         if(response.data.ResponseDescription){
             document.getElementById('c2b_response').innerHTML=response.data.ResponseDescription
         }else{
             document.getElementById('c2b_response').innerHTML=response.data.errorMessage
         }
        })
        .catch((error)=>{
         console.log(error);
        })
     })
    </script>
 
        
 

       
         

        
    

