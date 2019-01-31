<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>GreenPlaza</title>
    <style type="text/css">
		body,td,div,p,a,input {font-family: arial, sans-serif;}
	</style>
</head>
<body style="margin: 0; padding: 0;">
	<table align="center" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #eee;">
 		<tr>
  			<td align="center" bgcolor="#ffffff" style="padding: 20px 0 30px 0; border-bottom: 5px solid #eee;">
 				<img src="{{asset('frontend/logo-fix.png')}}" alt="Editeg" style="display: block; width: 150px;"/>
			</td>
 		</tr>
 		<tr>
  			<td bgcolor="#ffffff" style="padding: 30px 20px 30px 20px; color: #153643; font-size: 12px; line-height: 20px; border-bottom: 5px solid #eee;">
   				{{$email->email_subject}}<br>
				<p>{!!$email->email_text!!}</p>
  			</td>
 		</tr>
 		<tr>
  			<td style="font-family: Arial, sans-serif; font-size: 12px;">
				<tr>
				  <td bgcolor="#4caf50">
				   <p style="text-align: center; color: #fff;">&copy; GreenPlaza</p>
				  </td>
				 </tr>
  			</td>
 		</tr>
	</table>
</body>
</html>