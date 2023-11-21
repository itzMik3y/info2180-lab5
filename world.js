document.addEventListener('DOMContentLoaded', function() {
    // Assign the lookup button to a variable
    const lookupBtn = document.getElementById('lookup');
    const lookupCitiesBtn = document.getElementById('lookupCities'); // New button for cities
  
    function fetchData(url) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    document.getElementById('result').innerHTML = httpRequest.responseText;
                } else {
                    document.getElementById('result').innerHTML = 'There was a problem with the request.';
                }
            }
        };
        httpRequest.open('GET', url, true);
        httpRequest.send();
    }

    lookupBtn.addEventListener('click', function() {
        var country = document.getElementById('country') ? encodeURIComponent(document.getElementById('country').value) : '';
        fetchData('http://localhost/info2180-lab5/world.php?country=' + country);
    });

    lookupCitiesBtn.addEventListener('click', function() {
        var country = document.getElementById('country') ? encodeURIComponent(document.getElementById('country').value) : '';
        fetchData('http://localhost/info2180-lab5/world.php?country=' + country + '&lookup=cities');
    });
  });
  