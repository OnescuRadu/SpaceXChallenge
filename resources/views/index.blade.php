<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQuery Minified -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/ffbf81b659.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <title>SpaceX Rocket</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}"/>
</head>
<style>
   
</style>

<body>
    <h1 class="main-title">SpaceX - ROCKETS</h1>
    <div class="container">

        <input class="form-control mx-auto" type="text" id="searchInput" placeholder="Search for rockets..">
        <div id="rockets"></div> 
    </div>
</body>
<script>
    //jQuery function that waits for the document to load before executing the code
    $(function() {

        //display all rockets when the documents load
        displayRockets("/api/rockets");

        //Function that clears the rocket container and calls another function to display new rockets based on given request
        function displayRockets(request) {
            clearRockets();
            getRockets(request);
        }

        //Function that clears all the rockets from the rockets container
        function clearRockets() {
            jQuery('#rockets').empty();
        }

        //Append all the rockets to the rockets container
        function appendRockets(rockets) {
            rockets.forEach(function(element) {
                $("#rockets").append(`
    <br>
    <a href="/rockets/${element.rocket_id}">
    <div class="card mx-auto">
        <div class="row no-gutters">
            <div class="col-auto my-auto">
                <img src="${element.flickr_images[0]}" class="rocket-image img-responsive rounded-circle" alt="rocket_image">
            </div>
            <div class="col my-auto rocket-text-col">
                <div class="card-block px-2 ">
                    <h4 class="card-title main-text">${element.rocket_name}</h4>
                    <p class="card-text additional-text">Country: ${element.country}</p>                
                </div>
            </div>
        </div>
    </div>
    </a>
        
                `);
            });
        }

        //Function that gets all the rockets based on the given request and calls another function to append them
        function getRockets(request) {
            $.get(request)
                .done(function(data) {
                    appendRockets(data);
                })
                .fail(function() {
                    alert("error");
                });
        }

        // Get the input box
        let textInput = document.getElementById('searchInput');

        // Initialize a timeout variable
        let timeout = null;

        // Listen for keystroke events
        textInput.onkeyup = function(e) {
            // Clear the timeout if it has already been set.
            // This will prevent the previous task from executing
            // if it has been less than <MILLISECONDS>
            clearTimeout(timeout);

            // Make a new timeout of 750 ms
            timeout = setTimeout(function() {
                //if there is only one character inside the input display all rockets
                if ($("#searchInput").val().length < 2) {
                    displayRockets("/api/rockets");
                }
                //if there is more than one character inside the input display the rockets based on the given query
                else {
                    displayRockets(`/api/rockets/search/${ $("#searchInput").val() }`);
                }
            }, 750);
        };

    })
</script>

</html>