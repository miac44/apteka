<?php
$data['SITE_NAME'] = 'Аптечный поиск';
$data['db'] = array (
  'host' => '127.0.0.1',
  'user' => 'root',
  'pass' => '123456',
  'dbname' => 'apteka',
);
$data['dir'] = '';
$data['bad_words'] = array (
        'для приема',
        'капс.',
        'упаковка',
        'блистер',
        'п.п.о.',
        'контурная',
        'ячейковая',
        'таб.',
        ',',
        'кардио',
        'шип.',
        'п/киш-раств.',
        'раствор./кишечн.',
        'п.о.',
        'об.',
        'пор.',
        'д/приг.',
        'назальный',
        'р-ра',
        'сусп.'
);
$data['bad_regexp'] = array(
        '\d+\s?мг',
        '\d+\s?%',
        '№\s?\d+',
        'N\s?\d+',
        '\d+\s?мл',
);
