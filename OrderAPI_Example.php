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
