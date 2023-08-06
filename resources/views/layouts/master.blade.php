
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    @yield('extra-meta')
    <title>Larashop</title>

    @yield('extra-script')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
        <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
        <meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }

      }
      @media (max-width: 1000px) {

        .home-link{
          display: none;
        }
        .searchBar{
          margin-right: 50px;
        }
      }
      /* stylelint-disable selector-list-comma-newline-after */

        .blog-header {
        line-height: 1;
        border-bottom: 1px solid #e5e5e5;
        }

        .blog-header-logo {
        font-family: "Playfair Display", Georgia, "Times New Roman", serif;
        font-size: 2.25rem;
        }

        .blog-header-logo:hover {
        text-decoration: none;
        }

        h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display", Georgia, "Times New Roman", serif;
        }

        .display-4 {
        font-size: 2.5rem;
        }
        @media (min-width: 768px) {
        .display-4 {
            font-size: 3rem;
        }
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }

        .nav-scroller .nav-link {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: .875rem;
        }

        .card-img-right {
        height: 100%;
        border-radius: 0 3px 3px 0;
        }

        .flex-auto {
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        }

        .h-250 { height: 250px; }
        @media (min-width: 768px) {
        .h-md-250 { height: 250px; }
        }

        /* Pagination */
        .blog-pagination {
        margin-bottom: 4rem;
        }
        .blog-pagination > .btn {
        border-radius: 2rem;
        }

        /*
        * Blog posts
        */
        .blog-post {
        margin-bottom: 4rem;
        }
        .blog-post-title {
        margin-bottom: .25rem;
        font-size: 2.5rem;
        }
        .blog-post-meta {
        margin-bottom: 1.25rem;
        color: #999;
        }

        /*
        * Footer
        */
        .blog-footer {
        padding: 2.5rem 0;
        color: #999;
        text-align: center;
        background-color: #f9f9f9;
        border-top: .05rem solid #e5e5e5;
        }
        .blog-footer p:last-child {
        margin-bottom: 0;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="{{ route('cart.index') }}">Cart <img src="{{ asset('img/cart.png') }}" class="pr-2 " style="max-width:40px;" alt=""> <space class="badge-pill badge-info">{{ Cart::count() }}</space></a>
      </div>
      <div class="col-4 text-center home-link">
      <img src="{{ asset('img/logo.png') }}" class="" style="max-width:70px;" alt="">
      <div>
        <a class="blog-header-logo text-dark mb-10" href="{{ route('products.index') }}">Larashop</a>
      </div>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        @include('partials.search')
        {{-- @include('partials.auth') --}}
        <a class="btn btn-sm btn-outline-secondary mr-1" href="/orders">Orders</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('signout') }}">Logout</a>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
     @foreach(App\Category::all() as $category)
      <a class="p-2 text-muted" href="{{ route('products.index' , ['categorie' => 
         $category->slug]) }}">{{ $category->name }}</a>
     @endforeach
    </nav>
  </div>

  @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}

        </div>
  @endif

  @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}

        </div>
  @endif

  @if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
  @endif

  @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul class="mb-0 mt-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
  @endif


<!-- <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>-->

  @if (request()->input('q'))
    <h6>{{ $products->total() }} résultat(s) pour la recherche "{{ request()->q }}"</h6>
  @endif

  <div class="row mb-2">
     @yield('content')
  </div>
</div>

<!--<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>

      <div class="blog-post">
        <h2 class="blog-post-title">Sample blog post</h2>
        <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

        <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
        <hr>
        <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
        <blockquote>
          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </blockquote>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <h2>Heading</h2>
        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        <pre><code>Example code block</code></pre>
        <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <ul>
          <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
          <li>Donec id elit non mi porta gravida at eget metus.</li>
          <li>Nulla vitae elit libero, a pharetra augue.</li>
        </ul>
        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
        <ol>
          <li>Vestibulum id ligula porta felis euismod semper.</li>
          <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
          <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
        </ol>
        <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
      </div>

      <div class="blog-post">
        <h2 class="blog-post-title">Another blog post</h2>
        <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

        <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
        <blockquote>
          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </blockquote>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
      </div>

      <div class="blog-post">
        <h2 class="blog-post-title">New feature</h2>
        <p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <ul>
          <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
          <li>Donec id elit non mi porta gravida at eget metus.</li>
          <li>Nulla vitae elit libero, a pharetra augue.</li>
        </ul>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
      </div>

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav>

    </div>

    <aside class="col-md-4 blog-sidebar">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">March 2014</a></li>
          <li><a href="#">February 2014</a></li>
          <li><a href="#">January 2014</a></li>
          <li><a href="#">December 2013</a></li>
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
          <li><a href="#">June 2013</a></li>
          <li><a href="#">May 2013</a></li>
          <li><a href="#">April 2013</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </aside>

  </div>

</main>/.container -->

<footer class="blog-footer">
  <p>test <a href="#">Larashop</a> by <a href="#">test</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
@yield('extra-js')
</body>
</html>
