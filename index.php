<?php

    session_start();
	if(!isset($_SESSION["email"])){
		header("Location: login.php");

	}

?>

<?php 
$time = time();
	setcookie('Roshan', 'user', $time)
?>

<?php 
	include_once('music.php');
?>

<?php
	$conn = new mysqli('localhost', 'root', '', 'msc');
    mysqli_select_db( $conn, 'signup');

	$uname = "SELECT uname from signup where email = '".$_SESSION["email"]."'";

	$res = mysqli_query($conn, $uname);
?>

<?php 

	function save_playlist($name){
		$conn = new mysqli('localhost', 'root', '', 'msc');
			mysqli_select_db( $conn, 'signup');
			$sql = "INSERT INTO media_playlist(name) VALUES (?)";
			$query = $conn->prepare($sql);
			$query->execute([$name]);
	}

	function get_music() {
		$rs = [];
			$conn = new mysqli('localhost', 'root', '', 'msc');
			mysqli_select_db( $conn, 'signup');
			$rs = $conn->query("SELECT * FROM music");
			return $rs;
	}

	function get_playlists() {
		$r = [];
			$conn = new mysqli('localhost', 'root', '', 'msc');
			mysqli_select_db( $conn, 'signup');
			$r = $conn->query("SELECT * FROM media_playlist");
			return $r;
	}

	function get_albums() {
		$r = [];
			$conn = new mysqli('localhost', 'root', '', 'msc');
			mysqli_select_db( $conn, 'signup');
			$r = $conn->query("SELECT * FROM album");
			return $r;
	}

	function get_artists() {
		$r = [];
			$conn = new mysqli('localhost', 'root', '', 'msc');
			mysqli_select_db( $conn, 'signup');
			$r = $conn->query("SELECT * FROM artist");
			return $r;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save-playlist'])){
		$playlist = isset($_POST['playlist']) ? $_POST['playlist'] : null;
		if($playlist){
			save_playlist($playlist);
			header("location:index.php");
		}
	} 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="index.css" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
	integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
	crossorigin="anonymous"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Online music streaming website</title>
 	</head>
