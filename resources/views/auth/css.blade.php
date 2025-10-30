  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MD Gaming | Login & Register</title>

  <link rel="icon" href="img/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1C1C1C;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
      margin: 0;
      padding: 0 10px;
    }

    .container {
      background-color: #000000;
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(156, 93, 217, 0.4);
      width: 400px;
      padding: 40px;
      text-align: center;
      transition: 0.4s;
    }

    .container:hover {
      box-shadow: 0 0 35px rgba(245, 183, 0, 0.5);
    }

    h2 {
      color: #F5B700;
      margin-bottom: 25px;
      font-weight: 700;
    }

    .form-control {
      width: 100%;
      padding: 12px 0px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background-color: #1C1C1C;
      color: #FFFFFF;
      outline: none;
      transition: 0.3s;
    }

    .form-control:focus {
      border: 2px solid #9C5DD9;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-primary {
      background-color: #5C2E91;
    }

    .btn-primary:hover {
      background-color: #9C5DD9;
    }

    .btn-outline {
      border: 2px solid #007C82;
      color: #007C82;
      background: transparent;
    }

    .btn-outline:hover {
      background-color: #007C82;
      color: #fff;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 20px 0;
      color: #888;
    }

    .divider::before, .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #333;
    }

    .divider:not(:empty)::before {
      margin-right: .75em;
    }

    .divider:not(:empty)::after {
      margin-left: .75em;
    }

    .google-btn {
      background-color: #FFFFFF;
      color: #000;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      cursor: pointer;
      font-weight: 500;
      transition: 0.3s;
    }

    .switch {
      margin-top: 15px;
      font-size: 14px;
    }

    .switch a {
      color: #F5B700;
      text-decoration: none;
      font-weight: 600;
    }


    .custom-input {             
      padding: 10px 20px; 
      font-size: 1rem;  
      color: #ffffff; 
      background-color: #212529; 
      
    }

    .custom-input::placeholder {
      color: #ffffff;
    }

    .custom-input:focus {
      background-color: #000000;
      color: #ffffff;
    }

    /* --- Tambahan khusus autofill Chrome --- */
    .custom-input:-webkit-autofill {
      -webkit-box-shadow: 0 0 0px 1000px #212529 inset !important;
      -webkit-text-fill-color: #ffffff !important; 
      transition: background-color 0s ease-in-out 0s;
    }

    .custom-input:-webkit-autofill:focus {
      -webkit-box-shadow: 0 0 0px 1000px #000000 inset !important; 
      -webkit-text-fill-color: #ffffff !important;
    }


    /* ---------------- Responsive Design ---------------- */
    @media (max-width: 480px) {
      body {
        height: auto;
        padding: 30px 15px;
        align-items: flex-start;
        padding-top: 160px;
      }

      .container {
        width: 100%;
        max-width: 350px;
        padding: 25px 20px;
      }

      h2 {
        font-size: 1.3rem;
      }

      .form-control {
        padding: 10px 0px;
        font-size: 14px;
      }

      .btn {
        padding: 10px;
        font-size: 15px;
      }

      .google-btn {
        padding: 9px;
        font-size: 14px;
      }

      .switch {
        font-size: 13px;
      }

      .divider {
        margin: 15px 0;
        font-size: 13px;
      }
      .custom-input {             
        padding: 10px 20px; 
      }
    }

    @media (max-width: 360px) {
      .container {
        max-width: 300px;
        padding: 20px 15px;
      }

      h2 {
        font-size: 1.1rem;
      }

      .btn,
      .form-control,
      .google-btn {
        font-size: 13px;
      }
      .custom-input {             
        padding: 10px 20px; 
      }
    }
  </style>