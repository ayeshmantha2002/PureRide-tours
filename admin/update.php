<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>App Update</title>
  <style>
    :root {
      --shadow: #00000030;
      --dark-shadow: #00000080;
    }

    body {
      width: 100%;
      height: 100vh;
      font-family: Arial, sans-serif;
      background: #fff;
      color: #000;
      text-align: center;
      padding: 50px;
      margin: 0;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      box-sizing: border-box;
      transition: box-shadow 0.3s;
    }

    .container:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
    }

    .logo {
      max-width: 100px;
      margin: 0 auto 20px;
      border-radius: 50%;
      box-shadow: 0 10px 10px var(--shadow);
    }

    h1 {
      font-size: 2.5em;
      margin-bottom: 10px;
      color: #ad8d3b;
    }

    .company-name {
      font-size: 1.5em;
      margin-bottom: 30px;
      color: #000;
    }

    p {
      font-size: 1.2em;
      margin-bottom: 30px;
      color: #000;
    }

    .btn {
      display: inline-block;
      padding: 15px 30px;
      font-size: 1.2em;
      color: #fff;
      background-color: #ad8d3b;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn:hover {
      background-color: #000;
      color: #fff;
    }

    @media (max-width: 768px) {
      body {
        padding: 20px;
      }

      .container {
        padding: 20px;
      }

      h1 {
        font-size: 2em;
      }

      .company-name {
        font-size: 1.2em;
      }

      p {
        font-size: 1em;
      }

      .btn {
        padding: 10px 20px;
        font-size: 1em;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 1.5em;
      }

      p {
        font-size: 0.9em;
      }

      .btn {
        padding: 8px 15px;
        font-size: 0.9em;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <img src="../assect/img/Pueride Tours Logo.png" alt="Company Logo" class="logo" />
    <div class="company-name">PureRide Tours</div>
    <h1>New Update Available</h1>
    <p>Update your app to enjoy the latest features and improvements.</p>
    <a href="pureRide_tours [1.1v].apk" class="btn" download>Download Now</a>
  </div>
</body>

</html>