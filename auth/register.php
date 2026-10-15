<?php include('../config/config.php');?>
<?php include('../partials/header.php');?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');"
      id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Register</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Register</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5">
            <form id="`registerForm`">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="username">Username</label>
                  <input type="text" id="username" class="form-control" placeholder="Username" name="username">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="email">Email</label>
                  <input type="text" id="email" class="form-control" placeholder="Email address" name="email">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="usertype">Select User Type</label>
                  <select id="usertype" name="usertype" class="selectpicker form-control" data-width="100%" data-live-search="true" title="Select User Type">
                    <option value="Worker">Worker</option>
                    <option value="Company">Company</option>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="password">Password</label>
                  <input type="password" id="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="repassword">Re-Type Password</label>
                  <input type="password" id="repassword" class="form-control" placeholder="Re-type Password" name="repassword">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn px-4 btn-primary text-white">Sign-Up</button>
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

<script>
  //Define APPURL variable for javascript use
  const APPURL = "<?php echo APPURL; ?>";
  

document.getElementById('`registerForm`').addEventListener('submit', function(event) {
    // 1. Prevent the page from reloading automatically
    event.preventDefault(); 

    // 2. Automatically grab all the input data from the form
    const formData = new FormData(this);

    // 3. Send the data to our PHP processor in the background
    fetch('process-register.php', {
    method: 'POST',
    body: formData
  })
  
  .then(response => response.json()) // 4. Convert the response from PHP into a JavaScript object
    .then(data => {
        // 5. Handle the response data
        if(data.status === 'success') {
            alert(data.message); // Show success alert
            window.location.href = APPURL + '/auth/login.php'; // Redirect user
        } else {
            alert(data.message); // Show error alert (e.g., duplicate email, empty fields)
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
});



</script>

<?php include('../partials/footer.php');?>