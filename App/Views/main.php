<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<p class="text-center">
        <input class="typeahead text-center input-lg" type="text" data-provide="typeahead" size="70" placeholder="Введите название лекарства">
</p>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/bootstrap3-typeahead.min.js"></script>

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

</body>
</html>


