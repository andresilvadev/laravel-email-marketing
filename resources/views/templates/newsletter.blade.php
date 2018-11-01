<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width" initial-scale="1.0" user-scalable="yes">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">

<title>{!! $emailName !!}</title>
<meta name="robots" content="noindex, nofollow">

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <h1>{!! $emailName !!}</h1>
            </td>
        </tr>
        <tr>
            <td align="center">
                {!! $emailBody !!}
            </td>
        </tr>
        <tr>
            <td align="center">
                <img src="{{asset('uploads/email_images/'. $emailImage )}}">
            </td>
        </tr>
    </table>
</body>
</html>
