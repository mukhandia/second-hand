<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar - Brand -->

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" style="text-decoration:none ;">
        <div class="sidebar-brand-icon ">
            <img src="./logo2.jpg" alt="" style="width:40px;height:40px">
        </div>
        <div class="sidebar-brand-text mx-3" style="color:green;font-weight:900;font-family:cursive;text-decoration:none;font-size:12px">SECOND HAND</div>
    </a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item my-auto">
            <!-- Topbar Search -->
            <form class="search-box d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="single.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" name="name" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    <div class="result mt-2"></div>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $('.search-box input[type="text"]').on("keyup input", function() {
                        /* Get input value on change */
                        var inputVal = $(this).val();
                        var resultDropdown = $(this).siblings(".result");
                        if (inputVal.length) {
                            $.get("components/backend_search.php", {
                                term: inputVal
                            }).done(function(data) {
                                // Display the returned data in browser
                                resultDropdown.html(data);
                            });
                        } else {
                            resultDropdown.empty();
                        }
                    });
                    // Set search input value on click of result item
                    $(document).on("click", ".result p", function() {
                        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                        $(this).parent(".result").empty();
                    });
                });
            </script>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="cart.php" id="alertsDropdown" role="button">
                <i class="fas fa-cart-plus fa-2x fa-fw text-success"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="returned_value">
                    <?php
                    $userId = $_SESSION['Id'];
                    $sql = "SELECT * FROM `tblorder` WHERE `customer_id` = '$userId'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $num = mysqli_num_rows($result);
                        echo $num;
                    }
                    ?>
                    +</span>
            </a>
        </li>


        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <?php
            $userId = $_SESSION['Id'];
            $sql = "SELECT * FROM `users` WHERE `Id` = '$userId'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>


                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['Customer Name'] ?></span>
                        <img class="img-profile rounded-circle" src="IMAGES/users/avatar.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">
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
                        <a class="dropdown-item" href="logout.php" ">
                            <i class=" fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
            <?php  }
            }
            ?>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->