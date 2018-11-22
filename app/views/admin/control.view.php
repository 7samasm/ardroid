<div class="container control">
    <h4 class="h-center">الادارة</h4>
    <div class="r-t">
        <table>
            <tr>
                <th>ID</th>
                <th>العنوان</th>
                <th>الكاتب</th>
                <th>الصورة</th>
                <th>التاريخ</th>
                <th>التحكم</th>
            </tr>
            <?php foreach ($rows as $row ) { ?>
                <tr>
                    <td><?= $row->getID() ?></td>
                    <td><?= $row->getHEADER() ?></td>
                    <td><?= $row->first_name . ' ' . $row->sec_name ?></td>
                    <td><?= $row->getIMG() ?></td>
                    <td><?= $row->getDATE() ?></td>
                    <td>
                        <a href="/admin/edit/<?= $row->getID() ?>" title="التعديل" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="/admin/delete/<?= $row->getID() ?>" title="الحذف" >
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <a href="/admin/add" id="add-icon" title="اضافة موضوع" >+</a>
</div>