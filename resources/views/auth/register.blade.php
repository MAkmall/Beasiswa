{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Sistem Beasiswa</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .register-card {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            margin: 20px 0;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .form-control, .form-select {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .input-group-text {
            border-radius: 15px 0 0 15px;
            border: 2px solid #e9ecef;
            border-right: none;
            background: #f8f9fa;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 15px 15px 0;
        }
        
        .text-primary {
            color: #667eea !important;
        }
        
        .btn-outline-secondary {
            border-radius: 25px;
            border-color: #6c757d;
            color: #6c757d;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            transform: translateY(-2px);
        }

        .form-floating > .form-control {
            border-radius: 15px;
        }

        .form-floating > label {
            padding: 1rem 1.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card register-card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">
                                <i class="fas fa-graduation-cap"></i> Sistem Beasiswa
                            </h2>
                            <p class="text-muted">Buat akun baru untuk mendaftar beasiswa</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terdapat kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            
                            <div class="row">
                                <!-- Informasi Akun -->
                                <div class="col-12">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-user-circle me-2"></i>Informasi Akun
                                    </h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="contoh@email.com"
                                               required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Minimal 8 karakter"
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2"></i>Konfirmasi Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Ulangi password"
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Informasi Pribadi -->
                                <div class="col-12 mt-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-id-card me-2"></i>Informasi Pribadi
                                    </h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-semibold">
                                        <i class="fas fa-phone me-2"></i>Nomor Telepon
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone') }}" 
                                               placeholder="08xxxxxxxxxx"
                                               required>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label fw-semibold">
                                        <i class="fas fa-calendar me-2"></i>Tanggal Lahir
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar text-muted"></i>
                                        </span>
                                        <input type="date" 
                                               class="form-control @error('birth_date') is-invalid @enderror" 
                                               id="birth_date" 
                                               name="birth_date" 
                                               value="{{ old('birth_date') }}" 
                                               required>
                                    </div>
                                    @error('birth_date')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label fw-semibold">
                                        <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                                    </label>
                                    <select class="form-select @error('gender') is-invalid @enderror" 
                                            id="gender" 
                                            name="gender" 
                                            required>
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="education_level" class="form-label fw-semibold">
                                        <i class="fas fa-graduation-cap me-2"></i>Jenjang Pendidikan
                                    </label>
                                    <select class="form-select @error('education_level') is-invalid @enderror" 
                                            id="education_level" 
                                            name="education_level" 
                                            required>
                                        <option value="">Pilih jenjang pendidikan</option>
                                        <option value="SMA/SMK" {{ old('education_level') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('education_level') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                        <option value="S1" {{ old('education_level') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                        <option value="S2" {{ old('education_level') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                        <option value="S3" {{ old('education_level') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                    </select>
                                    @error('education_level')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="address" class="form-label fw-semibold">
                                        <i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="3" 
                                              placeholder="Masukkan alamat lengkap Anda"
                                              required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            Saya menyetujui <a href="#" class="text-primary">syarat dan ketentuan</a> yang berlaku
                                        </label>
                                    </div>
                                    @error('terms')
                                        <div class="text-danger mt-1">
                                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
            const password = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            e.target.value = value;
        });
    </script>
</body>
</html>