<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="hold-transition login-page dark-mode">
<script>start_loader()</script>

<!-- 🌟 Particle Container -->
<div id="particles-js"></div>

<style>
  #particles-js {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
    background: transparent;
  }

  body {
    /* background-image: url("<?php //echo validate_image($_settings->info('cover')) ?>"); */
    /* background-size: cover;
    background-position: center;
    background-repeat: no-repeat; */
    backdrop-filter: brightness(0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    position: relative;
    z-index: 1;
  }

  .login-title, .login-box {
    position: relative;
    z-index: 2;
  }

  .login-title {
    color: #64b5f6;
    text-shadow: 2px 2px rgba(0, 0, 0, 0.6);
    margin-bottom: 2rem;
    text-align: center;
  }

  .login-box {
    width: 100%;
    max-width: 400px;
  }

  .card-primary.card-outline {
    border-top: 5px solid #42a5f5;
    border-radius: 1rem;
    background: rgba(0, 0, 50, 0.85);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
  }

  .card-header img {
    border: 3px solid #90caf9;
    background-color: #fff;
    padding: 5px;
  }

  .card-header a {
    color: #90caf9;
    font-weight: bold;
    font-size: 1.5rem;
    text-decoration: none;
  }

  .login-box-msg {
    color: #bbdefb;
    font-style: italic;
  }

  .form-control {
    border-radius: 50px;
    padding: 0.75rem 1rem;
    background-color: #e3f2fd;
    border: none;
    color: #0d47a1;
  }

  .form-control:focus {
    border: 2px solid #64b5f6;
    box-shadow: none;
  }

  .input-group-text {
    border-radius: 50px;
    background-color: #42a5f5;
    color: white;
    border: none;
  }

  .btn-primary {
    /* background-color: #2196f3; */
    border: none;
    border-radius: 50px;
    padding: 0.6rem;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #1e88e5;
  }
</style>

<h2 class="login-title">🐾 <?php echo $_settings->info('name') ?></h2>

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="../uploads/logo-1746087088.png" alt="Pet Logo" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
      <a href="./" class="d-block mt-2">Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to continue your pet adventure 🐾</p>

      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block">Login 🐕</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<!-- Particles.js Library -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<!-- Particles Config -->
<script>
  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 50,
        "density": {
          "enable": true,
          "value_area": 1000
        }
      },
      "shape": {
        "type": "image",
        "image": {
          "src": "../uploads/logo-1746087088.png", // <-- Make sure this file exists
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.6
      },
      "size": {
        "value": 30,
        "random": true
      },
      "move": {
        "enable": true,
        "speed": 1.0,
        "out_mode": "inside",
        "bounce": true,
      }
    },
    "interactivity": {
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        }
      },
      "modes": {
        "repulse": {
          "distance": 100
        },
        "push": {
          "particles_nb": 3
        }
      }
    },
    "retina_detect": true
  });
</script>

<script>
  $(document).ready(function () {
    end_loader();
  });
</script>
</body>
</html>