<body>


	<header>
		<div class="search">
			<img src="search.png" class="mag">
			<form method="post">
			<input type="text" name="search" class="search-bar" id="live_search" onclick="showsr()"></input>
			</form>	
		</div>
		<div class="user"><?php while($rows = mysqli_fetch_assoc($res)) {
			echo $rows["uname"];}?>
		</div>
		<div class="circle"></div>
		<img src="user.png" class="user-icon">
	</header>





	<div class="NavBar">
		<logo>MUSICO</logo>
		<button class="Home" onclick="showhome()">
			<div id="btn-container">
				<img  src="home.png"/>
				<t>Home</t>
			  </div>
		</button>
		<button class="Playlist" type="button" onclick="showpl()">
			<div id="btn-container">
				<img  src="lib.png"/>
				<t>Playlist</t>
			  </div>
		</button>
		<button class="Artists" type="button" onclick="showar()">
			<div id="btn-container">
				<img  src="art.png"/>
				<t>Artists</t>
			  </div>
		</button>
		<button class="Albums" type="button" onclick="showal()">
			<div id="btn-container">
				<img  src="alb.png"/>
				<t>Albums</t>
			  </div>
		</button>
		<a href="logout.php">
			<button class="log">Log Out</button></a>
	</div>



	<div class="scr" id="s-hm">
			<p class="p5"></p>
	<div class="pop-up" id="pop" style = "display:none";>
	<div class="sap">SELECT A PLAYLIST</div>
	<div class="cancel" onclick="hidepop()">-</div>
		<div class="select-playlist">
			<?php foreach (get_playlists() as $pl): ?>
				<div class="banner-select" data-name="<?php echo $pl['name']?>" onclick="hidepop()">
				<div class="pname"><?php echo $pl["name"]; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	
	<?php foreach (get_music() as $music): ?>
		<a class="play-audio" href="javascript:void(0);" data-file="<?php echo $music['song_audio'];?>">
			<div class="container" onclick="showpr()">
			<div class="song">
				<img src="<?php echo $music['song_img'] ?>" id="pic"/>
				<name id="name"><?php echo $music['song_name'];?></name>
				<artist id="artist"><?php echo $music['artist'];?></artist>
		</a>
				<input type="submit" value="+" name="pl_media" class="add-tpl"
				data-img="<?php echo $music['song_name'];?>" onclick="showpop()"></input>
			</div>
			</div>

	<?php endforeach; ?>
	</div>         





	<div class="screen" id="s-p" style="display: none">
		<div class="playlist" id="pl">
			<p class="p1">Welcome to your playlist</p>
			<div class="pltext">CREATE PLAYLIST</div>
			<div class="pldesc">ENDLESS LIST OF FAVORITES JAMS</div>
			<div class="playlist-songs">
				<div class="create-pl" title="create playlist"  onclick="createpl()">+</div>
				<form id="cpl-page" method="post" style="display: none">
					<h1 class="noyp">Name of your playlist:</h1> 
					<input type="text" name="playlist" class="pl-name"/>
					<h1 class="sai">Select an image:</h1>
					<button type="submit" name="save-playlist" class="save-pl">Save</button>
					<div class="cancel" onclick="hidecpl()">-</div> 
				<form>
					</div>
					<form method="get">
		<?php foreach(get_playlists() as $prow) : ?>
		<a class="playlistinside" href="javascript:void(0);" data-src="<?php echo $prow['name'];?>">		
			<div class="banner" onclick="showplsongs()">
						<img src="./pimg.png" class="pimg"/>
						<div class="plname"><?php echo $prow["name"]; ?></div>
			</div>
		<a>
			<?php endforeach; ?>
		</form>
				</div>
			</div>
		</div>





		<div class="screen" id="s-al" style="display: none">
			<div class="album" id="al">
				<p class="p2">Top Albums</p>
				<div>
					<?php foreach (get_albums() as $albums) : ?>
				<div class="album-banner" onclick="showalsongs()" src="<?php echo $albums['album_img']?>">
					<img src="<?php echo $albums['album_img']?>" class="album-cover"/>
					<div class="album-name"><?php echo $albums['album_name']?></div>
					<div class="album-artist"><?php echo $albums['album_artist']?></div>
				</div>
				<?php endforeach; ?>
				</div>
			</div>
					</div>





			
			<div class="screen" id="s-ar" style="display: none">
				<div class="artist" id="ar">
					<p class="p3">Top Artists</p>
					<div>
				<?php foreach (get_artists() as $artist) : ?>
					<div class="artist-banner" onclick="showarsongs()" src="<?php echo $artist['artist_img']?>">
					<img id="artist-info" src="<?php echo $artist['artist_img']?>" class="artist-cover" id="ar-cover"/>
					<div class="artist-name"><?php echo $artist['artist_name']?></div>
				</div>
				<?php endforeach; ?>
					</div>
					</div>
				</div>






				<div class="scr" id="s-sr" style="display: none">
					<div class="srch" id="sr">
						<p class="p4">Search Results</p>
						<div id="searchresult">

						</div>
						</div>
					</div>






				<div class="screen" id="s-artist-songs" style="display: none">
					<div class="artist-s" id="ar-songs">
						<br><br><br>
						<div class="close" onclick="hidearsongs()">-</div>
						<div id="ar-s-result">
							
						</div>
						</div>
					</div>





				
				<div class="screen" id="s-album-songs" style="display: none">
					<div class="album-s" id="al-songs">
						<br><br><br>
						<div class="close" onclick="hidealsongs()">-</div>
						<div id="al-s-result">
							
						</div>
						</div>
					</div>





				<div class="scre" id="s-playlist-songs" style="display: none">
					<div class="playlist-s" id="pl-songs">
						<br><br><br><br><br><br>
						<div class="close" onclick="hideplsongs()">-</div>
						<div id="pl-s-result">
							
						</div>
						<div id="suggest">

						</div>
						</div>
					</div>



					

	<div class="player" id="pr" style="display: none">
		<div class="control">
		  <i class="fas fa-play" id="playbtn"></i>
		</div>
		<div class="info">
			<img class="poster" id="poster"></img>
			<div class="info-song" id="song-n"></div>
		  <div class="info-ar" id="song-ar"></div>
		  <div class="bar">
			<div id="progress"></div>
		  </div>
		</div>
			<div class="line"></div>
		<div id="current">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0:00</div>
		<div class="minus" onclick="hidepr()">-</div>
	  </div>
	  <div class="mini-pr" id="mpr" onclick="hidempr()" style="display: none">Player</div>







	<script>
		

		function showpl() {
			{
  				document.getElementById('s-p').style.display = 'block';
				document.getElementById('s-al').style.display = 'none';
				document.getElementById('s-ar').style.display = 'none';
				document.getElementById('s-sr').style.display = 'none';
				document.getElementById('s-album-songs').style.display = 'none';
				document.getElementById('s-artist-songs').style.display = 'none';
			};
		}

		function showal() {
			{
				document.getElementById('s-playlist-songs').style.display = 'none';
  				document.getElementById('s-al').style.display = 'block';
				document.getElementById('s-ar').style.display = 'none';
				document.getElementById('s-p').style.display = 'none';
				document.getElementById('s-sr').style.display = 'none';
				document.getElementById('s-album-songs').style.display = 'none';
				document.getElementById('s-artist-songs').style.display = 'none';
			};
		}

		function showar() {
			{
				document.getElementById('s-playlist-songs').style.display = 'none';
				document.getElementById('s-ar').style.display = 'block';
				document.getElementById('s-p').style.display = 'none';
				document.getElementById('s-al').style.display = 'none';
				document.getElementById('s-sr').style.display = 'none';
				document.getElementById('s-album-songs').style.display = 'none';
				document.getElementById('s-artist-songs').style.display = 'none';
			};
		}

		function showsr() {
			{
				document.getElementById('s-sr').style.display = 'block';
				document.getElementById('srchsub').style.display = 'block';
			};
		}

		function showpr() {
			{
				document.getElementById('pr').style.display = 'block';
				document.getElementById('mpr').style.display = 'none';
			};
		}

		function hidepr() {
			{
					document.getElementById('pr').style.display = 'none';
					document.getElementById('mpr').style.display = 'block';
			};
		}

		function hideplr() {
			{
					document.getElementById('pr').style.display = 'none';
					document.getElementById('mpr').style.display = 'block';
			};
		}

		function hidempr() {
			{
					document.getElementById('pr').style.display = 'block';
					document.getElementById('mpr').style.display = 'none';
			};
		}


		function showhome() {
				document.getElementById('s-artist-songs').style.display = 'none';
				document.getElementById('s-album-songs').style.display = 'none';
				document.getElementById('s-playlist-songs').style.display = 'none';
  				document.getElementById('s-p').style.display = 'none';
				document.getElementById('s-al').style.display = 'none';
				document.getElementById('s-ar').style.display = 'none';
				document.getElementById('s-sr').style.display = 'none';
				document.getElementById('srchsub').style.display = 'none';
				
		}

		function createpl(){
				document.getElementById('cpl-page').style.display = 'block';
		}

		function hidecpl(){
				document.getElementById('cpl-page').style.display = 'none';
		}

		function showarsongs(){
				document.getElementById('s-artist-songs').style.display = 'block';
		}

		function hidearsongs(){
				document.getElementById('s-artist-songs').style.display = 'none';
		}

		function showalsongs(){
				document.getElementById('s-album-songs').style.display = 'block';
		}

		function hidealsongs(){
				document.getElementById('s-album-songs').style.display = 'none';
		}

		function showplsongs(){
				document.getElementById('s-playlist-songs').style.display = 'block';
		}

		function hideplsongs(){
				document.getElementById('s-playlist-songs').style.display = 'none';
		}

		function showpop(){
				document.getElementById('pop').style.display = 'block';
		}

		function hidepop(){
				document.getElementById('pop').style.display = 'none';
		}
				
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
		$(document).ready(function() {

			$("#live_search").keyup(function(){
				var input = $(this).val();
				// alert(input);

				if(input !=""){
					$.ajax({

						url:"livesearch.php",
						method:"POST",
						data:{input:input},

						success:function(data){
							$("#searchresult").html(data);
						}
					});
				}else{
					document.getElementById("searchresult").innerHTML = "";
				}
			});
		});
            

	</script>

	<script>
		var input = null;

		$(document).ready(function() {
			$(".artist-banner").on("click",function(){
				var el = $(this);
				input = el.attr('src');

				console.log(input);
				if(input !=""){
					$.ajax({

						url:"artistfetch.php",
						method:"POST",
						data:{input:input},

						success:function(data){
							$("#ar-s-result").html(data);
						}
					});
				}else{
					document.getElementById("ar-s-result").innerHTML = "";
				}
			});
		});
	</script>

