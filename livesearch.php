<?php
    include("config.php");

    $nfd = "No Results Found";

    if(isset($_POST['input'])){

        $input = $_POST['input'];

        $query = "SELECT * FROM music WHERE song_name LIKE '$input%' OR artist LIKE '$input%'";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){?>

       
        <?php foreach($result as $row):?>
            <div class="container" onclick="showpr()">
			<div class="song-search">
            <a class="play-audio" href="javascript:void(0);" data-file="<?php echo $row['song_audio'];?>">
				<img src="<?php echo $row['song_img'];?>" id="pic"/>
				<name id="name"><?php echo $row['song_name'];?></name>
				<artist id="artist"><?php echo $row['artist'];?></artist>
        </a>
				<add type="submit" name="add-to-playlist">+</add>
			</div>
        <?php endforeach;?>

        <?php

        }else{?>
            <div class="NRF"><?php echo $nfd;?></div>

        <?php
        }
    }
?>

</script>

	<script>
		var audio = null;
		var currentfile = null;

		$(document).ready(function(){

			$('.play-audio').on('click', function(){
				var el = $(this);
				var filename = el.attr('data-file');
			if(audio && currentfile === filename){
					audio.currentTime=0;
					audio.play();
				}
			else{
				if(audio){
						audio.pause();
					}
					audio = new Audio(filename);
					currentfile = filename;
					audio.play();
				}

				const str = filename;
				const newstr = str.replace(/[/.$@&]|[-]|(?<=-).*/g,'');
				let progress = document.getElementById("progress");
				let playbtn = document.getElementById("playbtn");
				let name = document.getElementById("song-n");
				name.innerHTML = newstr;
				const newstr2 = str.replace(/.*(?=-)|[!]|(?<=!).*/g,'');
				const art = newstr2.replace(/-/g,'')
				let artist = document.getElementById("song-ar");
				artist.innerHTML = art;
				
				const newstr3 = str.replace(/.*(?=!)|.mp3/g,'');
				const newstr4 ="./$@&/" + newstr3.replace(/!/g,'');
				const img = document.createElement("img"); 
				img.src = newstr4;
				let pstr = document.getElementById("poster");
				pstr.src = img.src;




				var playpause = function () {
  if (audio.paused) {
    audio.play();
  } else {
    audio.pause();
  }
}

playbtn.addEventListener("click", playpause);

audio.onplay = function () {
  playbtn.classList.remove("fa-play");
  playbtn.classList.add("fa-pause");
}

audio.onpause = function () {
  playbtn.classList.add("fa-play");
  playbtn.classList.remove("fa-pause");
}

audio.ontimeupdate = function () {
  let ct = audio.currentTime;
  current.innerHTML = timeFormat(ct);
  //progress
  let duration = audio.duration;
  prog = Math.floor((ct * 100) / duration);
  progress.style.setProperty("--progress", prog + "%");
}

function timeFormat(ct) {
  minutes = Math.floor(ct / 60);
  seconds = Math.floor(ct % 60);
  let duration = audio.duration;
  min = Math.floor(duration / 60);
  sec = Math.floor(duration % 60);

  if (seconds < 10) {
    seconds = "0"+seconds;
  }

  return (minutes + ":" + seconds + "/" + min + ":" + sec);
}
			});
		});
	</script>