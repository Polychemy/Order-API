# Polychemy's REST Order API. BETA.
Place Custom orders directly on polychemy.com.<br>
HTTP Method : POST
<p>
Use this API to palce custom orders in Polychemy. STL files are genrated on the fly and send to our manufacturing network.</br>
For a Full List of our products and customization properties, please see here:</br>
http://www.polychemy.com/php/PolychemyAPI.php
</p>

<h1> Create Order Example</h1>
<p>In This example we will create an order with 2 items in the shopping cart. 1 Roman Ring & 1 Snow Flake Necklace</p>

HTTP Method : POST<br>
URL : https://polychemy.com/php/Order.php</br>
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
	"gender":"none",
	"forwho":"none",
	"coupon":"",
	"cdtoken":"",
	"sendinvoice":false
},
"ID":"",
"referal":{
	"referalID":"[ACCESS ID]",
	"type":"[ACCESS ID]"
},
"paymentType":"ExternalCart",
"secret":"[SECRET KEY]",
"ShoppingCart":[
		{
			"script":"RomanRing.py",
			"turntable":"false",
			"arguments":[
			"Love",
			"Sterling_Silver",
			"6"]
		},
		{
			"script":"SnowFlakeGem.py",
			"turntable":"false",
			"arguments":[
			"5",
			"Solid_Gold_18k",
			"Yellow_Sapphire",
			"16 inch Chain (40 cm) - Child"]
		}
	]
}

```

<p>Depending on the number of items in the shopping cart, it can take up to a few seconds or a few minutes to create your order.</p>
For a Full List of our products and customization properties, please see here:</br>
http://www.polychemy.com/php/PolychemyAPI.php

<b>PHP Example.</b>

```json
<?php
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
//Leave these variables blank.
$CustomerData->gender = "none";
$CustomerData->forwho = "none";
$CustomerData->coupon = "";
$CustomerData->cdtoken = "";

//send polcyehmy invoice. if false, no invoice will be sent.
//If oyu want to send your own invoice, then keep this as FALSE.
$CustomerData->sendinvoice = false;

//Identification Variables
$referalData = new stdClass();

///***Replace ACCESS ID with the Access ID you were given.
$referalData->referalID = "[ACCESS ID]";
$referalData->type = $referalData->referalID;

///Customization Data.

$customizationData = new stdClass();
$customizationData->customerData = $CustomerData;

//**Set User ID.
$customizationData->ID = "";

//get referal information if there's any
$customizationData->referal = $referalData; 
//set payment type.
$customizationData->paymentType = "ExternalCart";

//** This is your Secret Key.
$customizationData->secret = "[SECRET KEY]";


//create shopping cart array. add all items into this array.
$ShoppingCart = array();

//Create a Roman Ring. See Polychemy API Guide for customization details
$createItem = new stdClass();
$createItem->script = "RomanRing.py";
$createItem->turntable = "false";
$createItem->arguments  = array("Love","Sterling_Silver", "6");
array_push($ShoppingCart, $createItem);

//Create a Roman Ring. See Polychemy API Guide for customization detail
$createItem = new stdClass();
$createItem->script = "SnowFlakeGem.py";
$createItem->turntable = "false";
$createItem->arguments  = array("5","Solid_Gold_18k","Yellow_Sapphire", "16 inch Chain (40 cm) - Child");
array_push($ShoppingCart, $createItem);

$customizationData->ShoppingCart = $ShoppingCart;

//CURL POST Script.
//set POST variables and URL.
$url = 'https://www.polychemy.com/php/Order.php';
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

<b>REsponse</b>
Sucessful Responce will return the invoice number:

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
