<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <style>
      html,
      body {
        font-family: 'IBM Plex Mono', monospace;
      }
    </style>
    <title>Gravity</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Gravulator</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-end ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/play">Play</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="row py-5">
        <div class="col">
          <h3>Input:</h3>
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <tbody>
                @foreach($input as $row)
                <tr>
                  @foreach($row as $value)
                  <td>
                    @if($value == '.')
                    <i class="text-success fas fa-angle-down"></i>
                    @elseif($value == 'T')
                    <i class="text-danger fas fa-stop"></i>
                    @else
                    &nbsp;
                    @endif
                  </td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="form-text text-muted">
            <small><i class="text-success fas fa-angle-down"></i> Rock</small>
            <small><i class="text-danger fas fa-stop"></i> Table</small>
          </div>
        </div>
      </div>
      <div class="row py-5">
        <div class="col">
          <h3>Result:</h3>
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <tbody>
              @foreach($matrix as $row)
                <tr>
                @foreach($row as $value)
                  <td>
                    @if($value == '.')
                    <i class="text-success fas fa-angle-down"></i>
                    @elseif($value == ':')
                    <i class="text-success fas fa-angle-double-down"></i>
                    @elseif($value == 'T')
                    <i class="text-danger fas fa-stop"></i>
                    @else
                    &nbsp;
                    @endif
                  </td>
                @endforeach
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="form-text text-muted">
            <small><i class="text-success fas fa-angle-down"></i> Rock</small>
            <small><i class="text-success fas fa-angle-double-down"></i> Stack</small>
            <small><i class="text-danger fas fa-stop"></i> Table</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>