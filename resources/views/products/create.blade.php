@extends('layouts.master')

@section('content')
     <div class="col-md-12">
        <div class="jumbotron text-center" style="display: flex;justify-content: center;">
            
            <form action="/products" method="post" class="w-50" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title">Title:</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                  <label for="subtitle">Subtitle:</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle">
                </div>
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea id="description" class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="price">Price:</label>
                  <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" class="form-control" name="category_id">
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>              

        </div>
    </div>
@endsection