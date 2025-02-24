<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventori Barang</title>
    <link rel="icon" href="{{ asset('images/kantor.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/modern-css-reset/dist/reset.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --light: #f8f9fa;
            --dark: #212529;
        }

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e8ff 100%);
            padding: 2rem;
        }

        .login-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1000px;
            width: 100%;
            overflow: hidden;
        }

        .hero-section {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            padding: 4rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero-image {
            width: 200px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .form-section {
            padding: 4rem;
            position: relative;
        }

        .form-header {
            margin-bottom: 3rem;
        }

        .form-header h1 {
            color: var(--dark);
            font-size: 2rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-group label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
            transition: all 0.3s ease;
            background: white;
            padding: 0 0.5rem;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 0.8rem;
            color: var(--primary);
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }

            .hero-section {
                padding: 2rem;
                display: none;
            }

            .form-section {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="login-container">
        <div class="hero-section">
            <img src="{{ asset('images/kantor.png') }}" alt="Inventory System" class="hero-image">
            <h2>Sistem Inventori Barang</h2>
            <p>Pusat Layanan Disabilitas dan Pendidikan Inklusi Prov. Kalsel (PLDPI)</p>
        </div>

        <div class="form-section">
            <div class="form-header">
                <h1>Selamat Datang</h1>
                <p>Silakan masuk dengan akun Anda</p>
            </div>

            <form action="/login" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder=" " required>
                    <label for="password">Password</label>
                </div>

                <button type="submit" class="login-btn">Masuk</button>
            </form>
        </div>
    </div>
</body>

</html>