<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="x-apple-disable-message-reformatting">
<title>Order Confirmation</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700" rel="stylesheet">    
<style>
html, body {
    margin: 0 auto !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
    background: #f1f1f1;
}
* {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}
div[style*="margin: 16px 0"] { margin: 0 !important; }
table, td { mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; }
table { border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important; }
img { -ms-interpolation-mode:bicubic; }
a { text-decoration: none; }
*[x-apple-data-detectors], .unstyle-auto-detected-links *, .aBn {
    border-bottom: 0 !important; cursor: default !important; color: inherit !important;
    text-decoration: none !important; font-size: inherit !important; font-family: inherit !important;
    font-weight: inherit !important; line-height: inherit !important;
}
.a6S { display: none !important; opacity: 0.01 !important; }
.im { color: inherit !important; }
img.g-img + div { display: none !important; }

/* Responsive fix for iPhones */
@media only screen and (max-width: 414px) {
    u ~ div .email-container { min-width: 100% !important; }
}

/* ==== THEME STYLES ==== */
.primary-bg { background: #2C5EAD !important; }
.bg_white { background: #ffffff; }
.bg_black { background: #000000; }
.email-section { padding: 10px 20px; }

.btn {
    padding: 8px 20px; display: inline-block; border-radius: 5px;
    font-weight: bold; letter-spacing: 0.5px;
}
.btn-primary { background: #2C5EAD; color: #fff !important; }
.btn-black { background: #000; color: #fff !important; }

h1,h2,h3,h4,h5,h6 {
    font-family: 'Nunito Sans', Arial, sans-serif; color: #000; margin-top: 0;
}
body {
    font-family: 'Nunito Sans', Arial, sans-serif;
    font-size: 15px; line-height: 1.8; color: rgba(0,0,0,.6);
}
.logo h1 { margin: 0; }
.logo h1 a { color: #000; font-size: 20px; font-weight: 700; }
.navigation li {
    list-style: none; display: inline-block; margin-left: 10px;
    font-size: 13px; font-weight: 600;
}
.navigation li a { color: rgba(0,0,0,.6); }

.pricing {
    border: 1px solid #2C5EAD;
    padding: 1.5em;
    border-radius: 6px;
    text-align: left;
    background: #2c5ead38;
}
.pricing p { margin: 8px 0; font-size: 14px; color: #333; }

.footer { color: rgba(255,255,255,.8); }
.footer a { color: #fff; text-decoration: underline; }
</style>
</head>

<body style="margin:0; padding:0; background-color:#f1f1f1;">
<center style="width:100%; background-color:#f1f1f1;">
  <div style="max-width:600px; margin:0 auto;" class="email-container">
    <!-- HEADER -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="bg_white" style="padding:20px;">
      <tr>
        <td width="40%" class="logo" style="text-align:left;padding: 0px 10px !important;">
          <h1><a href="{{ env('WEBSITE_URL') }}">{{ env('APP_NAME') }}</a></h1>
        </td>
        <td width="60%" style="text-align:right;padding: 0px 10px !important;">
          <ul class="navigation" style="margin:0; padding:0;">
            <li><a href="{{ env('WEBSITE_URL') }}">Home</a></li>
            <li><a href="{{ env('WEBSITE_URL') }}/about-us">About</a></li>
            <li><a href="{{ env('WEBSITE_URL') }}/contact">Contact</a></li>
            <li><a href="{{ env('WEBSITE_URL') }}/user/login">Login</a></li>
          </ul>
        </td>
      </tr>
    </table>

    <!-- HERO SECTION -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td class="hero bg_white">
          <table role="presentation" width="100%">
            <tr>
             
              <td width="100%" class="primary-bg" style="text-align:left; padding:25px;">
                <h1>Order Confirmed</h1>
                <p>Order #{{ $order['order_number'] }}</p>
                <p><a href="{{ env('WEBSITE_URL') }}" class="btn btn-black">Visit us</a></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- BODY CONTENT -->
    <table role="presentation" width="100%" class="bg_white" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td class="email-section" style="text-align:center;">
          <h2>Hi {{ $order['first_name'] }},</h2>
          <p>Thank you for choosing <strong>{{ env('MAIL_FROM_NAME') }}</strong>!  
          Your order has been successfully confirmed.</p>
        </td>
      </tr>

      <tr>
        <td class="email-section" style="text-align:center;">
          <h2>Your Order Details</h2>
          <div class="pricing">
            <p><strong>Invoice:</strong> #{{ $order['order_number'] }}</p>
            <p><strong>Total Amount:</strong> {{ $order['currency'] }} {{ number_format($order['total_amount'], $order['currency']=='JPY' ? 0 : 2) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('D d M, Y') }}</p>
            <p style="text-align:center; margin-top:20px;">
              <a href="{{ env('WEBSITE_URL') }}/user/order/show/{{$order['id']}}" class="btn btn-primary">View Detail</a>
            </p>
          </div>
        </td>
      </tr>
        <tr>
        <td style="text-align:center;">
        
          <p style="margin:10px 0 0;padding:10px;">If you need any help, email us at 
            <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>.
          </p>
        </td>
      </tr>
    </table>

    

  </div>
</center>
</body>
</html>
