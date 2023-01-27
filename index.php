<?php
include('components/session_user.php');
include('server/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include("components/links.php") ?>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/media.css">
    <title>shopi</title>
    <link rel="icon" href="IMAGES/comp/favicon.ico" type="image/x-icon" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    .card-img-top:hover {
        transform: scale(1.04);
        transition: 100ms;
    }
</style>
<body id="page-top">
    <!-- <div class="row mt-4" style="height:100px;background-color:darkorange">
 <marquee behavior="" direction=""><h2 style="color:red ;margin:auto">LATESTEST ARRIVALS</h2></marquee>
 <marquee behavior="rotate" direction=""><h2 style="color:red ;margin:auto;float:left">LATESTEST ARRIVALS</h2></marquee> -->
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <?php include("components/sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('components/top_bar.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <script>
                        $(document).ready(function() {
                            var message = <?php echo $message ?>
                            if (message == "") {

                            } else {
                                alert(message);
                            }
                        })
                    </script>
                    <div class="row">
                        <div class="col-lg-12 sm-12 px-auto py-2 mx-auto" style="background-color:green ;">
                           <!--  <div id="carouselId" class="carousel slide mx-auto" data-ride="carousel" style="width: 100%;">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselId" data-slide-to="1"></li>
                                    <li data-target="#carouselId" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox" style="background-color:white ;">
                                    <div class="carousel-item active">
                                        <center><img src="IMAGES/furniture/Bed2.webp" alt="First slide" style="width:60%;height:60vh"></center>
                                    </div>
                                    <div class="carousel-item">
                                        <center><img src="IMAGES/furniture/Wooden Chair.webp" alt="Second slide" style="width:60%;height:60vh"></center>
                                    </div>
                                    <div class="carousel-item">
                                        <center><img src="IMAGES/furniture/MDF Table.webp" alt="Third slide" style="width:60%;height:60vh"></center>
                                    </div>
                                    <div class="carousel-item">
                                        <center><img src="IMAGES/furniture/Electric Kettle Red Cherry.jpg" alt="Fourth slide" style="width:70%;height:60vh"></center>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-green" aria-hidden="true"> </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div> -->
                            <h5 class="my-2 py-1 p-2" style="background-color:orange;color:white;font-weight:700 ;">AVAILABLE PRODUCTS</h5>
                            <?php
                            $sql = "SELECT * FROM products LIMIT 12";
                            $result = mysqli_query($conn, $sql); ?>
                            <div class="row d-flex justify-content-start mt-2">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-8 col-6 mb-2  mr-0">
                                        <div class="card">
                                            <center> <a href="single.php?name=<?php echo $row['Name'] ?>"><img class="card-img-top mt-2" src="IMAGES/furniture/<?php echo $row['File'] ?>" alt="" style="width:70%;height:100px"></a></center>
                                            <div class="card-body">
                                                <a href="single.php?name=<?php echo $row['Name'] ?>" style="text-decoration:none ;">
                                                    <h4 class="card-title" style="color:black;font-size: 14px;"><?php echo $row['Name'] ?></h4>
                                                </a>
                                                <div class="row">
                                                    <div class="col-lg-11 sm-12">
                                                        <p class="card-text" style="color:black;" ><span style="color:black;font-weight:900;font-family:cursive;font: size px;">Ksh:</span>Ksh <?php echo $row['Price'] ?></p>
                                                    </div>
                                                </div>
                                                <form action="components/add_to_cart.php" method="post">
                                                    <input type="text" name="product_id" id="product_id<?php echo $row['Id'] ?>" value="<?php echo $row['Id'] ?>" hidden>
                                                    <input type="text" name="product_name" id="product_name<?php echo $row['Id'] ?>" value="<?php echo $row['Name'] ?>" hidden>
                                                    <input type="text" name="user_id" id="user_id<?php echo $row['Id'] ?>" value="<?php echo $_SESSION['Id'] ?>" hidden>
                                                    <input type="text" name="product_price" id="product_price<?php echo $row['Id'] ?>" value="<?php echo $row['Price'] ?>" hidden>
                                                    <button type="button" class="btn btn d-block mx-auto" id="test<?php echo $row['Id'] ?>" style="font-size:14px;background-color:DarkOrange;color:black">Add to Cart</button>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#test<?php echo $row['Id'] ?>").click(function() {
                                                                var product_id = $("#product_id<?php echo $row['Id'] ?>").val();

                                                                var product_name = $("#product_name<?php echo $row['Id'] ?>").val();
                                                                // alert(product_name);
                                                                var user_id = $("#user_id<?php echo $row['Id'] ?>").val();
                                                                // alert(user_id);
                                                                var product_price = $("#product_price<?php echo $row['Id'] ?>").val();
                                                                // alert(product_price);

                                                                $.ajax({
                                                                    url: 'components/add_to_cart.php',
                                                                    method: 'post',
                                                                    dataType: 'JSON',
                                                                    data: {
                                                                        product_id: product_id,
                                                                        product_name: product_name,
                                                                        user_id: user_id,
                                                                        product_price: product_price
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                        console.log(response.Number);
                                                                        var Number = response.Number;
                                                                        $("#returned_value").html(Number);
                                                                        alert(response.Message);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <footer class="sticky-footer bg-white" >
                <div class="container my-auto">
                    <div class="copyright text-center my-auto" >
                        <span> 
                        </span><?php
                        $date=date("Y:m");
                        echo $date ." ";
                         ?> Copyright &copy; shopi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>