<?php
include("../server/connect.php");

?>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Transaction</h6>
</div>
<div class="card-body">
    <?php
    if(isset($_POST["input"])){
        $input=$_POST['input'];
        $query="SELECT * FROM `tblpayment` WHERE `payment_voucher` LIKE '{$input}%' OR `payment_date` LIKE '{$input}%'";
        $result= mysqli_query($db,$query);
        if(mysqli_num_rows($result)>0){?>
    <table class="table table-hovered table-inverse table-responsive">
        <thead class="thead-inverse" style="background-color: green; border-bottom:4px solid orange;color:white;">
            <tr>
                <th>S/N</th>
                <th>Payment Voucher</th>
                <th>Cart Id</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Paid By</th>
                <th>Payment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($search = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td scope="row"><?php echo $i ?></td>
                    <td>
                        <h5 style="color:orange;font-family:monospace;font-weight:900;text-align:center"><?php echo $payment['payment_voucher'] ?></h5>
                    </td>
                    <td><?php echo $search['cart_id'] ?>
                    </td>
                    <td><?php echo $search['amount'] ?></td>
                    <td>
                        <?php
                        echo $search['payment_status'];

                        if ($search['payment_status'] == 'Verified') { ?>
                            <button type="button" class="btn btn-success px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;"><i class="fa fa-check"></i></button>
                        <?php } else if ($search['payment_status'] == 'Paid, Not Verified') { ?>
                            <button type="button" class="btn btn-danger px-2 py-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Not Verified</button>
                        <?php } else {
                            echo mysqli_error($conn);
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $userId = $search['paid_by'];
                        if ($search['paid_by'] == "") {
                            echo "No Data";
                        } else {
                            $sql = "SELECT * FROM `users` WHERE `Id` = $userId";
                            $users = mysqli_query($conn, $sql);
                            foreach ($users as $user) {
                                echo $user['Customer Name'];
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $search['payment_date'] ?>
                    </td>
                    <td>
                        <div class="row mr-auto d-flex justify-content-around">
                            <div class="col-lg-6">
                                <form action="" method="POST">
                                    <input type="text" name="Id" id="" value="<?php echo $search['payment_id'] ?>" hidden>
                                    <?php
                                    $admin = $_SESSION['Id'];
                                    ?>
                                    <input type="text" name="admin" id="" value="<?php echo $admin ?>" hidden>
                                    <button type="submit" class="btn btn-success  px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Verify</button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <a href="transactions.php?Id=<?php echo $search['payment_id'] ?>">
                                    <button type="button" class="btn btn-danger px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Delete</button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
        <?php
            if (isset($_GET['Id'])) {
                $del_transaction = $_GET['Id'];
                $sql = "DELETE FROM tblpayment WHERE payment_id = $del_transaction;";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $message = '<div class="alert alert-alert" role="alert">
                    <strong><i class="fa fa-exclamation" style="color:green" aria-hidden="true"></i> Product Added Successfuly</strong>
                    </div>';
                } else {
                    $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check" style="color:green" aria-hidden="true"></i> Product Deleted Successfuly</strong>
                    </div>';
                    // header('location:transactions.php');
                }
            }
        }
    }
            ?>
    </table>
</div>
</div>
</div>
<!-- Page Heading -->
</div>
