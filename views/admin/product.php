<section class="content-header">
  <h1>
    <?php echo $title ?>
    <small> </small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="container" style="margin: 10px 0;">
            <i id="addError" style="color: red"></i>
            <i id="addSuccess" style="color: green"></i>

            <span class="btn btn-primary glyphicon glyphicon-plus btn-sm" id="addBtn"></span>
          </div>
          <div class="container" id="addArea" style="width: 100%; display: none; padding-bottom: 10px;">
            <form action="Admin/productadmin/createProduct" method="POST" role="form" enctype="multipart/form-data">
              <legend>Thêm sản phẩm</legend>
              <input type="hidden" value="<?= $_SESSION['admin']['id'] ?>" class="form-control" name="idUser">

              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" name="tensp" required>
              </div>
              <div class="form-group">
                <label for="">Mô tả sản phẩm</label>
                <textarea class="form-control" name="mota" row='3' required></textarea>
              </div>
              <div class="form-group">
                <label for="">Loại sản phẩm:</label>

                <select name="category" required>
                  <option value="">None</option>

                  <?php foreach ($_SESSION["name_category"] as $key => $value) : ?>
                    <option value="<?= $value['id_category'] ?>"> <?= $value['name_category'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="fileToUpload" required>
              </div>
              <div class=" form-group">
                <label for="">Giá sản phẩm</label>
                <input type="number" class="form-control" name="gia" required min="200000">
              </div>

              <div class="form-group">
                <label for="">Số lượng</label>
                <input type="number" class="form-control" name="count" required min="1" max="100">
              </div>
              <button type="submit" class="btn btn-success">Thêm</button>
              <span class="btn btn-default" id="cancelAddBtn">Hủy</span>
            </form>
          </div>
          <div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
            <form action="Admin/productadmin/editProduct" method="POST" role="form" enctype="multipart/form-data">
              <legend>Sửa sản phẩm</legend>

              <!-- <div class="form-group">
                <label for="">Mã sản phẩm</label>
              </div> -->
              <input type="hidden" value="<?= $_SESSION['admin']['id'] ?>" class="form-control" name="idUser">
              <input name="idproduct" type="hidden" class="form-control" id="producteditmasp" required>

              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input name="tensp" type="text" class="form-control" id="productedittensp" required>
              </div>
              <div class="form-group">
                <label for="">Mô tả sản phẩm</label>
                <textarea class="form-control" name="mota" row='3' id='producteditmota' required></textarea>
              </div>
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="fileToUpload">
              </div>
              <div class=" form-group">
                <label for="">Loại sản phẩm:</label>

                <select name="category" required>
                  <option value="">None</option>
                  <?php foreach ($_SESSION["name_category"] as $key => $value) : ?>
                    <option value="<?= $value['id_category'] ?>"> <?= $value['name_category'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class=" form-group">
                <label for="">Giá sản phẩm</label>
                <input name="gia" type="text" class="form-control" id="producteditgia" required min="200000">
              </div>
              <div class="form-group">
                <label for="">Số lượng</label>
                <input type="number" class="form-control" name="count" id="producteditsoluong" required min="1" max="100">
              </div>
              <button type="submit" class="btn btn-success" id="edit2Btn">Xong</button>
              <span class="btn btn-default" id="cancelEditBtn">Hủy</span>
            </form>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr id="tbheader">

                <th>STT</th>
                <th>Mã sp</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Loại sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Tồn kho </th>
                <th>Trạng thái</th>
                <th>Người tạo</th>
                <th>Ngày nhập</th>
                <th>Ngày sửa</th>
                <th>Xét duyệt</th>
                <th>Hành động</th>
              </tr>
            </thead>

            <tbody>
              <!-- <?php
                    for ($i = 0; $i < count($data); $i++) { ?>
                <tr>
                  <td><?php echo $i + 1 ?></td>
                  <td><?php echo $data[$i]['masp'] ?></td>
                  <td><?php echo $data[$i]['tensp'] ?></td>
                  <td><img style="width: 50px" src='<?php echo $data[$i]['anhchinh'] ?>'></td>
                  <td><?php echo $data[$i]['gia'] ?></td>
                  <td><?php echo $data[$i]['count'] ?></td>
                  <td>
                    <?php if ($data[$i]['isDel'] == 0 || $data[$i]['count'] <= 0) : ?>
                      Hết Hàng
                    <?php elseif ($data[$i]['isDel'] == 1) :  ?>
                      Còn Hàng
                    <?php endif  ?> 

                  </td>
                  <td><?php echo $data[$i]['ngay_nhap'] ?></td>
                  <td class="text-center">

                    <?php if ($data[$i]['isDel'] == 0) : ?>
                    <?php elseif ($data[$i]['isDel'] == 1) :  ?>
                      <span class="btn btn-primary editItemBtn" data-id='<?php echo $data[$i]['masp'] ?>'>Chỉnh sửa</span>
                      <span class="btn btn-danger delItemBtn" data-id='<?php echo $data[$i]['masp'] ?>'>Xóa</span>
                    <?php endif  ?>

                  </td>
                </tr>
              <?php }
              ?> -->

              <?php $index = 1 ?>
              <?php foreach ($data as $item) : ?>
                <tr>
                  <td><?= $index++ ?></td>
                  <td><?= $item['id_product'] ?></td>
                  <td><?= $item['name_product'] ?></td>
                  <td><?= $item['desc_product'] ?></td>
                  <td><?= $item['name_category'] ?></td>
                  <td><img style="width: 50px" src='<?= $item['img_prodcut'] ?>'></td>
                  <td><?= $item['price_product'] ?></td>
                  <td><?= $item['quantity_product'] ?></td>
                  <td>
                    <?php if ($item['status_product'] == 0 || $item['quantity_product'] <= 0) : ?>
                      Hết Hàng
                    <?php elseif ($item['status_product'] == 1) :  ?>
                      Còn Hàng
                    <?php endif  ?>

                  </td>

                  <td><?= $item['name'] ?></td>
                  <td><?= $item['create_time'] ?></td>
                  <td><?= $item['update_time'] ?></td>
                  <td>
                    <?php if ($item['approve_product'] == 1) : ?>
                      Đã duyệt
                    <?php elseif ($item['approve_product'] == 0) :  ?>
                      Chờ duyệt
                    <?php endif  ?>

                  </td>
                  <td class="text-center">

                    <?php if ($item['status_product'] == 0) : ?>
                    <?php elseif ($item['status_product'] == 1) :  ?>
                      <?php if ($item['approve_product'] == 1) : ?>
                      <?php elseif ($item['approve_product'] == 0) :  ?>
                        <span class="btn btn-warning approveItemBtn" data-id='<?= $item['id_product'] ?>'>Phê Duyệt</span>
                      <?php endif  ?>
                      <span class="btn btn-primary editItemBtn" data-id='<?= $item['id_product'] ?>'>Chỉnh sửa</span>
                      <span class="btn btn-danger delItemBtn" data-id='<?= $item['id_product'] ?>'>Xóa</span>
                    <?php endif  ?>

                  </td>
                </tr>

              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- jQuery 3 -->
<script src="views/admin/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="views/admin/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="views/admin/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="views/admin/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="views/admin/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="views/admin/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="views/admin/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="views/admin/AdminLTE/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $('#sptab').addClass('active');
  $(document).ready(function() {
    $('#example1 tr').not($('#tbheader')).click(function(event) {
      if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
      }
    })
    $('#example1').addClass('active');
    $('#check-all-gd').click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  })
  // // add
  $('#addBtn').on('click', function() {
    $('#addArea').toggle(300);
  })
  $('#cancelAddBtn').on('click', function() {
    $('#addArea').toggle(300);
  })

  // $('#add2Btn').on('click', function() {
  //   action('add', );
  // })

  // // edit and del 
  // $('#edit2Btn').on('click', function() {
  //   // var id = $(this).data('id');
  //   action('edit');
  // })
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
  $('.delItemBtn').on('click', function() {
    var cf = confirm('Bạn chắc chứ?');
    if (cf) {
      var id = $(this).data('id');
      action('del', id);
    }
  })
  $('.editItemBtn').on('click', function() {
    $('#edit2Btn').attr('data-id', $(this).data('id'));
    $('#example1').toggle();
    $('#editArea').toggle(300);
    $('#producteditmasp').val($(this).closest('tr').children('td:nth-child(2)').text());
    $('#productedittensp').val($(this).closest('tr').children('td:nth-child(3)').text());
    $('#producteditmota').val($(this).closest('tr').children('td:nth-child(4)').text());
    $('#producteditgia').val($(this).closest('tr').children('td:nth-child(7)').text());
    $('#producteditsoluong').val($(this).closest('tr').children('td:nth-child(8)').text());
  })

  $('.approveItemBtn').on('click', function() {
    var id = $(this).data('id');
    approveItem(id);
  })
  $('#cancelEditBtn').on('click', function() {
    $('#example1').toggle();
    $('#editArea').toggle(300);
  })

  function action(name, id = null) {
    $.ajax({
      url: `ProductAdmin/deleteProduct/${id}`,
      type: 'GET',
      dataType: 'text',
      data: {
        id,
      },
      success: function(result) {
        if (result == "OK") {
          alert("Xoá thành công");
          location.reload();

        } else {
          alert(result);

        }
      }
    })
  }


  function approveItem(id) {
    $.ajax({
      url: `ProductAdmin/approveProduct/${id}`,
      type: 'GET',
      dataType: 'text',
      data: {
        id,
      },
      success: function(result) {
        if (result == "OK") {
          alert("Phê duyệt thành công");
          location.reload();

        } else {
          alert(result);

        }
      }
    })
  }
</script>