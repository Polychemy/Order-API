# Polychemy's REST Order API. BETA.
Place Custom orders directly on polychemy.com.<br>
HTTP Method : POST
<p>
Use this API to palce custom orders in Polychemy. STL files a genrated on the fly and send to our manufacturing network.</br>
FOr a Full List 

</p>

<h1> Create Order </h1>
HTTP Method : POST<br>

Sample JSON Request:

```json
{
	"customerData":{
		"email":"aaron.issac@gmail.com",
		"street":"Ave 12",
		"city":"New York",
		"state":"New York",
		"zip":"123232",
		"country":"United States",
		"name":"John Doe",
		"hpnumber":"383748743",
		"gender":"none",
		"forwho":"none",
		"occasion":"none",
		"coupon":"",
		"cdtoken":"",
		"sendinvoice":false
	},
	"ShoppingCart":[{ JSON ENCODED PRODUCT DATA }],
	"ID":"641567956",
	"referal":{
		"referalID":"[ACCESS ID]",
		"type":"[ACCESS ID]"
	},
	"paymentType":"ExternalCart",
	"secret":"polychemy"
}

```

Here's another JSON Example. This time with a test product (from productDATA).
This is how your JSON should look when you pass the data to us. Be sure to serealize the JSON request before sending it to us

```Json
{
	"customerData":{
	"email":"aaron.issac@gmail.com",
	"street":"Ave 12",
	"city":"New York",
	"state":"New York",
	"zip":"123232",
	"country":"United States",
	"name":"John Doe",
	"hpnumber":"383748743",
	"gender":"none",
	"forwho":"none",
	"occasion":"none",
	"coupon":"",
	"cdtoken":"",
	"sendinvoice":false
	},
	"ShoppingCart":[
		{
		"type":"Roman Name Ring",
		"sku":"ROMANRING",
		"arg":[
		"small",
		"Sterling_Silver",
		"6"
		],
		"argvalue":[
		"Custom Text",
		"Material",
		"Ring Size"
		],
		"commandlist":[
		"TEXT",
		"MATERIAL",
		"RINGSIZE"
		],
		"RAWcommandlist":[
		"TEXT:7:Love:CHECKCHAR",
		"MATERIAL:ALL",
		"RINGSIZE:ALL"
		],
		"priceDisplay":121.58,
		"folder":"3568471218459308000",
		"itemnum":"3568471218459308000",
		"image":"http:\/\/polychemy3d.com\/ModelDATABASE.php?getfile=JPG&ID=3568471218459308000",
		"volume":"0.3335311903633674",
		"price":129.99
		}
	],
"ID":"641567956",
"referal":{
	"referalID":"[ACCESS ID]",
	"type":"[ACCESS ID]"
}

```

