@extends('layouts.master')

@section('content')
  @foreach ($products as $product)
  <div class="col-md-6">
    <div class="row no-gutters border rounded d-flex align-items-center flex-md-row mb-4 shadow-sm position-relative" style="height:300px;">
      <div class="col p-4 d-flex flex-column position-static">
      <strong class="d-inline-block mb-2 text-success">
        @foreach ($product->categories as $category)
             {{ $category->name }}
        @endforeach
      </strong>
      <h5 class="mb-0">{{ $product->title }}</h5>
      <div class="mb-1 text-muted">{{ $product->created_at->format('d/m/Y') }}</div>
      <p class="mb-auto">{{ $product->subtitle }}</p>
      <strong class="mb-auto">{{ $product->getPrice() }}</strong>
      <a href="{{ route('products.show', $product->slug) }}" class="stretched-link btn btn-info">Consulter le produit</a>
    </div>
    <div class="col-auto d-none d-lg-block">
      <img src="{{ asset('images/' . $product->image) }}" class="py-4" style="width: 200px;height: 250px;margin-right:20px;" alt="">
    </div>
  </div>
</div>
  @endforeach
  {{ $products->appends(request()->input())->links() }}
@endsection