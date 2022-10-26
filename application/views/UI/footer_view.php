          <!-- Footer -->
          <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                      <span>Copyright &copy; Growth CRM <?php echo  date('Y') ?></span>

                  </div>
              </div>
              <p class="footer text-right">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
          </footer>
          <!-- End of Footer -->

          </div>
          <!-- End of Content Wrapper -->
          </div>
          <!-- End of Page Wrapper -->
          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
              <i class="fas fa-angle-up"></i>
          </a>

          <!-- Logout Modal-->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                      <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-primary" href="login.html">Logout</a>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Bootstrap core JavaScript-->
          <script src="<?php echo base_url() ?>/theme/vendor/jquery/jquery.min.js"></script>

          <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>


          <script src="<?php echo base_url() ?>/theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

          <!-- Core plugin JavaScript-->
          <script src="<?php echo base_url() ?>/theme/vendor/jquery-easing/jquery.easing.min.js"></script>

          <!-- Custom scripts for all pages-->
          <script src="<?php echo base_url() ?>/theme/js/sb-admin-2.min.js"></script>

          <!-- Page level plugins -->
          <script src="<?php echo base_url() ?>/theme/vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="<?php echo base_url() ?>/theme/vendor/datatables/dataTables.bootstrap4.min.js"></script>

          <!-- Page level custom scripts -->
          <script src="<?php echo base_url() ?>/theme/js/demo/datatables-demo.js"></script>

          <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

          <script>
              $(document).ready(function() {
                  $('#dataTable').DataTable(<?php echo !empty($tableConfig) ? json_encode($tableConfig)  : json_encode([]) ?>);
              });

              $(document).ready(function() {
                  $('.js-example-basic-single').select2();
              });
          </script>
          <?php
            $maskInputs = $CI->getMask();
            $loopups = $CI->getLoopUp();

            $token_name = $CI->security->get_csrf_token_name();
            $token_hash = $CI->security->get_csrf_hash();


            if ($maskInputs) {

                foreach ($maskInputs as $id => $mask) {
            ?>
                  <script>
                      $(document).ready(function() {
                          $('#<?php echo $id ?>').inputmask({
                              "mask": "<?php echo $mask ?>"
                          });
                      });
                  </script>
              <?php
                }
            }

            if ($loopups) {
                foreach ($loopups as $loopup) {
                ?>


                  <script>
                      $(document).ready(function() {
                          $('[name="form[<?php echo  $loopup['name'] ?>]"]').select2({
                              ajax: {
                                  url: '<?php echo base_url() ?>PicklistOption/lookup',
                                  dataType: 'json',
                                  data: function(params) {
                                      var query = {
                                          search: params.term,
                                          model: '<?php echo  $loopup['model'] ?>',
                                          show_lable: '<?php echo  $loopup['show_lable'] ?>',
                                          <?php echo $token_name ?>: '<?php echo $token_hash ?>'
                                      }
                                      // Query parameters will be ?search=[term]&type=public
                                      return query;
                                  }
                              }
                          });
                      });
                  </script>


          <?php }
            } ?>

          <script type="text/javascript">
              $(document).ready(function() {
                  $("#evol").structFilter({
                      fields: [{
                              id: "lastname",
                              type: "text",
                              label: "Lastname"
                          },
                          {
                              id: "firstname",
                              type: "text",
                              label: "Firstname"
                          },
                          {
                              id: "active",
                              type: "boolean",
                              label: "Is active"
                          },
                          {
                              id: "age",
                              type: "number",
                              label: "Age"
                          },
                          {
                              id: "bday",
                              type: "date",
                              label: "Birthday"
                          },
                          {
                              id: "category",
                              type: "list",
                              label: "Category",
                              list: [{
                                      id: "1",
                                      label: "Family"
                                  },
                                  {
                                      id: "2",
                                      label: "Friends"
                                  },
                                  {
                                      id: "3",
                                      label: "Business"
                                  },
                                  {
                                      id: "4",
                                      label: "Acquaintances"
                                  },
                                  {
                                      id: "5",
                                      label: "Other"
                                  }
                              ]
                          }
                      ]
                  });
              });
          </script>
          </body>

          </html>