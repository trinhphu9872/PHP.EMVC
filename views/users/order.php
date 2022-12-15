<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr id="tbheader">


            <th>STT</th>
            <th>Tình trạng</th>
            <th>Tên KH</th>
            <th>Quận</th>
            <th>DC cụ thể</th>
            <th>SDT</th>
            <th>Ngày</th>
            <th>Mã sp</th>
            <th>Tên sp</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($data)) : ?>
            <?php for ($i = 0; $i < count($data); $i++) {
                $rsp = count($data[$i]['sp']) ?>
                <tr>

                    <td><?php echo $i + 1 ?></td>
                    <td>
                        <?php if ($data[$i]['tinhtrang'] == 1) {
                            echo "<span class='label label-success'>Đã giao</span>";
                        } elseif ($data[$i]['tinhtrang'] == 0) {
                            echo "<span class='label label-warning'>Chưa giao</span>";
                        } else {
                            echo "<span class='label label-danger'>Hủy</span>";
                        } ?>

                    </td>
                    <td><?php echo $data[$i]['user_name'] ?></td>
                    <td><?php echo $data[$i]['user_dst'] ?></td>
                    <td><?php echo $data[$i]['user_addr'] ?></td>
                    <td><?php echo $data[$i]['user_phone'] ?></td>
                    <td><?php echo $data[$i]['date'] ?></td>

                    <td>
                        <?php
                        for ($j = 0; $j < count($data[$i]['sp']); $j++) {
                            echo $data[$i]['sp'][$j]['masp'] . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        for ($j = 0; $j < count($data[$i]['sp']); $j++) {
                            echo $data[$i]['sp'][$j]['tensp'] . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        for ($j = 0; $j < count($data[$i]['sp']); $j++) {
                            echo $data[$i]['sp'][$j]['dongia'] . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        for ($j = 0; $j < count($data[$i]['sp']); $j++) {
                            echo $data[$i]['sp'][$j]['soluong'] . "<br>";
                        }
                        ?>
                    </td>

                    <td><?php echo number_format($data[$i]['tongtien'], 0, ',', ' ') ?> &#8363;</td>
                </tr>
            <?php } ?>
        <?php endif ?>

    </tbody>
</table>