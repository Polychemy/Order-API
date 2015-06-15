# Polychemy's REST Order API. BETA.
Place Custom orders directly on polychemy.com.<br>
HTTP Method : POST
<p>
Use this API to palce custom orders in Polychemy. STL files are genrated on the fly and send to our manufacturing network.</br>
For a Full List of our products and customization properties, please see here:

</p>

<h1> Create Order </h1>
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
		"6"
	]
	},
	{
		"script":"SnowFlakeGem.py",
		"turntable":"false",
		"arguments":[
		"5",
		"Solid_Gold_18k",
		"Yellow_Sapphire",
		"16 inch Chain (40 cm) - Child"
	]
	}
	]
}

```

<p>Depending on the number of items in the shopping cart, it can take up to a few seconds or a few minutes to create your order.</p>

