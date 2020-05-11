<?php
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
    header('location: login.php');
}
include 'inc/header.php';
?>
<link rel="stylesheet" href="../vendor/chart-js/Chart.min.css">
<script src="../vendor/chart-js/Chart.min.js"></script>

<?php include 'inc/nav.php'; ?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>Dashboard</h2>
            <!-- <p>You can order products from here</p> -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <canvas id="myChart" width="200" height="200"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <canvas id="myChart1" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
 var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });

</script>
<?php include 'inc/footer.php' ?>
