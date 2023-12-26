@extends('layout.source_dashboard')
@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('assets/landing/img/bg_kuning.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0" style="padding: 20px">
                                        Sign in</h4>

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('login.action') }}" method="POST" role="form"
                                    accept="application/json" class="text-start" id="login-form">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Username</label>
                                        <input name="username" type="text" class="form-control" id="username">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" id="password">
                                    </div>
                                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"
                                            id="sign">Sign in</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        Belum punya akun?<br>
                                        <span class="text-primary">Silahkan hubungi pihak sekolah</span>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signInForm = document.getElementById('login-form');
            const errorDiv = document.getElementById('error-message');

            signInForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                if (username === '' && password === '') {
                    showError('Username dan password tidak boleh kosong.');
                } else if (username === '') {
                    showError('Username tidak boleh kosong.');
                } else if (password === '') {
                    showError('Password tidak boleh kosong.');
                } else {
                    if (username !== 'username_example' || password !== 'password_example') {
                        showError('Username atau password salah.');
                    } else {
                        signInForm.submit();
                    }
                }
            });

            function showError(message) {
                errorDiv.style.display = 'block';
                errorDiv.textContent = message;
            }
        });
    </script> --}}
@endsection
