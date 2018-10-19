<script>
	var JSDATA = {};
  <?php
  // Usage:
  // View::render('page.index', ['options' =>
  // [ 'javascript_data' => [
  //      'notifications' => ['sample data']
  // ]
  // ]])
  if (isset($options)) {
      foreach ($options['javascript_data'] as $key => $jsData) {
          $val = json_encode($jsData, JSON_UNESCAPED_SLASHES);
          echo "JSDATA.{$key} = {$val};\n";
      }
  }

  ?>
</script>