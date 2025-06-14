<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="hold-transition login-page dark-mode" style="background: #111; color: #fff;">
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
    backdrop-filter: brightness(0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    position: relative;
    z-index: 1;
    background: #111;
    color: #fff;
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
  }

  .login-title, .login-box {
    position: relative;
    z-index: 2;
  }

  .login-title {
    color: #fff;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 2rem;
    text-align: center;
    font-size: 2.2rem;
    text-shadow: 0 2px 16px #000;
  }

  .login-box {
    width: 100%;
    max-width: 400px;
  }

  .card-primary.card-outline {
    border-top: 4px solid #fff;
    border-radius: 1.2rem;
    background: rgba(20, 20, 20, 0.98);
    box-shadow: 0 8px 32px rgba(0,0,0,0.7);
    border: 1px solid #222;
  }

  .card-header img {
    border: 2px solid #fff;
    background-color: #222;
    padding: 5px;
    box-shadow: 0 2px 8px #000;
  }

  .card-header a {
    color: #fff;
    font-weight: 600;
    font-size: 1.4rem;
    text-decoration: none;
    letter-spacing: 1px;
    margin-top: 0.5rem;
    display: inline-block;
  }

  .login-box-msg {
    color: #bbb;
    font-style: italic;
    font-size: 1.05rem;
    margin-bottom: 1.5rem;
  }

  .form-control {
    border-radius: 40px;
    padding: 0.8rem 1.2rem;
    background-color: #181818;
    border: 1px solid #333;
    color: #fff;
    font-size: 1.05rem;
    transition: border 0.2s;
  }

  .form-control:focus {
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #222;
    background: #222;
    color: #fff;
  }

  .input-group-text {
    border-radius: 40px;
    background-color: #222;
    color: #fff;
    border: none;
    font-size: 1.1rem;
  }

  .btn-primary {
    background: linear-gradient(90deg, #fff 0%, #222 100%);
    color: #111;
    border: none;
    border-radius: 40px;
    padding: 0.7rem 0;
    font-weight: 700;
    font-size: 1.1rem;
    transition: background 0.2s, color 0.2s;
    box-shadow: 0 2px 8px #000;
  }

  .btn-primary:hover {
    background: #fff;
    color: #000;
  }

  /* Modern input group spacing */
  .input-group {
    margin-bottom: 1.3rem;
  }
</style>

<h2 class="login-title">🐾 <?php echo $_settings->info('name') ?></h2>

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="../uploads/logo-1746087088.png" alt="Pet Logo" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover;">
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
        "value": 40,
        "density": {
          "enable": true,
          "value_area": 900
        }
      },
      "shape": {
        "type": "circle",
      },
      "color": {
        "value": "#fff"
      },
      "opacity": {
        "value": 0.15
      },
      "size": {
        "value": 8,
        "random": true
      },
      "move": {
        "enable": true,
        "speed": 1.2,
        "out_mode": "bounce",
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
          "distance": 120
        },
        "push": {
          "particles_nb": 2
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
