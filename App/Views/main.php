<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<input name='search'>
<script>
$('input[name=search]').typeahead({
        //источник данных
        source: function (query, process) {
           return $.post('getdrug', {'name':query},
                 function (response) {
                      var data = new Array();
                      //преобразовываем данные из json в массив
                      $.each(response, function(i, name)
                      {
                        data.push(i+'_'+name);
                      })
                      return process(data);
                    },
                 'json'
                 );
          }
          //источник данных
          //вывод данных в выпадающем списке
          , highlighter: function(item) {
              var parts = item.split('_');
              parts.shift();
              return parts.join('_');
          }
          //вывод данных в выпадающем списке
          //действие, выполняемое при выборе елемента из списка
          , updater: function(item) {
			alert();
                   }
          //действие, выполняемое при выборе елемента из списка
          }
);
</script> 
</body>
</html>


