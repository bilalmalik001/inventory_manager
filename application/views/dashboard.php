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
    <title>Dashboard</title>
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
                            <a href="<?php echo base_url() . 'main'; ?>">
                                <i class="fas fa-chart-bar"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'main/add_inventory_page'; ?>">
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
                                <input class="au-input au-input--xl" type="text" name="sold_item_specific" placeholder="search for specific item" />
                                <button class="au-btn--submit" type="submit" name="sold_item_specific_search">
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Today's overview</h2>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="far fa-handshake"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php echo $sold_items->get_most_sold_item_today(); ?>
                                                </h2>
                                                <span>most sold item</span>
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $sold_items->get_sold_items_qty_today(); ?></h2>
                                                <span>sold items</span>
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php
                                                    echo $sold_items->get_last_item_sold_today();
                                                ?></h2>
                                                <span>last sale</span>
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                    echo number_format( $sold_items->total_amount_today_sold_items() );
                                                    ?>
                                                </h2>
                                                <span>total earning</span>
                                            </div>
                                        </div>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Today's Sold Items
                                    <span>
                                        <button class="btn btn-primary update-inventory-rows">Update</button>
                                    </span>
                                    <?php
                                        if( isset( $_POST['sold_item_specific_search'] ) ) { ?>
                                            <a href="<?php echo base_url() . 'main/' ?>" class="btn btn-secondary ">Remove Search Filter</a>
                                    <?php
                                        }
                                    ?>
                                    <button class="add-sold-item-btn au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#add-sold-item">
                                        <i class="zmdi zmdi-plus"></i>add sold item</button>
                                </h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th><i class="far fa-trash-alt remove-multi-rows"></i></th>
                                                <th>Sno#</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Date/Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $entries = $sold_items->get_sold_items_today();
                                            $sno = 1;

                                            if( isset( $_POST['sold_item_specific_search'] ) ) {
                                                $entries = $this->sold_items->sold_items_specific( $_POST['sold_item_specific'] );
                                            }

                                            if( $entries->num_rows() > 0 ) {
                                                foreach( $entries->result() as $entry ) { ?>
                                                    <tr class="inventory-tab-row">
                                                        <td><input type="checkbox" value="<?php echo $entry->ID; ?>" class="inv-entry-checkbox" /></td>
                                                        <td><?php echo $sno++; ?></td>
                                                        <td class="editable-col-prd"><?php echo $entry->product; ?></td>
                                                        <td class="editable-col-qty"><?php echo $entry->qty; ?></td>
                                                        <td class="editable-col-price"><?php echo $entry->price; ?></td>
                                                        <td><?php echo $entry->date_time; ?></td>
                                                        <td>
                                                            <span class="edit-btn-inventory" data-id="<?php echo $entry->ID; ?>">Edit</span>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }   
                                        } else { ?>
                                            <tr>
                                                <td colspan="7">No data found.</td>
                                            </tr>
                                        <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                            <input type="text" class="form-control mb-2 sold-item" name="sold_item" placeholder="sold item" autocomplete="off" required />

                            <input type="hidden" class="form-control mb-2 sold-item-hidden" name="sold_item_id" placeholder="sold item" autocomplete="off" />

                            <h5 class="search-list-title">Select Item</h5>
                            <ul class="search-list"></ul>
                            
                            <input type="number" class="form-control mb-2 sold-item-qty" name="sold_item_qty" placeholder="sold item qty" autocomplete="off" required />

                            <input type="number" class="form-control mb-2" name="sold_item_price" placeholder="sold item price" autocomplete="off" required />
                            
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success add-sold-item" name="add_sold_item" value="Add Item" disabled />
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
