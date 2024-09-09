<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOT FOUND</title>
</head>
<style>
/* Style the container for a centered and spacious layout */
.container {
  display: flex; /* Allow horizontal centering */
  justify-content: center; /* Center the content horizontally */
  align-items: center; /* Center the content vertically */
  min-height: 100vh; /* Set minimum height to fill viewport */
  background-color: #f0f0f0; /* Light gray background */
  padding: 50px; /* Add some padding */
}

/* Style the text elements for a clean and readable look */
h1 {
  font-size: 2.5rem; /* Adjust font size */
  font-weight: bold; /* Bold text */
  margin-bottom: 20px; /* Add bottom margin */
  color: #333; /* Dark gray text */
}

p {
  font-size: 1rem; /* Adjust font size */
  line-height: 1.5; /* Set line spacing */
  color: #666; /* Lighter gray text */
  margin-bottom: 15px; /* Add bottom margin */
}

/* Style the unordered list for a sleek and modern look */
ul {
  list-style: none; /* Remove default bullet points */
  padding: 0; /* Remove default padding */
  margin: 0; /* Remove default margin */
}

li {
  display: inline-block; /* Display list items side-by-side */
  margin-right: 20px; /* Add right margin between items */
}

a {
  color: #333; /* Dark gray text for links */
  text-decoration: none; /* Remove underline from links */
  font-weight: bold; /* Bold text for links */
}

a:hover { /* Style on hover for links */
  color: #007bff; /* Blue on hover */
  text-decoration: underline; /* Add underline on hover */
}

/* Style the image for a touch of personality */
img {
  width: 50%; /* Adjust image width */
  height: auto; /* Maintain aspect ratio */
  margin-top: 30px; /* Add top margin after text */
}

</style>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Oops! We can't seem to find the page you're looking for.</h1>

      <?php
      // Check if the requested URL exists (optional for more specific messages)
      $requestedUrl = $_SERVER['REQUEST_URI'];
      if (file_exists($_SERVER['DOCUMENT_ROOT'] . $requestedUrl)) {
          echo '<p>The content you requested may be temporarily unavailable.</p>';
      } else {
          echo '<p>The page you requested may have moved or no longer exist.</p>';
      }
      ?>

      <p>Here are some helpful suggestions to get you back on track:</p>
      <ul>
        <li><a href="/">Go to the homepage</a></li>
        <li><a href="#">Search our website</a></li>
        <li><a href="#">Contact us</a> (if appropriate)
      </ul>

      <img src="<?php echo url('public/assets/404.jpg'); ?>" alt="404 Page Not Found" />
    </div>
  </div>
</div>


<body>
    
</body>
</html>


