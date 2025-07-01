<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #f8f9fc;
            font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
        }

        .torn-paper {
            background: linear-gradient(135deg, #e74a3b 0%, #f6c23e 100%);
            position: relative;
            padding: 60px 30px 40px 30px;
            border-radius: 1.5rem 1.5rem 0 0;
            box-shadow: 0 8px 32px rgba(34, 74, 190, 0.10);
            max-width: 480px;
            margin: 60px auto 0 auto;
            text-align: center;
            color: #fff;
            overflow: hidden;
        }

        .torn-paper:after {
            content: "";
            display: block;
            position: absolute;
            left: 0;
            right: 0;
            bottom: -30px;
            height: 40px;
            background: url('data:image/svg+xml;utf8,<svg width="100%" height="40" xmlns="http://www.w3.org/2000/svg"><path d="M0,20 Q60,40 120,20 T240,20 T360,20 T480,20 V40 H0 Z" fill="white" /></svg>') repeat-x;
            background-size: 480px 40px;
        }

        .error-icon {
            font-size: 4.5rem;
            margin-bottom: 1.2rem;
            color: #fff;
            text-shadow: 0 2px 8px #e74a3b55;
            animation: shake 1.5s infinite;
        }

        @keyframes shake {
            0%, 100% {
                transform: rotate(-5deg);
            }
            20%, 80% {
                transform: rotate(5deg);
            }
            40%, 60% {
                transform: rotate(-3deg);
            }
            50% {
                transform: rotate(3deg);
            }
        }

        .error-title {
            font-size: 3.2rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            letter-spacing: 2px;
            text-shadow: 2px 2px 0 #fff, 4px 4px 10px #e74a3b33;
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #fff;
            text-shadow: 0 1px 4px #e74a3b33;
        }

        .btn-home {
            background: #fff;
            color: #e74a3b;
            border: none;
            padding: 0.8rem 2.2rem;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.3s, color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 8px rgba(231, 74, 59, 0.10);
            display: inline-block;
        }

        .btn-home:hover {
            background: #f6c23e;
            color: #fff;
            box-shadow: 0 4px 16px rgba(246, 194, 62, 0.13);
        }

        @media (max-width: 600px) {
            .torn-paper {
                padding: 30px 5vw 30px 5vw;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-icon {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
<div class="torn-paper">
    <div class="error-icon">
        <i class="fas fa-file-circle-xmark"></i>
    </div>
    <div class="error-title">404</div>
    <div class="error-message">
        Sorry, the page you are looking for could not be found.<br>
        <span style="font-size:1.7rem;display:inline-block;margin-top:10px;">🧩</span>
    </div>
    <a href="{{ url('/') }}" class="btn-home">
        <i class="fas fa-home"></i> Back to Home
    </a>
</div>
</body>
</html>
