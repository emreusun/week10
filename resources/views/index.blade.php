<html>
    <head>
        <style>
            body {
                background-color: black;
                color: whitesmoke;
            }
        </style>  

    </head> 
    <body>
        {{-- <h1>Hello, world!</h1>  --}}
        {{-- <h1><php echo $title; ?></h1>  --}}
        {{-- is the same as: --}}
        <h1>{{ $title }}</h1> 
        <h2>{{ $subtitle }}</h2> 

        {{-- loop over the list of items and print each one out --}}
        @foreach ($list as $item)
            <p>
                {{ $item }}
            </p>  
        @endforeach

        <h3>Countries</h3>  
        @foreach ($countries as $country)
            <p>
                {{ $country->name }}
            </p>  
        @endforeach

        {{ $canada->id }} {{ $canada->name }}

        {{-- Use @dd or @dump to see the content so a variable --}}
        {{-- @dump($subtitle) --}}
        {{-- @dd($list) --}}
    </body> 
</html> 