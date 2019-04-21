<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>GreenPlaza</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table align="center" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #eee;">
 		<tr>
  			<td align="center" bgcolor="#ffffff" style="padding: 20px 0 30px 0; border-bottom: 5px solid #eee;">
 				<img src="{{asset('frontend/images/logo-fix.png')}}" alt="GreenPlaza" style="display: block; width: 150px;"/>
			</td>
 		</tr>
 		<tr>
  			<td bgcolor="#ffffff" style="padding: 30px 20px 30px 20px; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; border-bottom: 5px solid #eee;">
  				<h2>Status Transaksi !</h2>
				<p>Berikut informasi mengenai transaksi anda. <br></p>
  				<table style="width: 100%;">
  					<thead>
  					</thead>
  					<tbody>
  						<tr>
	  						<th style="text-align: left;">Kode Transaksi </th>
	  						<th>:</th>
	  						<th style="text-align: left;">{{$trans_code}}</th>
  						</tr>
  						<tr>
	  						<th style="text-align: left;">Total Transaksi </th>
	  						<th>:</th>
	  						<th style="text-align: left;">{{$trans_amount_total}}</th>
  						</tr>
  						<tr>
	  						<th style="text-align: left;">Status Transaksi </th>
	  						<th>:</th>
	  						<th style="text-align: left;">{{$status}}</th>
  						</tr>
  						{{-- <tr>
	  						<th style="text-align: left;">Tipe Pembayaran </th>
	  						<th>:</th>
	  						<th style="text-align: left;">{{$trans}}</th>
  						</tr> --}}
  					</tbody>
  				</table>
				<p>Silahkan login ke akun anda untuk mengecek kembali transaksi anda <a href="http://greenplaza.me/login">disini</a>. <br></p>
  			</td>
 		</tr>
 		<tr>
  			<td style="font-family: Arial, sans-serif; font-size: 14px;">
  				<table cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td style="padding: 10px">
				   <span style="background: #e45e67;display: inline; padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;">
				   		<b>GreenPlaza Present.</b>
				   </span>
				  </td>
				</tr>
				<tr>
				  <td bgcolor="#35ac19">
				   <p style="text-align: center; color: #fff;">&copy; GreenPlaza</p>
				  </td>
				 </tr>
				</table>
  			</td>
 		</tr>
	</table>
</body>
</html>