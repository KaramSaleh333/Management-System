<h1>{{$product->name}}</h1> <h3></h3>
<h3>price: {{$product->price}}</h3>
<p><a href="javascript:window.print()"><img src="{{asset('images/'.$product->qr_image_path)}}"></a></p>