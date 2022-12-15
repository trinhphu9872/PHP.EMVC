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

                    </div>
                    <div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">

                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr id="tbheader">


                            </tr>
                        </thead>

                        <tbody>



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
<!-- <script> -->
<!-- $('#sptab').addClass('active');
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
// action('add', );
// })

// // edit and del
// $('#edit2Btn').on('click', function() {
// // var id = $(this).data('id');
// action('edit');
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
$('#producteditgia').val($(this).closest('tr').children('td:nth-child(5)').text());
$('#producteditsoluong').val($(this).closest('tr').children('td:nth-child(6)').text());
})
$('#cancelEditBtn').on('click', function() {
$('#example1').toggle();
$('#editArea').toggle(300);
})

function action(name, id = null) {
$.ajax({
url: `ProductAdmin/Delete/${id}`,
type: 'GET',
dataType: 'text',
data: {
id,
},
success: function(result) {
location.reload();
}
})
} -->
</script>