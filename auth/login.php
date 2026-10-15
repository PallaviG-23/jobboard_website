<?php include('../config/config.php');?>
<?php include('../partials/header.php');?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Log In</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
      
          <div class="col-md-12">
            <form id="loginForm">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email address" name="email" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="password">Password</label>
                  <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn px-4 btn-primary text-white">Log In</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>

<script>
  

  // Wrap the code in a listener that waits for the HTML layout to be fully ready
document.addEventListener("DOMContentLoaded", function() {
    
    // Double check that your HTML form has exactly id="loginForm"
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Stops the page reload handbrake

            const formData = new FormData(this);

            fetch('process-login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert(data.message);
                    window.location.href = '../index.php'; // Adjust path if needed
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Check your F12 Console.');
            });
        });
    } else {
        // This will print directly in your F12 Console if your HTML id is misspelled!
        console.error("CRITICAL: JavaScript could not find an HTML form with id='loginForm'. Please check your HTML form tag.");
    }
});
</script>

<?php include('../partials/footer.php');?>