<script>
		var input = null;

		$(document).ready(function() {
			$(".album-banner").on("click",function(){
				var e = $(this);
				input = e.attr('src');

				console.log(input);
				if(input !=""){
					$.ajax({

						url:"albumfetch.php",
						method:"POST",
						data:{input:input},

						success:function(data){
							$("#al-s-result").html(data);
						}
					});
				}else{
					document.getElementById("al-s-result").innerHTML = "";
				}
			});
		});
	</script>

	<script>
		var input = null;
		$(document).ready(function() {
			$(".add-tpl").on("click",function(){
				var el = $(this);
				input = el.attr('data-img');
				$.ajax({

				url:"addtoplaylist.php",
				method:"POST",
				data:{input:input},
			});
		});
	});
	</script>

	<script>
		var input = null;
		$(document).ready(function() {
			$(".banner-select").on("click",function(){
				var el = $(this);
				input = el.attr('data-name');
				$.ajax({

				url:"addtoplaylist2.php",
				method:"POST",
				data:{input:input},
			});
		});
	});
	</script>

	<script>
		var input = null;
		$(document).ready(function() {
			$(".playlistinside").on("click",function(){
				var el = $(this);
				input = el.attr('data-src');
				console.log(input);
				if(input !=""){
				$.ajax({

				url:"playlistfetch.php",
				method:"POST",
				data:{input:input},
				success:function(data){
					$("#pl-s-result").html(data);				}
			});
		}else{
			document.getElementById("pl-s-result").innerHTML = "";
		}
		});
	});
	</script>

<script>
		var input = null;
		$(document).ready(function() {
			$(".playlistinside").on("click",function(){
				var el = $(this);
				input = el.attr('data-src');
				console.log(input);
				if(input !=""){
				$.ajax({

				url:"suggest.php",
				method:"POST",
				data:{input:input},
				success:function(data){
					$("#suggest").html(data);				}
			});
		}else{
			
		}
		});
	});
	</script>

</body>
</html>