<!DOCTYPE html>
<html>
<head>
    <title>Book Management</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        h3 {
            margin-bottom: 15px;
            font-size: 2rem;
            color: #4a4a4a;
            font-weight: 600;
        }
        p {
            font-size: 1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 25px;
        }
        .footer {
            font-size: 0.9rem;
            color: #999;
            margin-top: 30px;
        }
        .decorative-bar {
            height: 5px;
            width: 80px;
            background: linear-gradient(90deg, #6e8efb, #a777e3);
            margin: 0 auto 15px;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(90deg, #6e8efb, #a777e3);
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="decorative-bar"></div>
        <h3>{{ $data['name'] }}</h3>
        <p>{{ $data['body'] }}</p>
        <a href="#" class="btn">Learn More</a>
        <div class="footer">© 2025 Book Management, All Rights Reserved.</div>
    </div>
</body>
</html>
