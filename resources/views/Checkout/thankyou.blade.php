@extends('layouts.master')

@section('content')
     <div class="col-md-12">
        <div class="jumbotron text-center">
            <h1 class="display-3">Thank you!</h1>
            <p class="lead"><strong>Your item has been ordered successfully!</strong></p>
            <hr>
            <p>
                Facing a problem? <a href="#">Contact our support</a>
            </p>
            <p class="lead">
                <a class="btn btn-info btn-sm" href="{{ route('products.index') }}" role="button">Go back to store</a>
            </p>
        </div>
    </div>
@endsection