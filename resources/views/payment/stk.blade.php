
@extends('Dashboard')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="crf-token" content={{csrf_token()}}>
    <title>Laravel Daraja</title>
</head>

<body>
    <div class="container">
      <div class="card mt-5">
        <div class="col-sm-8 ">
                <div class="card-header">Stk Transactions</div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div> --}}
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" id="account" class="form-control">
                        </div>
                        <button id='stkpush' class="btn btn-primary">Simulate stk</button>
                    </form>

                </div>
            </div>
      </div>
        </div>
    </div>
    {{-- <script
       src="{{asset ('js/app.js') }}">
    </script> --}}
    <script>
        
     

        // document.getElementById ('api/stkpush').addEventListener('click',(event)=> {
        //    event.preventDefault()

        //    const requestBody={
        //       amount: document.getElementById('amount').value,
        //       account: document.getElementById('account').value
        //     //   phone: document.getElementById('phone').value
        //    }
        //    axios.post('/stkpush',requestBody)
        //    .then((response)=>{
        //     if(response.data.ResponseDescription){
        //         document.getElementById('c2b_response').innerHTML=response.data.ResponseDescription
        //     }else{
        //         document.getElementById('c2b_response').innerHTML=response.data.errorMessage
        //     }
        //    })
        //    .catch((error)=>{
        //     console.log(error);
        //    })
        // })
         

        
    </script>
</body>

</html>

