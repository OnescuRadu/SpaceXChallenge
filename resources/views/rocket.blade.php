<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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


<div id="rocket">
<a href="{{ url('') }}" class="rocket-back"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
<div class="container text-center">
        <div class="row">
            <div class="col mx-auto">
                <img src="" class="img-responsive" id="rocket-img" alt="rocket_image">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 id="rocket-name">
                    Name
                </h5>
                <hr>
                <p class="rocket-text-info" id="description">
                    Description
                </p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Type</label>
                        </div>
                        <div class="col-md-6 rocket-text-info">
                            <p id="rocket-type"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Cost per Launch</label>
                        </div>
                        <div class="col-md-6 rocket-text-info">
                            <p id="cost-per-launch"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Active</label>
                        </div>
                        <div class="col-md-6 rocket-text-info">
                            <p id="active"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Flight</label>
                        </div>
                        <div class="col-md-6 rocket-text-info">
                            <p id="first-flight"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Country</label>
                        </div>
                        <div class="col-md-6 rocket-text-info">
                            <p id="country"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>


</body>
<script>
    //jQuery function that waits for the document to load before executing the code
    $(function() {
        //retrieving the rocket id from the url
        let rocketId = window.location.href.split('/').pop();

        //retrieving the data from the php api
        $.get(`/api/rockets/${rocketId}`)
            .done(function(data) {
                //Inserting all the data into the right element
                document.getElementById('rocket-name').innerHTML = data.rocket_name
                document.getElementById('rocket-type').innerHTML = data.rocket_type.toUpperCase();
                document.getElementById('description').innerHTML = data.description
                document.getElementById('cost-per-launch').innerHTML = data.cost_per_launch + " $"
                if(data.active == true)
                    document.getElementById('active').innerHTML = 'Yes'
                else 
                    document.getElementById('active').innerHTML = 'No'
                document.getElementById('country').innerHTML = data.country
                document.getElementById('first-flight').innerHTML = data.first_flight
                document.getElementById('rocket-img').src = data.flickr_images[0]

            })
            .fail(function() {
                alert("There has been a problem retrieving the information.");
            });

    })
</script>

</html>