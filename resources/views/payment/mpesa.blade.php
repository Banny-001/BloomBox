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
        <div class="row ">
            <div class="col-sm-8mx-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        Obtain Access Token
                    </div>
                    <div class="card-body">

                        <h4 id="access_token"></h4>
                        <button id="getAccessToken" class="btn btn-primary">Request Access Token</button>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Register URLs</div>
                <div class="card-body">
                    <div class="response"></div>
                    <h4 id="response"></h4>
                    <button id="registerURLS" class="btn btn-primary">Register URLs</button>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Simulate Transactions</div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" id="account" class="form-control">
                        </div>
                        <button id='simulate' class="btn btn-primary">Simulate Payment</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- <script
       src="{{asset ('js/app.js') }}">
    </script> --}}
    {{-- <script>
        let access_token;
        document.getElementById('getAccessToken').addEventListener('click', (event) => {
            event.preventDefault()

            axios.post('/get-token', {})
                .then((response) => {
                    console.log(response.data);
                    access_token = response.data.access_token;
                    document.getElementById('access_token').innerHTML = response.data.access_token
                })
                .catch((error) => {
                    console.log();
                })
        })
        document.getElementById('registerURLS').addEventListener('click',(event) => {
            event.preventDefault()
            const requestBody={
              token: access_token,
           }

            axios.post('/register-urls', requestBody)
            .then((response) =>{
                console.log('Response: ', response);
                if(response.data.ResponseDescription){
                  document.getElementById('response').innerHTML = response.data.ResponseDescription
                }else{
                    document.getElementById('response').innerHTML= response.data.errorMessage
                }
                console.log(response.data);
        
            })
            .catch((error)=>{
                console.log(error);
            })
        }) 

        document.getElementById ('simulate').addEventListener('click',(event)=> {
           event.preventDefault()

           const requestBody={
              amount: document.getElementById('amount').value,
              account: document.getElementById('account').value
           }
           axios.post('/simulate',requestBody)
           .then((response)=>{
            console.log(response);
           })
           .catch((error)=>{
            console.log(error);
           })
        })

        
    </script>
</body>

</html> --}}
