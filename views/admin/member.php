<section class="content-header">
  <h1>
    <?php echo $title ?>
    <small>Version</small>
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
          <div class="container" style="margin-bottom: 15px; display: none" id="addArea">
            <form action="" method="POST" role="form">
              <legend>Thêm thành viên</legend>

              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="form-group">
                <label for="">Tên tài khoản</label>
                <input type="text" class="form-control" id="username">
              </div>
              <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" id="password">
              </div>
              <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="cpassword">
              </div>
              <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" class="form-control" id="addr">
              </div>
              <div class="form-group">
                <label for="">SDT</label>
                <input type="text" class="form-control" id="tel">
              </div>


              <label for="role">Vị trí</label>
              <select class="form-control my-1" id="role">
                <option value="0">Người dùng</option>

                <option value="2">Người bán hàng</option>

              </select>
              <span class="btn btn-success my-2" id="add2Btn">Thêm</span>
              <span class="btn btn-default my-2" id="cancelBtn">Hủy</span>
            </form>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên thành viên</th>
                <th>Tên tài khoản</th>
                <th>Vị trí</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Ngày tham gia</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 0; ?>
              <?php foreach ($data as $item) : ?>
                <tr>
                  <td><?php echo $index + 1 ?></td>
                  <td><?php echo $item['id'] ?></td>
                  <td><?php echo $item['name'] ?></td>
                  <td><?php echo $item['username'] ?></td>
                  <td>
                    <?php if ($item['role_id'] == 0) : ?>
                      Người dùng
                    <?php elseif ($item['role_id'] == 2) :  ?>
                      Người bán hàng
                    <?php endif  ?>

                  </td>

                  <td><?php echo $item['addr'] ?></td>
                  <td><?php echo $item['phone'] ?></td>
                  <td>
                    <?php if ($item['status_user'] == 1) : ?>
                      Hoạt động
                    <?php elseif ($item['status_user'] == 0) :  ?>
                      Không hoạt động
                    <?php endif  ?>

                  </td>

                  <td><?php echo $item['create_time'] ?></td>
                  <td class="text-center">
                    <?php if ($item['status_user'] == 1) : ?>
                      <span class="btn btn-danger btn-sm delBtn" data-id="<?php echo $item['id'] ?>">Xóa</span>
                    <?php elseif ($item['status_user'] == 0) :  ?>
                      <span class="btn btn-danger btn-sm delBtn" data-id="<?php echo $item['id'] ?>">Mở</span>
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
  $('#tvtab').addClass('active');
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
</script>
<script>
  $('.delBtn').on('click', function() {
    var cf = confirm('Bạn chắc chán xoá chưa');
    console.log($(this).data('id'));
    if (cf) {
      delAcc($(this).data('id'));
    }
  })
  $('#addBtn').click(function() {
    $('#addArea').toggle(300);
  })
  $('#add2Btn').click(function() {
    action('add');
  })
  $('#cancelBtn').click(function() {
    $('#addArea').toggle(300);
  })

  function action(name, id = null) {
    var userNa = username = cpassword = password = addr = tel = email = role = '';
    if (name == 'add') {
      userNa = $('#name').val();
      username = $('#username').val();
      password = $('#password').val();
      cpassword = $('#cpassword').val();
      addr = $('#addr').val();
      tel = $('#tel').val();
      email = $('#email').val();
      role = $('#role').val();

      if (username == '' || password == '') {
        alert('Không được để trống!');
        return;
      }
      if (password != cpassword) {
        alert('Mật khẩu nhập lại không trùng khớp!');
        return;
      }
    };
    $.ajax({
      url: 'member/createAccount',
      type: 'POST',
      dataType: 'text',
      data: {
        id,
        userNa,
        username,
        password,
        addr,
        tel,
        email,
        role
      },
      success: function(result) {
        // console.log(result);
        location.reload();

      }
    })





  }

  function delAcc(id) {
    $.ajax({
      url: 'member/delAccount',
      type: 'POST',
      dataType: 'text',
      data: {
        id,
      },
      success: function(result) {

        alert(result);
        location.reload();

      }


    })
  }
</script>