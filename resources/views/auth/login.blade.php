<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <style>
        body {
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#2563eb,#1e293b);
            font-family:'Segoe UI',sans-serif;
        }
        .login-box {
            background:white;
            width:380px;
            padding:30px;
            border-radius:14px;
            box-shadow:0 10px 40px rgba(0,0,0,.25);
        }
        .login-box h2 {
            text-align:center;
            margin-bottom:10px;
        }
        .login-box p {
            text-align:center;
            color:#64748b;
            margin-bottom:25px;
        }
        input {
            width:100%;
            padding:12px;
            margin-bottom:14px;
            border-radius:8px;
            border:1px solid #cbd5f5;
        }
        button {
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#2563eb;
            color:white;
            font-weight:600;
            cursor:pointer;
        }
        button:hover {
            background:#1d4ed8;
        }
        .error {
            background:#fee2e2;
            color:#b91c1c;
            padding:10px;
            border-radius:8px;
            margin-bottom:12px;
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <p>Website SDN 05 Pagi Joglo</p>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email"
               placeholder="Email Admin"
               required autofocus>

        <input type="password" name="password"
               placeholder="Password"
               required>

        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
