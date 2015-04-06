<?php
  $json_data= $vars['datos'];
  $tipo= $vars['tipo'];
  $numero= $vars['numero'];
?>
<script  type = "text/javascript">
    var data = <?php echo $json_data; ?>;
    drawChart(data, '<?php $tipo?>', <?php echo $numero?>);
</script>


