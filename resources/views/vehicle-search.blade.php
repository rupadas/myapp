<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @if(!empty($data))
                    <table>
                        <thead>
                            <th>Dispaly image</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Price</th>
                            <th>Details Link</th>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                @if($value->displayImage != null)
                                    <td><img src="{{$value->displayImage->path}}" width="100" height="100"></td>
                                @else
                                <td><img alt="No Display" width="100" height="100"></td>
                                @endif
                                <td>{{ $value->make }}</td>
                                <td>{{ $value->model }}</td>
                                <td>{{ $value->price }}</td>
                                <td><a href="/vehicles/details/{{$value->id}}">Details</a></td>
                            <tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div>No matching data found</div>
                @endif
            </div>
        </div>
    </body>
</html>
