<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>پرداخت موفق</title>
  <style>
    body {
      background-color: #e9f9ec;
      color: #2e7d32;
      font-family: sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      direction: rtl;
      margin: 0;
    }
    .card {
      background: #ffffff;
      border: 2px solid #c8e6c9;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    .card h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .card p {
      font-size: 18px;
    }
    a{
        display: inline-block;
  margin-top: 20px;
  padding: 10px 24px;
  background-color: #2e7d32;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-size: 16px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>🎉 پرداخت با موفقیت انجام شد!</h1>
    <p>سفارش شما ثبت شد و در حال پردازش است.</p>
    <a href="{{ route('Home.index') }}">بازگشت به صفحه اصلی</a>
  </div>

</body>
</html>
