<?php include_once('_header.php'); ?>
<div class="container">
    <h2>Результат поиска</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Аптека</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ostatok as $drug): ?>
            <tr>
                <td>
                    <p><?php echo $drug->APTNAME;?></p>
                    <p>Адрес: <?php echo $drug->ADRESS;?></p>
                </td>
                <td><?php echo $drug->NOMNAME;?></td>
                <td><?php echo $drug->KOL;?></td>
                <td><?php echo $drug->PRICE;?></td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>

<?php include_once('_js.php'); ?>
<?php include_once('_footer.php'); ?>

