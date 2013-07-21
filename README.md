## Laravel 4 simple Bootstrap Alert

Simple implementation for Bootstrap Alert in Laravel.

### Installation

To get the lastest version of Theme simply require it in your `composer.json` file.

~~~
"faisal-arbain/alert": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Alert is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key.

~~~
'providers' => array(

    'FaisalArbain\Alert\AlertServiceProvider'

)
~~~

Alert also ships with a facade which provides the static syntax for creating collections. You can register the facade in the `aliases` key of your `app/config/app.php` file.

~~~
'aliases' => array(

    'Alert'  => 'FaisalArbain\Alert\Facades\Alert'

)
~~~

## Usage

1. Adding new alert to flash session
  
		Alert::add("success", "succesfully saved!");
		
	Supported types are `success`, `error`, `info`, `warning`

2.	Then render the alerts on redirected page

		Alert::render();
		

## Support or Contact

If you have some problem, Contact `faisal.arbain@flavert.com`
