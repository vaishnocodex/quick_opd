<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .thank-you-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 450px;
        }

        .thank-you-box h1 {
            font-size: 36px;
            color: #28a745;
            margin-bottom: 10px;
        }

        .thank-you-box p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }

        .thank-you-box .btn {
            display: inline-block;
            margin-top: 20px;
            background: #28a745;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .thank-you-box .btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <div class="thank-you-box">
        <h1>🎉 Thank You!</h1>
        <p>Your appointment has been booked successfully.</p>
        <p>We’ll contact you shortly with further details.</p>
        <a href="{{ url('/') }}" class="btn">Go to Home</a>
    </div>

</body>
</html>
