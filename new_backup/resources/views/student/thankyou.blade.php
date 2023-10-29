
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thank you | Online Quran Tutor</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
    /* background: #fff; */
    font-family: 'Ubuntu', sans-serif;
}

    </style>
  </head>

  <body>
    <div class="cover-container m-auto p-3">
        <div class="shadow-lg mb-5 bg-white rounded" style="box-shadow: 0px 0px 39px -19px rgba(0,0,0,0.45);">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a href="{{ route('index') }}"><img class="mb-4" src="{{ asset('images/logo.png') }}" alt="" width="200"></a>
                    <hr class="m-0">
                    <h1 class="mb-0 mt-4" style="font-size:5vw;">Thank You</h1>
                      <h4 class="mb-3 p-0">for your inquiry</h4>
                  </div>




            </div>
            <div style="background:#F9F9F9;">
                <br>
                <br>
                <div class="media p-4">
                    <i class="far fa-hand-peace fa-6x text-success"></i>
                    <div class="media-body p-3">
                      <h5 class="mt-0">Great!</h5>
                        <p class="m-0">Welcome our awesome customer - You've just joined an amazing group of online tutors.<br/>Hopefully you will feel awesome by our provided services <i class="far fa-smile"></i></p>
                    </div>
                  </div>
                  <div class="text-center">
                      <div class="bg-dark text-white">
<h5 class="pt-5">Curious about inquiries?</h5>
<h6>Want to redirect somewhere!</h6>
<div class="btn-group pb-5">
    <a href="{{ route('student.dashboard') }}" class="btn btn-info btn-lg rounded-0"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{ route('index') }}" class="btn btn-success btn-lg rounded-0"><i class="fas fa-globe"></i> Homepage</a>
</div>
                      </div>
                  </div>
            </div>

              <p class="mb-3 p-3 text-muted text-center">Copyright &copy;  2021 | Online Quran Tutor</p>
        </div>
    </div>
  </body>
</html>
