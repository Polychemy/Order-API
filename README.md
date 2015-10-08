# Polychemy's REST Order API. BETA.
Place Custom orders directly on polychemy.com.<br>
<p>
Use this API to place custom orders on Polychemy. STL files are generated on the fly and send to our manufacturing network.</br>
For a Full List of our products and customization properties, please see here:</br>
http://www.polychemy.com/php/PolychemyAPI.php
</p>

<p>*The Order API can now accept custom orders with FIle uploads.</p>

<h1> Create Order Example</h1>
<p>In This example we will create an order with 2 items in the shopping cart. 1 Roman Ring & 1 Snow Flake Necklace</p>

HTTP Method : POST<br>
URL : https://www.polychemy.com/php/Order.php</br>
Variable : CustomerData, Command.

Sample JSON Request:

```json
{
	"customerData":{
		"email":"customer@gmail.com",
		"street":"Ave 12",
		"city":"New York",
		"state":"New York",
		"zip":"123232",
		"country":"United Statesd",
		"name":"John Doe",
		"hpnumber":"383748743",
		"occasion":"none",
		"Billingstreet":"Ave 12",
		"Billingcity":"New York",
		"Billingstate":"New York",
		"Billingzip":"123232",
		"Billingcountry":"United Statesd",
		"Billingname":"John Doe",
		"Billinghpnumber":"383748743",
		"gender":"none",
		"forwho":"none",
		"coupon":"",
		"cdtoken":"",
		"ShippingType":"USPS",
		"PONumber":"PO43234234",
		"OrderNumber":"ORDER43234234",
		"ReturnTCNumber":"RETURNNUMBER",
		"TotalAmount":"100.99",
		"ShippingCost":"6.50",
		"sendinvoice":false
	},
	"ID":"",
	"referal":{
		"referalID":"WALMART",
		"type":"WALMART"
	},
	"paymentType":"ExternalCart",
	"secret":"Jhi83dS",
	"ShoppingCart":[
		{
			"script":"RomanRing.py",
			"turntable":"false",
			"arguments":[
				"Love",
				"Sterling_Silver",
				"6"
			],
			"ItemNumber":"008408461s0639",
			"Description":"Elegant Roman Name Ring",
			"Price":"19.99",
			"Tax":"9.99",
			"Shipping":"6.50",
			"ConfigID":"31232jjfdhuj3"
		},
		{
			"script":"SnowFlakeGem.py",
			"turntable":"false",
			"arguments":[
				"6",
				"Solid_Gold_18k",
				"Yellow_Sapphire",
				"16 inch Chain (40 cm) - Child"
			],
			"ItemNumber":"008408461s0639",
			"Description":"Elegant SNow Flake",
			"Price":"59.99",
			"Tax":"9.99",
			"Shipping":"6.50",
			"ConfigID":"31232dasdjjfdhuj3"
		},
		{
			"script":"NameRingUpload.py",
			"turntable":"false",
			"arguments":[
				"Love",
				"Sterling_Silver",
				"6"
			],
			"model":"[STL FILE]",
			"ItemNumber":"008408461s0639",
			"Description":"3 Letter Monogram",
			"Price":"19.99",
			"Tax":"9.99",
			"Shipping":"6.50",
			"ConfigID":"31dasd232jjfdhuj3"
		}
	]
}


```

<p>Depending on the number of items in the shopping cart, it can take up to a few seconds or a few minutes to create your order.</p>
For a Full List of our products and customization properties, please see here:</br>
http://www.polychemy.com/php/PolychemyAPI.php

<b>PHP Example.</b>

