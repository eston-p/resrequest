{% include 'templates/default.php' %}
{% block content  %}
<body>
<div style="background-image: url('img/beach.jpg')" class="main">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="sub"><a href="/">Make a reservation</a> </h6>
                <h6 class="sub"><a href="/search">Search for a reservation</a> </h6>
            </div>
        </div>

        <!-- countdown-->
        <div id="countdown" class="countdown">
            <div class="row">
                <form action="/results" method="post">
                    <div class="countdown-item col-sm-8 col-xs-6">
                        <div>Name</div>
                        <input type="text" placeholder="enter name" name="search"  class="form-control transparent">
                    </div>
                    <div class="countdown-item col-sm-3 col-xs-6">
                        <button class="btn btn-danger">Search</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.countdown-->
    </div>
    {% endblock %}