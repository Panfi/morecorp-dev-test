
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Morecorp laravel test</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
   

  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="{{ URL('/') }}" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Morecorp</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Album example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
           @if(!Auth::user())
            <div class="row">
                <div class="col-12 col-md-12">
                <a href="{{ route('login') }}"><button class="btn btn-primary">Log In to view and bid</button></a>
                </div>
            </div>    
            @endif

            @if(Auth::user())
            <a class="btn btn-primary my-2"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>  
            @endif
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <h1 class="text-center"><strong>Single Product details</strong></h1>
          <table class="table mb-5">
            <thead>
              <tr>
                <th>#</th>
                <th>name</th>
                <th>sku</th>
                <th>price</th>
                <th>description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $singleProduct->id }}</td>
                <td>{{ $singleProduct->name }}</td>
                <td>{{ $singleProduct->sku }}</td>
                <td>{{ $singleProduct->price }}</td>
                <td>{{ $singleProduct->description }}</td>
              </tr>
            </tbody>
          </table>
          <!-- <div class="row"> -->
          @if(Auth::user())

          <div class="row text-center">
            <div class="col-md-4">
              <h3><strong>Highest Bid</strong></h3>
              @if($highest_bid != '')
              <p>R {{ $highest_bid }}</p>
              @else
              <p>R 0.00</p>
              @endif
            </div>
            <div class="col-md-4">
              <h3><strong>Average Bid</strong></h3>
              @if( $avg_bid != '')
              <p>R {{ $avg_bid }} </p>
              @else 
              <p>R 0.00 </p>
              @endif
            </div>
            <div class="col-md-4">
              <h3><strong>Your Bid</strong></h3>
              @if( $last_bid['amount'] != '')
              <p>R {{ $last_bid->amount }} </p>
              @else 
              <p>R 0.00 </p>
              @endif
            </div>
          </div>
          <form action="{{ URL('store') }}" method="post">
              @csrf
            <div class="form-group">
            <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value="{{ $singleProduct->id }}" readonly>
            </div>
            <div class="form-group">
            <label for="amount">Enter amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" value="">
            </div>
            <button type="submit" class="btn btn-primary">Place a Bid</button>
            @endif
        </form>
        </div>
      </div>
    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script> -->
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- <script src="../../dist/js/bootstrap.min.js"></script>-->
    <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/holder.min.js"></script>
    
    <script>
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
    </script>

</body>
</html>
