<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('img/dvapp.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>Login</title>
</head>

<body>

    <section class="vh-100" style="background-color:#77a9ca;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-9">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img width="100%" height="auto" src="{{ asset('img/login.png') }}" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="" method="POST">
                                        @csrf

                                        <div class="d-flex align-items-center mb-3 pb-1 d-flex justify-content-center">
                                            <img style="border-radius: 50%" src="{{ asset('img/dvapp.png') }}"
                                                alt="DVAPP" width="40%">
                                        </div>

                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login</h3>

                                        <div class="form-outline mb-2">
                                            <input type="email" name="email" placeholder="Email"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @error('message')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="form-outline mb-2">
                                            <input type="password" name="password" placeholder="Contraseña"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Contraseña</label>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @error('message')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <div class="text-center">
                                            <a href="" class="text-muted">Olvidé mi
                                                contraseña</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
