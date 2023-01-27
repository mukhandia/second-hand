<!-- Topbar -->
<style>
        #result {
            color: #f26522;
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #cccccc;
            border-top: 0;
            background-color: #f2f2f2;
            color: black;
            width: 200px;
        }

        .result p:hover {
            background-color: antiquewhite;
        }
    </style>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar - Brand -->

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php" style="text-decoration:none ;">
        <div class="sidebar-brand-icon ">
            <img src="./logo2.jpg" alt="" style="width:40px;height:40px">
        </div>
        <div class="sidebar-brand-text mx-3" style="color:green;font-weight:900;font-family:cursive;text-decoration:none;font-size:12px">shopi admin</div>
    </a>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item my-auto">
            <!-- Topbar Search -->
            <form class="search-box d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="backend_search.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" id="psearch" name="name" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" style="background-color:green ;">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    <!-- <div class="result mt-2"></div> -->
                </div>
            </form>
           
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							$("#psearch").keyup(function() {
								var input = $(this).val();
								//    alert(input);
								if (input != "") {
									$.ajax({
										url: "backend_search.php",
										method: "POST",
										data: {
											input: input
										},
										success: function(data) {
											$("#result").html(data);
										}
									});
								} else {
									$("#result").css("display", "none");
									// setInterval('location.reload()', 100);
								}
							});
						});
					</script>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <?php
            $userId = $_SESSION['admin'];
            $sql = "SELECT * FROM `admin` WHERE `Id` = '$userId'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>


                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['full_name'] ?></span>
                        <img class="img-profile rounded-circle" src="IMAGES/users/<?php echo $row['profile_image'] ?> ">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="myprofile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
            <?php  }
            }
            ?>
        </li>

    </ul>

</nav>
<div  id="result"></div>
<!-- End of Topbar -->