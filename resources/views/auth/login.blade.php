<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Administrator | Login</title>
    <link href="{{ asset('img/'. $page_setting->ikon)}}" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    </div>
                    <div class="card shadow-lg">
                        <div class="text-center mt-4">
                            <img src="{{ asset('img/pertinas-logo.jpg') }}" alt="logo" width="100">
                        </div>
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Login</h1>
                            <form action="{{ route('login.process') }}" method="post" class="needs-validation" novalidate="" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="login">Username</label>
                                    <input id="login" type="text" class="form-control" name="login" required autofocus>
                                    <div class="invalid-feedback">
                                        Username is required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted" for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="pwd" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                     {!! $footer !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>