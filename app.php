<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hello Padrino</title>
<script src="lib/jquery-3.1.1.js"></script>
<link href="lib/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="lib/modal-style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
    <div id="load"></div>
        <div class="section">
            <div id="isi">
                <h3><b>Duplicated Contents Finder</b></h3>
                <br>
                <h6><i>Refresh page to release process</i></h6>
                    <?php
                        echo "<h4>Current Disk : <font color='red'>"
                        .$_SERVER['DOCUMENT_ROOT'].
                        "</h4></font>";
                    ?>
                <button type="submit" id="tombol" class="btn btn-success">More details</button>
                <a href="tracklist.php" id="tombol" class="btn btn-info">Tracklist path</a>
            </div>
                <div id="bg"></div>
                    <div id="modalKotak">
                        <div id="atas">
                            <?php
                                $time = microtime(true); // ms
                                $dir = __DIR__; // root absolut
                                require("duplicateFinder.php");
                                $obj = new duplicateFinder(); // objek
                                $duplicateFile = $obj->findDuplicateFile($dir); // panggil fungsi
                                $c = count($duplicateFile); // hitung hasil
                                    if($c === 0){
                                        echo "<div><h3><font color='green'>
                                            No Duplicate contents found in :
                                            </h3></font><br> \"$dir\"";
                                    }else{
                                        foreach($duplicateFile as $duplicate){
                                            $c=count($duplicate);       
                                            for($i=0;$i<$c;$i++) {
                                                $pathFinder=$duplicate[$i];           
                                                // var_dump ($c);
                                                // var_dump($i);
                                        }
                                    }
                                    echo
                                    "<div>
                                        <font color='red'>
                                            <h3 class='blink'>Detected !</blink></h3><br>
                                            $c duplicate file on root :
                                        </font><br>
                                        \"$dir\"
                                    </div>";
                                }
                                
                            ?>
                            <?php
                                // tolak kembalian pesan err
                                $res = @file_get_contents($pathFinder, false, null, 0); // ambil string dari file
                                    if($res == false){
                                        echo '<br><br>"Your filesystem has been advanced"<br>';
                                    }else{
                                        echo "Content result : <font color='green'>"
                                        .($res).
                                        "<br></font>";
                                        // var_dump($c);
                                    }
                                        echo "<br>Tracing took <font color='blue'>"
                                            .round( (microtime(true) - $time), 2).
                                            "</font> seconds";
                                        // memory
                                        echo "<br /><span style='color:blue'>"
                                            .get_memory().
                                            " </span>of memory processing" ;
                                                function get_memory(){
                                                    $size = memory_get_peak_usage (true);
                                                    $unit = array('b','kb','mb','gb','tb','pb');
                                                    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
                                                }
                            ?>
                            <div id="bawah"><br>
                                <button id="tombolTutup">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </form>
</center>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#tombol').click(function(){
            $('#bg, #modalKotak').slideDown('fast')
        })
        $('#tombolTutup').mouseover(function(){
            $('#bg, #modalKotak').fadeOut('slow')
        })
        $('#load').fadeOut(function(){
			$('.section').fadeIn(2000)
		})
        $(document).keydown(function(e){
            if (e.keyCode === 27){
                $('#bg, #modalKotak').fadeOut('slow')
            }
        })
    })
</script>
