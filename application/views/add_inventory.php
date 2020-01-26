<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add inventory</title>

    <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/software/assets/includes/styles.php';
    ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="<?php echo base_url(); ?>images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="<?php echo base_url() . 'main/add_inventory_page'; ?>">
                                <i class="fas fa-chart-bar"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Add Inventory</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/software/assets/includes/menu.php'; ?>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search_product" placeholder="Search for inventory item" />
                                <button class="au-btn--submit" type="submit" name="search_inv_btn">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <!-- <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?php echo base_url(); ?>assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div> 
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="row p-2">
                    <div class="col-md-9">
                        <div class="h2 text-center">
                            Inventory Items
                            <span>
                                <button class="btn btn-primary update-inventory-rows">Update</button>
                            </span>

                            <?php
                                if( isset( $_POST['search_inv_btn'] ) ) { ?>
                                    <a href="<?php echo base_url() . 'main/add_inventory_page' ?>" class="btn btn-secondary ">Remove Search Filter</a>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th><i class="far fa-trash-alt remove-multi-rows"></i></th>
                                        <th>Sno#</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Date/Time</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $page = ! is_null( $this->uri->segment(3) ) ? $this->uri->segment(3) : 1; 
                                        $entries = $inv_model->get_paginated_inventory( $page );
                                        $sno = ( $page * 10 ) - 9;

                                        if( $entries->num_rows() > 0 && ! isset( $_POST['search_inv_btn'] ) ) {
                                            foreach( $entries->result() as $entry ) { ?>
                                                <tr class="inventory-tab-row">
                                                    <td><input type="checkbox" value="<?php echo $entry->ID; ?>" class="inv-entry-checkbox" /></td>
                                                    <td><?php echo $sno++; ?></td>
                                                    <td class="editable-col-prd"><?php echo $entry->product; ?></td>
                                                    <td class="editable-col-qty"><?php echo $entry->qty; ?></td>
                                                    <td><?php echo date( 'Y-m-d h:i A', $entry->add_date ); ?></td>
                                                    <td>
                                                        <span class="edit-btn-inventory" data-id="<?php echo $entry->ID; ?>">Edit</span>
                                                    </td>
                                                </tr>
                                        <?php
                                            }   
                                        } elseif( isset( $_POST['search_inv_btn'] ) ) { 
                                            $src_res = $inv_model->get_search_inventory( $_POST['search_product'] );

                                            if( $src_res->num_rows() > 0 ) {
                                                foreach( $src_res->result() as $k => $entry ) { ?>
                                                    <tr class="inventory-tab-row">
                                                        <td><input type="checkbox" value="<?php echo $entry->ID; ?>" class="inv-entry-checkbox" /></td>
                                                        <td><?php echo $sno++; ?></td>
                                                        <td class="editable-col-prd"><?php echo $entry->product; ?></td>
                                                        <td class="editable-col-qty"><?php echo $entry->qty; ?></td>
                                                        <td><?php echo date( 'Y-m-d h:i A', $entry->add_date ); ?></td>
                                                        <td><span class="edit-btn-inventory">Edit</span></td>
                                                    </tr>
                                            <?php
                                                } 
                                            } else { ?>
                                                <tr><td colspan="6">No result found.</td></tr>
                                            <?php
                                            }
                                            
                                        } else { ?>
                                            <tr><td colspan="6">No saved inventory.</td></tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <?php
                                if( $inv_model->total_inventory_pages() > 1 ) {
                                    for( $x = 1; $x <= $inv_model->total_inventory_pages(); $x++ ) { ?>
                                        <a href="<?php echo base_url() . 'main/add_inventory_page/' . $x; ?>" class="inv-table-pages"><?php echo $x; ?></a>
                                <?php
                                    }   
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 add-inv-box">
                        <?php
                            if( isset( $_GET['msg'] ) ) { 
                                $main->success_notice();
                            }
                        ?>
                        <div class="h2">
                            Add Product
                        </div>
                        <form method="post">
                            <div>
                                <input type="text" name="inv_product_name" class="form-control mt-4" placeholder="product name" autocomplete="off" />
                                <input type="number" name="inv_product_qty" class="form-control mt-4" placeholder="product qty" autocomplete="off" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-success mt-4" name="add_inv" value="Add To Stock">
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Modal -->
    <div id="add-sold-item" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add sold item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post">
                    <div class="modal-body">
                            <input type="text" class="form-control mb-2" name="sold_item" placeholder="sold item">

                            <input type="text" class="form-control mb-2" name="sold_item_qty" placeholder="sold item qty">

                            <input type="text" class="form-control mb-2" name="sold_item_price" placeholder="sold item price">
                            
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" name="add_sold_item" value="Add Item" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
       </div>
    </div>   
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/software/assets/includes/custom_js.php'; ?>
</body>

</html>
<!-- end document-->
