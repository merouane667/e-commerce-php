@extends('layouts.master')

@section('content')
     <div class="col-md-12">
        <div class="jumbotron text-center">
            @php
            $products = $Orderedproducts;
            @endphp
            
            @if ($products == [])
            <h1 class="display-5">You have not purchased any product yet!</h1>
            @else
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Description</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                        @php
                        $proFormated = get_object_vars(json_decode($product));
                        @endphp
                        @for ($i = 0; $i < count($proFormated); $i++)
                        <tr>
                            <th scope="row"> </th>
                            @for ($j = 0; $j < count($proFormated["product_".$i]); $j++)
                                @if ($j == 1)
                                    @php
                                    $priceFormated = strval(intval($proFormated["product_".$i][$j])/100);
                                    @endphp
                                    <td>{{ $priceFormated." USD" }}</td>
                                @else
                                <td>{{ $proFormated["product_".$i][$j] }}</td>
                                @endif
                            @endfor
                        </tr>
                        @endfor

                    @endforeach

                  
                </tbody>
              </table>
              <a href="{{ route('pdf') }}"><svg style="margin-bottom: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
              </svg> PDF INVOICE</a>
            @endif

        </div>
    </div>
@endsection