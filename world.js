document.addEventListener('DOMContentLoaded', function() {
    // Assign the lookup button to a variable
    const lookupBtn = document.getElementById('lookup');
  
    // Function to fetch data from world.php
    lookupBtn.addEventListener('click', function() {
        // Create a new XMLHttpRequest
        var httpRequest = new XMLHttpRequest();
    
        // Get the value from a country input field if it exists
        var countryInput = document.getElementById('country');
        var country = countryInput ? encodeURIComponent(countryInput.value) : '';
    
        // Define what happens on successful data submission
        httpRequest.onreadystatechange = function() {
          // Check if the request is complete and was successful
          if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
              // Print the data into the div with id 'result'
              document.getElementById('result').innerHTML = httpRequest.responseText;
            } else {
              // Handle errors here
              document.getElementById('result').innerHTML = 'There was a problem with the request.';
            }
          }
        };
    
        // Set up and make the AJAX request
        httpRequest.open('GET', 'http://localhost/info2180-lab5/world.php?country=' + country, true);
        httpRequest.send();
      });
  });
  