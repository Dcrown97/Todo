<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Todo App</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                            <form action="/register" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="first_name" placeholder="Full name"
                                                id="firstName" class="form-control form-control-lg" required />
                                            <label class="form-label" for="firstName">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="number" name="phone_number" placeholder="Phone Number"
                                                id="lastName" class="form-control form-control-lg" required />
                                            <label class="form-label" for="lastName">Phone number</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                id="emailAddress" class="form-control form-control-lg" required />
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="">
                                    <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                swal(
                    'Success',
                    `{{ session()->get('success') }}`
                )
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                swal(
                    'Error',
                    `{{ session()->get('error') }}`
                )
            });
        </script>
    @endif
</body>

</html>