```php
<?php
//Set Script time out.
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
set_time_limit(300);
ignore_user_abort(false);



//Set Customer data and shipping details.
//We Will ship the product to this address.
$CustomerData = new stdClass();
$CustomerData->email = "customer@gmail.com";
$CustomerData->street = "Ave 12";
$CustomerData->city = "New York";
$CustomerData->state = "New York";
$CustomerData->zip = "123232";
$CustomerData->country = "United Statesd";
$CustomerData->name = "John Doe";
$CustomerData->hpnumber = "383748743";
$CustomerData->occasion = "none";

//Billing Adress. These values are optional.
$CustomerData->Billingstreet = "Ave 12";
$CustomerData->Billingcity = "New York";
$CustomerData->Billingstate = "New York";
$CustomerData->Billingzip = "123232";
$CustomerData->Billingcountry = "United Statesd";
$CustomerData->Billingname = "John Doe";
$CustomerData->Billinghpnumber = "383748743";

//Leave these variables Unchanged.
$CustomerData->gender = "none";
$CustomerData->forwho = "none";
$CustomerData->coupon = "";
$CustomerData->cdtoken = "";

//Shipping Type: Use "none" for deafault shipping method.
$CustomerData->ShippingType = "none";
//$CustomerData->ShippingType = "USPS";

//Invoice Number.
//If you wish to set the invoice number manually do so below. Leave blank if not required. This Value is Optional*
//The invoice number will be used for the shipping slips only.
$CustomerData->PONumber= "PO43234234";
$CustomerData->OrderNumber= "ORDER43234234";

//ReturnTCNumber. Return number for Shipping slips. This is Optional.
$CustomerData->ReturnTCNumber = "RETURNNUMBER";

//Total Ammount. Set the total price for shipping slip. Leave blank to use Polcyhemy's retail prices instead.
$CustomerData->TotalAmount = "100.99";

//Total Shipping Cost. Set the total price for shipping slip. Leave blank to use Polcyhemy's prices instead.
$CustomerData->ShippingCost = "6.50";

//email send polcyehmy invoice. if false, no invoice will be sent via email.
//If you want to send your own invoice, then keep this as FALSE.
$CustomerData->sendinvoice = false;

//Identification Variables
$referalData = new stdClass();

///***Replace ACCESS ID with the Access ID you were given.
$referalData->referalID = "[ACCESS ID]";
$referalData->type = $referalData->referalID;

///Customization Data.
$customizationData = new stdClass();
$customizationData->customerData = $CustomerData;

//**Set User ID. Ignore This.
$customizationData->ID = "";

//get referal information if there's any.
$customizationData->referal = $referalData; 
//set payment type. Keep as "ExternalCart".
$customizationData->paymentType = "ExternalCart";

//** This is your Secret Key.
$customizationData->secret = "[SECRET KEY]";


//create shopping cart array. add all items into this array.
$ShoppingCart = array();



//Create a Roman Ring. See Polychemy API Guide for customization details
$createItem = new stdClass();
$createItem->script = "RomanRing.py";
$createItem->turntable = "false";
$createItem->arguments  = array("Liove","Sterling_Silver", "6");
//The following are optional values, used for the shipping slip. These values can be ommited if you wish to use Polychemy values instead.
$createItem->ItemNumber = "008408461s0639";
$createItem->Description = "Elegant Roman Name Ring";
$createItem->Price = "19.99";
$createItem->ConfigID = "31232jjfdhuj3";
array_push($ShoppingCart, $createItem);


//Create a Roman Ring. See Polychemy API Guide for customization detail
$createItem = new stdClass();
$createItem->script = "SnowFlakeGem.py";
$createItem->turntable = "false";
$createItem->arguments  = array("6","Solid_Gold_18k","Yellow_Sapphire", "16 inch Chain (40 cm) - Child");

$createItem->ItemNumber = "008408461s0639";
$createItem->Description = "Elegant SNow Flake";
$createItem->Price = "59.99";
$createItem->ConfigID = "31232dasdjjfdhuj3";
array_push($ShoppingCart, $createItem);


//Upload Your own Name Ring Design.
$createItem = new stdClass();
$createItem->script = "NameRingUpload.py";
$createItem->turntable = "false";
$createItem->arguments  = array("Lovke","Sterling_Silver", "6");
//Upload STL file.
$model = file_get_contents("samples/3LETTERMONOGRAM.stl");
$createItem->model = base64_encode($model);
//The following are optional values, used for the shipping slip. These values can be ommited if you wish to use Polychemy values instead.
$createItem->ItemNumber = "008408461s0639";
$createItem->Description = "3 Letter Monogram";
$createItem->Price = "19.99";
$createItem->ConfigID = "31dasd232jjfdhuj3";
array_push($ShoppingCart, $createItem);


$customizationData->ShoppingCart = $ShoppingCart;


//CURL POST Script.
//set POST variables and URL.
$url = 'https://www.polychemy.com/php/Order.php';
//$url = 'http://localhost/php/Order.php';
$fields = array(
                        'customerData' => urlencode(json_encode($customizationData)),
                        'command' => urlencode("addOrder")
                );

//url-ify the data for the POST
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//execute post
if( ! $result = curl_exec($ch)) 
    { 
        trigger_error(curl_error($ch)); 
    } 

echo $result;
//close connection
curl_close($ch);

?>

```

<b>Example Response</b></br>
Sucessful Responce will return the invoice number:

```Json
{"result":"OK","invoiceNumber":"INV_25321124_PC","status":"success","data":{"referenceOrderId":"INV_25321124_PC"}}
```

Failed Response with Error message:
```Json
{
	"status" : "fail",
	"data" : {
		"code" : "221",
		"message" : "Customer Data missing, POST Variable Missing."
	}
}'

```
<h1>Order Que</h1>
Order Que allows users to add hundreds of orders a second to our servers with out crashing it.</br>
Orders are submitted to our system via POST. The orders are stored on a databse and then processed every hour.</br>
You will need to specifiy a call back address if there any errors or issues.</br>
<p>
The API is the same as the regular Order API, accept for 2 main differences</br>
-You will have to use a new URL : https://www.polychemy.com/php/OrderQue.php</br>
-You will need to specifiy a call back adress if you want to recieve error messages, though this is optional.</br>
</p>

```php
$url = 'https://www.polychemy.com/php/OrderQue.php';
$callBackURL = "http://yourserver/reponse.php";

$fields = array(
						
                      'customerData' => urlencode(json_encode($customizationData)),
					  'callbackURL' => urlencode($callBackURL)
                       'command' => urlencode("addOrder")
                );

//url-ify the data for the POST
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//execute post
if( ! $result = curl_exec($ch)) 
    { 
        trigger_error(curl_error($ch)); 
    } 

//close connection
curl_close($ch);
```
On Success:

```Json
{"result":"OK","invoiceNumber":"INV_25321124_PC","status":"success","data":{"referenceOrderId":"INV_25321124_PC"}}
```

Failed Response with Error message:
```Json
{
	"status" : "fail",
	"data" : {
		"code" : "221",
		"message" : "Failed To Add Order."
	}
}'

```

*File uuploads are not avilable for theorder que yet. </br>
*It's best to use the regular OrderAPI for debugging and switch over to OrderQue once you are ready. 
