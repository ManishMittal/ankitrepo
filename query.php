<?php
$main_data = array('data1', 'data2', 'data3');
  $new_data = array();

    foreach($main_data as $data) {

      mysql_query("insert into products (pname) values ('$data')");

      $new_id = mysql_insert_id();

      // Save the new id into an array + the data
      $new_data[$new_id] = $main;

    }

    $insert_into = array();

    // Create a new insert statement
    foreach($new_data as $new_key => $data) {
        $insert_into[] . "($new_key, '$data')"
    }

    $imploded_data = implode(',', $insert_into);

    if (count($insert_into) > 0) {

        // The result will be something like Insert into `table2` (id, value) values (1, 'data1'), (2, 'data2'),(3, 'data3');
        mysql_query("insert into cat_pro (id, value) values $imploded_data");
    }
?>
