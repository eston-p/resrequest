{% include 'templates/default.php' %}
{% block content  %}
<div style="background-image: url('img/beach.jpg')" class="main">
    <div class="overlay"></div>
    <div class="container">
        <p class="social"><a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="gplus"><i class="fa fa-google-plus"></i></a><a href="#" title="" class="instagram"><i class="fa fa-instagram"></i></a></p>
        <div class="row">
            <div class="col-sm-12">
                <h6 class="sub"><a href="/">Make a reservation</a> </h6>
                <h6 class="sub"><a href="/search">Search for a reservation</a> </h6>
            </div>
        </div>

<!-- countdown-->
<div id="countdown" class="countdown">
    <div class="row">
        <form action="/reservation" method="post">
        <div class="countdown-item col-sm-3 col-xs-6">
            <div>Name</div>
            <input type="text" placeholder="jane.doe@example.com" name="name"  class="form-control transparent">
        </div>
        <div class="countdown-item col-sm-3 col-xs-6">
            <div>Date</div>
            <input type="date" placeholder="jane.doe@example.com" name="date"  class="form-control transparent">
        </div>
        <div class="countdown-item col-sm-3 col-xs-6">
            <div>Number of rooms</div>
            <input type="number" placeholder="jane.doe@example.com" name="num_Rooms"  class="form-control transparent">
        </div>
        <div class="countdown-item col-sm-3 col-xs-6">
            <div>Email address</div>
            <input type="text" placeholder="jane.doe@example.com" name="email"  class="form-control transparent">
        </div>
            <div class="countdown-item col-sm-3 col-xs-6">
                <button class="btn btn-danger">subscribe</button>
            </div>

        </form>
    </div>
</div>
<!-- /.countdown-->
</div>
{% endblock %}