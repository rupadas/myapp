<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @foreach($data as $value)
                    <div>
                        @foreach($value->images as $image)
                            <img src="{{$image->path}}" width="100" height="100">
                        @endforeach
                    </div>
                    <div>
                        <label>Year:</label>
                        {{$value->year}}
                    </div>
                    <div>
                        <label>Make:</label>
                        {{$value->make}}
                    </div>
                    <div>
                        <label>Model:</label>
                        {{$value->model}}
                    </div>
                    <div>
                        <label>Price:</label>
                        {{$value->price}}
                    </div>
                    <div>
                        <label>Name:</label>
                        {{$value->type->name}}
                    </div>
                    <div>
                        <label>Seller Name:</label>
                        {{$value->seller->name}}
                    </div>
                    <div>
                        <label>Reviews</label>
                        @foreach($value->reviews as $review)
                            {{$review->comment}}
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
