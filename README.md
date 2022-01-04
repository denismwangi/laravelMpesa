

### LaravelMpesa


-This project implement the various Mpesa APIs. It is based on the REST API whose documentation is available on https://developer.safaricom.co.ke.
### Configuration
- At your project root, create a .env file and in it set the your credentials follows
```env
    MPESA_CONSUMER_KEY=
    MPESA_CONSUMER_SECRET=
    MPESA_SHORTCODE=
    MPESA_STK_SHORTCODE=
    MPESA_ENV=
    MPESA_TEST_MSISDN=
    MPESA_TEST_URL=
    MPESA_PASSKEY=
    MPESA_B2C_PASSWORD=
    MPESA_B2C_INITIATOR=

```


### usage
##### Composer Install
cd into the project directory via terminal and run the following  command to install composer packages.
###### `composer install`
##### Generate Key
then run the following command to generate fresh key.
###### `php artisan key:generate`

##### Confirmation and validation urls, Account Balance Request,Transaction Status Request ,C2B Payment Request,B2C Payment Request,STK Push Simulation,STK Push Status Query and Callbacks

 ## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## Code of Conduct

Please make sure to update tests as appropriate

## License

