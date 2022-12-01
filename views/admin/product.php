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
            <span class="btn btn-primary glyphicon glyphicon-plus btn-sm" id="addBtn"></span>
          </div>
          <div class="container" id="addArea" style="width: 100%; display: none; padding-bottom: 10px;">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
              <legend>Thêm sản phẩm</legend>
              <i id="addError" style="color: red"></i>
              <!-- <div class="form-group">
                <label for="">Mã sản phẩm</label>
                <input type="text" class="form-control" id="masp">
              </div> -->
              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" id="tensp">
              </div>
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="fileToUpload" id="pic">
              </div>
              <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <input type="text" class="form-control" id="gia">
              </div>
              <span class="btn btn-success" id="add2Btn">Thêm</span>
              <span class="btn btn-default" id="cancelAddBtn">Hủy</span>
            </form>
          </div>
          <div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
              <legend>Sửa sản phẩm</legend>
              <i id="addError" style="color: red"></i>
              <!-- <div class="form-group">
                <label for="">Mã sản phẩm</label>
              </div> -->
              <input type="hidden" class="form-control" id="producteditmasp">

              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productedittensp">
              </div>
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="fileToUpload" id="producteditpic">
              </div>
              <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <input type="text" class="form-control" id="producteditgia">
              </div>
              <span class="btn btn-success" id="edit2Btn">Xong</span>
              <span class="btn btn-default" id="cancelEditBtn">Hủy</span>
            </form>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr id="tbheader">

                <th>STT</th>
                <th>Mã sp</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Ngày nhập</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < count($data); $i++) { ?>
                <tr>
                  <td><?php echo $i + 1 ?></td>
                  <td><?php echo $data[$i]['masp'] ?></td>
                  <td><?php echo $data[$i]['tensp'] ?></td>
                  <td><img style="width: 50px" src="<?php echo $data[$i]['anhchinh'] ?>"></td>
                  <td><?php echo $data[$i]['gia'] ?></td>
                  <td>
                    <?php if ($data[$i]['isDel'] == 0) : ?>
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
              ?>
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
  // add
  $('#addBtn').on('click', function() {
    $('#addArea').toggle(300);
  })
  $('#cancelAddBtn').on('click', function() {
    $('#addArea').toggle(300);
  })

  $('#add2Btn').on('click', function() {
    action('add', );
  })

  // edit and del 
  $('#edit2Btn').on('click', function() {
    // var id = $(this).data('id');
    action('edit');
  })
  $('.delItemBtn').on('click', function() {
    var cf = confirm('Bạn chắc chứ?');
    if (cf) {
      var id = $(this).data('id');
      action('del', id);
    }
  })
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
    $('#producteditgia').val($(this).closest('tr').children('td:nth-child(5)').text());
  })
  $('#cancelEditBtn').on('click', function() {
    $('#example1').toggle();
    $('#editArea').toggle(300);
  })

  function action(name, id = null) {
    idEdit = $('#producteditmasp').val()
    namespedit = $('#productedittensp').val();
    picurledit = $('#producteditpic').val();
    countedit = $('#producteditgia').val();
    var namesp = picurl = count = '';
    if (name == 'add') {
      namesp = $('#tensp').val();
      picurl = $('#pic').val();
      count = $('#gia').val();
      console.log(name, namesp, picurl, count);
      if (namesp == '') {
        alert('Bạn chưa điền tên sản phẩm!');
        return;
      }
      if (picurl == '') {
        alert('Bạn chưa upload hình!');
        return;
      }
      if (count == '') {
        alert('Bạn chưa điền giá tiền sản phẩm!');
        return;
      }

    }
    console.log(name, idEdit, namespedit, picurledit, countedit);
    $.ajax({
      url: 'product/action',
      type: 'GET',
      dataType: 'text',
      data: {
        idEdit,
        namespedit,
        picurledit,
        countedit,
        namesp,
        picurl,
        count
      },
      success: function(result) {
        if (result == 'OK') {
          alert("Successful!");
          location.reload();
        } else {
          $('#addError').html(result);
        }
      }
    })
  }
</script>