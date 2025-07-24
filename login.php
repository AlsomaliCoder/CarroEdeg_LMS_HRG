<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login – Carro Edeg</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    :root {
      --main‐green: rgb(200, 230, 201);
      /* Complementary = 255 − main */
      --comp‐dark: rgb(36, 82, 70);
      /* Slightly darker version of main green for inputs/hover */
      --input‐green: rgb(168, 206, 178);
    }

    * {
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(
        135deg,
        var(--main‐green),
        var(--comp‐dark)
      );
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .login-container {
      position: relative;
      display: flex;
      width: 1000px;
      height: 600px;
      background: #ffffff;
      border-radius: 40px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      animation: fadeInContainer 1s ease forwards;
      z-index: 1;
    }

    /* Lightning‐style animated glow border */
    .login-container::before {
      content: "";
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      border-radius: 42px;
      background: linear-gradient(
        270deg,
        var(--main‐green),
        var(--comp‐dark),
        var(--main‐green)
      );
      background-size: 600% 600%;
      z-index: -1;
      filter: blur(8px);
      animation: lightningBorder 6s ease infinite;
    }

    @keyframes lightningBorder {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    /* Left (illustration) section */
    .left-section {
      flex: 1;
      background: #f8fef9;
      padding: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: slideInLeft 1.2s ease forwards;
    }

    .left-section img {
      max-width: 80%;
      height: auto;
      border-radius: 20px;
      animation: fadeInImage 1.8s ease forwards;
    }

    /* Right (form) section = complementary dark background */
    .right-section {
      flex: 1;
      background: var(--comp‐dark);
      color: #ffffff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px;
      animation: slideInRight 1.2s ease forwards;
    }

    .right-section h2 {
      font-size: 32px;
      margin-bottom: 20px;
      animation: fadeInUp 1.2s ease forwards;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
      animation: fadeInUp 1.4s ease forwards;
    }

    .form-group input {
      width: 100%;
      padding: 15px 20px 15px 45px; /* left padding for icon */
      border: none;
      border-radius: 30px;
      font-size: 16px;
      background: var(--input‐green);
      color: #1a1a1a;
    }

    .form-group input::placeholder {
      color: #555555;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      left: 18px;
      transform: translateY(-50%);
      color: #555555;
      font-size: 16px;
    }

    .btn-login {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 30px;
      font-size: 18px;
      font-weight: bold;
      background: var(--main‐green);
      color: var(--comp‐dark);
      cursor: pointer;
      margin-top: 10px;
      animation: fadeInUp 1.6s ease forwards;
      transition: background 0.3s ease, transform 0.3s ease,
        box-shadow 0.3s ease;
    }

    .btn-login:hover {
      background: var(--input‐green);
      transform: scale(1.03);
      box-shadow: 0 5px 20px rgba(168, 206, 178, 0.4);
    }

    .right-section a {
      color: #a8d3bd;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .right-section a:hover {
      color: #cef1d3;
      text-decoration: underline;
    }

    .extra-links {
      margin-top: 20px;
      font-size: 14px;
      animation: fadeInUp 1.8s ease forwards;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      left: 40px;
      font-size: 12px;
      color: #bbbbbb;
      animation: fadeInUp 2s ease forwards;
    }

    .footer a {
      color: #cef1d3;
    }

    /* =============================================
       KEYFRAME ANIMATIONS
       –––––––––––––––––––––––––––––––––––––––––––––– */
    @keyframes fadeInContainer {
      0% {
        opacity: 0;
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes slideInLeft {
      0% {
        transform: translateX(-100px);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideInRight {
      0% {
        transform: translateX(100px);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes fadeInUp {
      0% {
        transform: translateY(30px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes fadeInImage {
      0% {
        transform: scale(0.8);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
      .login-container {
        flex-direction: column;
        width: 90%;
        height: auto;
        border-radius: 20px;
      }

      .left-section,
      .right-section {
        flex: none;
        width: 100%;
        padding: 20px;
      }

      .footer {
        position: static;
        margin-top: 20px;
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="left-section">
      <!-- Replace with your actual image path -->
      <img src="assets/img/carro-edeg-logo.png" alt="Login Illustration" />
    </div>

    <div class="right-section">
      <h2>Login</h2>
      <form action="functions/login.php" method="post">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Enter your username" required />
        </div>
        <div class="form-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Enter your password" required />
        </div>
        <button type="submit" class="btn-login">Login</button>
      </form>

      <div class="extra-links">
        
      </div>
    </div>

    <div class="footer">
      &copy; 2025 Carro Edeg Laundry<br />
      Have a problem? Contact us at
      <a href="mailto:support@carroedeg.com">support@carroedeg.com</a>
    </div>
  </div>
</body>

</html>
