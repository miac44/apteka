<?php include_once('_header.php'); ?>

<form class="form-inline text-center" action="/search" method="post">
    <div class="form-group">
        <input class="typeahead text-center input-lg" type="text" data-provide="typeahead" size="70" placeholder="Введите название лекарства">
    </div>
    <button type="submit" class="btn-lg btn-default">Искать</button>
</form>

<?php include_once('_js.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('input.typeahead').typeahead({
            source: function (query, process) {
                $.ajax({
                    url: 'ajax/search',
                    type: 'POST',
                    dataType: 'JSON',
                    data: 'search=' + query,
                    success: function(data) {
                        console.log(data);
                        process(data);
                    }
                });
            }
        });
    });
</script>

<?php include_once('_footer.php'); ?>

