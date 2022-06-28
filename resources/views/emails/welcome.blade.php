<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>
	<h3>Hello {{$details['Fname']}} {{$details['Lname']}}</h3>
	<h3>{{$details['title']}}</h3>
	<p>{!! $details['body'] !!}</p>
	<p>Thank you in advance.</p>
	<p>Best Regards,</p>
</body>
</html>