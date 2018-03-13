<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>::Flightops email template::</title>
        <style type="text/css">
            html,body{
                font-family: Arial, sans-serif,Helvetica;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div style="padding:16px 60px;border-radius: 15px;text-decoration: none;color:#000000;font-weight: 600; width:600px;">
            <h1>Hi {{ $data['name']}}</h1>
            <table>
            	<tr><td>{{$data['body']}}</td></tr>
            </table>
        </div>
    </body>
</html>