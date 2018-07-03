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
                    <div class="card" >
                        <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Book Reservation</h5>
                            {% for result in results %}
                            <h2>{{ result.name }}</h2>
                            <h2>{{ result.email }}</h2>
                            <h2>{{ result.date }}</h2>
                            <h2>{{ results.num_rooms }}</h2>
                            {% endfor %}
                        </div>
                    </div>

        </div>
        <!-- /.countdown-->
    </div>
    {% endblock %}