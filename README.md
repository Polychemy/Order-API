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



