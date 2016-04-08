<?php
  function bacaHTML($url){
      $data = curl_init();
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_URL, $url);
      $hasil = curl_exec($data);
              curl_close($data);
              return $hasil;
    }

    $array;
      $kodeHTML =  bacaHTML('http://sim.stts.edu/');
      for($i =1;$i<14;$i++){
          $url = explode('<a class="title" href="', $kodeHTML);
          $endurl = explode('" target="_blank">', $url[$i]);
          $name = explode('target="_blank">',$kodeHTML);
          $endname = explode('</a>',$name[$i]);
          $array[] = array('link' => $endurl[0],'nama' => $endname[0]);
          //echo $endname[0]."<br>";
      }
      echo json_encode($array);
?>
