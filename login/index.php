<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HRDD Sales And Inventory</title>
  <link rel="shortcut icon" href="../stockclerk/assets/img/images-harah/logos.png" type="image/x-icon">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- reCAPTCHA Script -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <style>
    body {
      background: url('../stockclerk/assets/img/images-harah/bg-harah.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      width: 100%;
      max-width: 800px;
      border-radius: 15px;
      background-color: #333;  /* Set black-gray background */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-body {
      padding: 30px;
    }

    .text-center h1 {
      color: #fff;
      margin-bottom: 20px;
    }

    .form-control-user {
      border-radius: 20px;
      padding: 15px;
      margin-bottom: 10px;
    }

    .btn-user {
      border-radius: 20px;
      padding: 10px;
      font-size: 18px;
    }

    .custom-control-label {
      font-size: 14px;
      color: #fff;
    }

    .card-header {
      background-color: transparent;
      border-bottom: none;
      padding-bottom: 0;
    }

    /* Error styling for the username field */
    .error-message {
      color: red;
      font-size: 14px;
    }

    /* Password indicator styles */
    .password-indicator {
      height: 5px;
      width: 100%;
      border-radius: 5px;
      margin-top: 5px;
      background-color: #ccc;
    }

    .password-indicator.correct {
      background-color: green;
    }

    .password-indicator.incorrect {
      background-color: red;
    }

    /* Floating Chatbot Button */
    .chatbot-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
    }

    .chatbot-button {
      background-color: #007bff;
      color: #fff;
      border-radius: 50%;
      padding: 15px;
      font-size: 18px;
      border: none;
      cursor: pointer;
    }

    .chatbox {
      display: none;
      position: fixed;
      bottom: 70px;
      right: 20px;
      width: 300px;
      max-height: 400px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      background-color: #fff;
      border: 1px solid #ddd;
      font-family: 'Arial', sans-serif;
    }

    .chatbox-header {
      background-color: #007bff;
      color: white;
      padding: 10px;
      border-radius: 8px 8px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .close-chat {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }

    .chatbox-content {
      padding: 10px;
      height: 250px;
      overflow-y: auto;
    }

    .chatbox-footer {
      display: flex;
      padding: 10px;
      background-color: #f1f1f1;
      border-radius: 0 0 8px 8px;
    }

    .chatbox-footer input {
      width: 100%;
      padding: 8px;
      border-radius: 20px;
      border: 1px solid #ddd;
    }

    .send-chat {
      background-color: #007bff;
      color: white;
      border-radius: 20px;
      border: none;
      padding: 8px;
      margin-left: 10px;
      cursor: pointer;
    }

    .send-chat:hover {
      background-color: #0056b3;
    }

  </style>

</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row shadow">
              <div class="col--132">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to Harah Rubina Del Dios Sales and Inventory!</h1>
                  </div>

                  <form class="user" role="form" action="processlogin.php" method="post">
                    <div class="form-group">
                      <input class="form-control form-control-user" placeholder="Username" name="user" type="text" id="username" autofocus required>
                      <span id="usernameError" class="error-message" style="display:none;">Only letters are allowed</span>
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user" placeholder="Password" name="password" type="password" id="password" required>
                      <div id="passwordIndicator" class="password-indicator"></div>
                      <span id="passwordError" class="error-message" style="display:none;">Your password value is 8 characters long</span>
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; gap: 8px; font-size: 19px; color: white; flex-direction: row;">
                      <label for="showPassword" style="cursor: pointer; font-weight: 500; margin-bottom: 0;">Show Password</label>
                      <input type="checkbox" id="showPassword" style="width: 20px; height: 20px; cursor: pointer;">
                    </div>

                    <!-- reCAPTCHA Widget -->
                    <div class="form-group">
                      <div class="g-recaptcha" data-sitekey="6LdlLtcqAAAAALXwfIUzThyTXolmZK4z8DubUEho"></div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-between">
                      <button class="btn btn-secondary btn-user w-50 me-2" type="button" id="clearFields">Clear Fields</button>
                      <button class="btn btn-primary btn-user w-50" type="submit" name="btnlogin">Login</button>
                    </div>
                    <hr>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Chatbot Floating Button -->
  <div id="chatbot" class="chatbot-container">
    <button id="chatbotButton" class="chatbot-button">
      Chat
    </button>
    <div id="chatbox" class="chatbox">
      <div class="chatbox-header">
        <span>Chat with us</span>
        <button id="closeChat" class="close-chat">X</button>
      </div>
      <div class="chatbox-content">
        <!-- Chat content will go here -->
      </div>
      <div class="chatbox-footer">
        <input type="text" id="chatInput" placeholder="Type a message" />
        <button id="sendChat" class="send-chat">Send</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.getElementById('showPassword').addEventListener('change', function () {
      let passwordField = document.getElementById('password');
      passwordField.type = this.checked ? 'text' : 'password';
    });

    document.getElementById('clearFields').addEventListener('click', function () {
      document.getElementById('username').value = '';
      document.getElementById('password').value = '';
      document.getElementById('usernameError').style.display = 'none'; // Hide error message
    });

    // Username input validation: only letters
    document.getElementById('username').addEventListener('input', function () {
      let usernameValue = this.value;
      let usernameError = document.getElementById('usernameError');
      let regex = /^[A-Za-z]+$/;

      if (!regex.test(usernameValue)) {
        usernameError.style.display = 'block';
      } else {
        usernameError.style.display = 'none';
      }
    });

    // Password strength indicator and validation
    document.getElementById('password').addEventListener('input', function () {
      let passwordValue = this.value;
      let passwordIndicator = document.getElementById('passwordIndicator');
      let passwordError = document.getElementById('passwordError');

      // Check password length: display error if less than 8 characters
      if (passwordValue.length >= 8) {
        passwordError.style.display = 'none';  // Hide error message
        passwordIndicator.classList.remove('incorrect');
        passwordIndicator.classList.add('correct');
      } else {
        passwordError.style.display = 'block';  // Show error message
        passwordIndicator.classList.remove('correct');
        passwordIndicator.classList.add('incorrect');
      }
    });

    // Open and Close the Chatbox
    document.getElementById("chatbotButton").addEventListener("click", function () {
      document.getElementById("chatbox").style.display = "block";
    });

    // Close the Chatbox when "X" is clicked
    document.getElementById("closeChat").addEventListener("click", function () {
      document.getElementById("chatbox").style.display = "none";
    });

    // Send a message when the "Send" button is clicked
    document.getElementById("sendChat").addEventListener("click", function () {
      var chatInput = document.getElementById("chatInput").value;
      if (chatInput.trim()) {
        var chatContent = document.querySelector(".chatbox-content");
        var newMessage = document.createElement("div");
        newMessage.textContent = "You: " + chatInput;
        chatContent.appendChild(newMessage);
        chatInput.value = ''; // Clear input field after sending

        // Scroll to the bottom of the chatbox
        chatContent.scrollTop = chatContent.scrollHeight;
      }
    });

  </script>

</body>

</html>
