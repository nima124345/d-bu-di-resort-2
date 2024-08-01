<section id="slider-show">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 img-fluid" src="./img/slide/1.jpg" />
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 img-fluid" src="./img/slide/2.jpg" />
            </div>

            <div class="carousel-item">
                <img class="d-block w-100 img-fluid" src="./img/slide/3.jpg" />
            </div>

        </div>
    </div>
</section>

<script>
    // Add this script to enable auto-rotation
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.getElementById('carouselExampleIndicators');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Set the interval time in milliseconds (e.g., 2000ms or 2 seconds)
            pause: 'hover', // Pause on mouseover
            wrap: true // Enable looping
        });
    });
</script>