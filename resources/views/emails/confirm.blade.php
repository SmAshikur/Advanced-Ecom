
<html>
<head>
    <title>

    </title>
</head>
<body>
<table>
    <tr>
        <td>Dear {{$name}} </td>
    </tr>
    <tr>
        <td>please click below link to confirm your Account:- </td>
    </tr>
    <tr>
        <td>&nbsp; </td>
    </tr>
    <tr>
      <a href="{{url('confirm/'.$code)}}" target="_blank"> Confirm Account</a>
    </tr>
    <tr>
        <td>Thank for joining us  </td>
    </tr>
    <tr>
        <td>&nbsp; </td>
    </tr>
    <tr>
        <td>Becha Kena Bazar </td>
    </tr>
</table>
</body>
</html>
