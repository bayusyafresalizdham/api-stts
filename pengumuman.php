<?php
    error_reporting(0);
    function bacaHTML($url){
      $data = curl_init();
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_URL, $url);
      $hasil = curl_exec($data);
              curl_close($data);
              return $hasil;
    }
    $page=$_GET['page'];
    $array;
    $kodeHTML =  bacaHTML('http://sim.stts.edu/pengumuman_data.php?page='.$page);


      for($i =1;$i<7;$i++){
          $url = explode('<a href="#" class="title link-pengumuman" id=', $kodeHTML);
          $endurl = explode('>', $url[$i]);
          $query = '<a href="#" class="title link-pengumuman" id='.$endurl[$i][0].'>';
          $name = explode('<a href="#" class="title link-pengumuman"',$kodeHTML);
          $endname = explode('</a></p>',$name[$i]);
          $file = explode('<a href="upload/',$kodeHTML);
          $endfile = explode('" style="text-decoration: none;"><img src="images/pdf.png" width="15" height="15" style="border: none;"/>',$file[$i]);
          $pos = strpos($endname[0],'>' );
          $ket = explode('<p class="sm">',$kodeHTML);
          $endket = explode('<a href="',$ket[$i]);
          $time = explode('<img src="images/pdf.png" width="15" height="15" style="border: none;"/>',$kodeHTML);
          $endtime =  explode('</a>',$time[$i]);
          if(!empty($endurl[0]) && !empty($endname[0])){
            $array[] = array('id' => $endurl[0],
                            'title' => substr($endname[0],$pos+1),
                            'file'=>$endfile[0],
                            'desc'=>$endket[0],
                            'size'=>$endtime[0]);
          }else{
            $array = null;
          }
          //echo $endket[0]."<br>";
      }
      echo json_encode($array);
?>
