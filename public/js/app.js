 document.getElementById('getAccessToken').addEventListener('click', (event) => {
            event.preventDefault();

            axios.post('/get-token', {})
            .then((response) => {
                console.log(response.data);
                document.getElementById('access_token').innerHTML = response.data;
            })
            .catch((error) => {
                console.log(error.response.data);
            })

    });

 document.getElementById('registerURL').addEventListener('click', (event) => {
    event.preventDefault();
    axios.post('/register-url', {})
    .then((response) => {
        if(response.data.ResponseDescription){
            document.getElementById('response').innerHTML = response.data.ResponseDescription;
        }else{
            document.getElementById('response').innerHTML = response.data.errorMessage;
        }
        console.log(response.data);

    })
    .catch((error) => {
        console.log(error.response.data);
    })
 });

 document.getElementById('simulate').addEventListener('click', (event) => {
    event.preventDefault();

    const requestBody = {
        document.getElementById('amount').value,
        document.getElementById('account').value
    }
    axios.post('/mobile-money/simulate', requestBody)
    .then((response) => {
        console.log(response.data);
    })
    .catch((error) => {
        console.log(error.response.data);
    })
 })