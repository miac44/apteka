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
{% for drug in drugs %}
            <tr>
                <td>
                    <p>{{ drug.APTNAME }}</p>
                    <p>Адрес: {{ drug.ADRESS }}</p>
                </td>
                <td>{{ drug.NOMNAME }}</td>
                <td>{{ drug.KOL }}</td>
                <td>{{ drug.PRICE }}</td>
            </tr>
{% endfor %}
        </tbody>
    </table>
</div>

{{ include('Apteka\_js.php') }}
