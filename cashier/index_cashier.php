<!DOCTYPE html>

<?php include 'includes/tophead.php'; ?>
  <body>
   
  <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
   

      <?php include 'includes/sidebar.php'; ?>


   

     
      <div class="layout-page">
     

        <?php include 'includes/topnavbar.php'; ?>




        <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                  <?php
                  // Get the 'page' parameter from the URL, fallback to 'dashboard' if not set
                  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                  switch ($page) {
                      case 'dashboard':
                          include 'pages/dashboard.php'; // Include the dashboard page content
                          break;
                      case 'pos':
                        include 'pages/pos.php'; // Include the about page content
                          break;
                      case 'customers':
                        include 'pages/customers.php'; // Include the about page content
                          break;

                          case 'inventory':
                            include 'pages/inventory.php'; // Include the about page content
                              break;


                              case 'order':
                                include 'pages/order.php'; // Include the about page content
                                  break;

                                  
                              case 'payments':
                                include 'pages/payments.php'; // Include the about page content
                                  break;
                              case 'reciept':
                                include 'pages/reciepts.php'; // Include about reciept content
                                  break;
                              case 'transaction':
                                include 'pages/transaction.php'; // Include about transactions
                                break;
                      default:
                          include 'pages/404.php'; // Include a 404 page if no match
                  }
                  ?>
              </div>

              <?php include 'includes/footer.php'; ?>
          </div>


        </div>
      </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>


 
  
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
